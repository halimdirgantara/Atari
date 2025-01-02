<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Guest;
use Livewire\Component;
use App\Models\GuestBook;
use Illuminate\Support\Str;
use App\Models\Organization;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckIn extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    protected $listeners = ['copyToken'];

    public $name;
    public $email;
    public $phone;
    public $address;
    public $identity_file;
    public $identity_id;
    public $host_id;
    public $organization;
    public $organizationData;
    public $check_in;
    public $duration;
    public $needs;
    public $guests = [];
    public $users;

    public function mount($slug)
    {
        // Ambil organisasi berdasarkan slug atau organisasi default
        $this->organizationData = $slug
            ? Organization::where('slug', $slug)->firstOrFail()
            : Organization::where('id', 1)->firstOrFail(); // Default organisasi ID 1

        // Ambil daftar user untuk organisasi tersebut
        $this->users = User::where('organization_id', $this->organizationData->id)->get();

        // Set waktu check-in default
        $this->check_in = Carbon::now()->format('Y-m-d\TH:i');
    }

    public function addGuest()
    {
        $this->guests[] = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'address' => '',
            'identity_file' => null,
            'identity_id' => '',
        ];
    }

    public function removeGuest($index)
    {
        unset($this->guests[$index]);
        $this->guests = array_values($this->guests);
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'host_id' => 'required|exists:users,id',
            'check_in' => 'required|date',
            'duration' => 'required|integer|min:15|max:120',
            'needs' => 'required|string|max:500',
            'identity_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'identity_id' => 'nullable|string|max:16',
            'guests.*.name' => 'required|string|max:255',
            'guests.*.email' => 'required|email|max:255',
            'guests.*.phone' => 'required|string|max:15',
            'guests.*.address' => 'required|string|max:255',
            'guests.*.identity_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'guests.*.identity_id' => 'nullable|string|max:16',
        ]);

        $checkInTime = Carbon::parse($this->check_in);
        $checkOutTime = $checkInTime->addMinutes($this->duration);
        $guestToken = Str::random(10);

        // Simpan data tamu utama
        $mainGuest = Guest::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'organization' => $this->organization,
            'identity_id' => $this->identity_id,
            'identity_file' => $this->identity_file
                ? $this->identity_file->store('uploads/ktp', 'public')
                : null,
            'guest_token' => $guestToken,
        ]);

        $guestBook = GuestBook::create([
            'host_id' => $this->host_id,
            'organization_id' => $this->organizationData->id,
            'check_in' => $this->check_in,
            'check_out' => $checkOutTime,
            'needs' => $this->needs,
            'status' => 'process',
        ]);

        // Attach tamu utama ke guestBook
        $guestBook->guests()->attach($mainGuest->id);

        // Simpan tamu tambahan
        foreach ($this->guests as $guest) {
            $additionalGuest = Guest::create([
                'name' => $guest['name'],
                'email' => $guest['email'],
                'phone' => $guest['phone'],
                'address' => $guest['address'],
                'organization' => $this->organization,
                'identity_id' => $guest['identity_id'],
                'identity_file' => isset($guest['identity_file'])
                    ? $guest['identity_file']->store('uploads/ktp', 'public')
                    : null,
                'guest_token' => $guestToken,
            ]);

            $guestBook->guests()->attach($additionalGuest->id);
        }


        $guestBook->guests()->attach($mainGuest->id);

        $this->alert('success', 'Permintaan Anda telah terkirim!', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => false,
            'showCancelButton' => false,
            'allowOutsideClick' => false,
            'html' => '
                <p>Salin token di bawah ini untuk mengecek janji Anda:</p>
                <div class="bg-gray-100 p-3 rounded-lg mt-3 flex justify-between items-center">
                    <span class="font-mono text-blue-700 font-semibold">' . $guestToken . '</span>
                    <button 
                        class="bg-blue-500 text-white px-3 py-1 ml-3 rounded hover:bg-blue-600"
                        onclick="copyToClipboard(\'' . $guestToken . '\')"
                    >
                        Salin Token
                    </button>
                </div>
            '
        ]);

    }

    public function copyToken($token)
    {
        $this->dispatchBrowserEvent('copyToClipboard', ['token' => $token]);
    }

    public function copied()
    {
        $this->alert('success', 'Token berhasil disalin!', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK',
            'onConfirmed' => 'redirectAfterCopy',
            'allowOutsideClick' => false,
        ]);

        return redirect()->route('check-appointment', ['slug' => $this->organizationData->slug]);
    }

    public function getListeners()
    {
        return array_merge(parent::getListeners(), [
            'copied' => 'copied',
        ]);
    }

    public function render()
    {
        return view('livewire.check-in', [
            'organizationData' => $this->organizationData,
            'users' => $this->users,
        ])->layout('layouts.app', [
                    'slug' => $this->organizationData->slug,
                ]);
    }
}
