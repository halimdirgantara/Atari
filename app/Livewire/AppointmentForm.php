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

class AppointmentForm extends Component
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

        $this->organizationData = $slug
            ? Organization::where('slug', $slug)->firstOrFail()
            : Organization::where('id', 1)->firstOrFail();

        $this->users = User::where('organization_id', $this->organizationData->id)->get();

        $this->check_in = now()->format('Y-m-d\TH:i');
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
        try {
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

            // Proses  form jika validasi berhasil

        } catch (\Illuminate\Validation\ValidationException $exception) {
            $this->alert('error', 'Form tidak valid', [
                'position' => 'center',
                'timer' => 5000,
                'toast' => false,
                'showConfirmButton' => false,
                'allowOutsideClick' => true,
                'html' => '
                    <div class="w-full max-w-md md:max-w-lg px-4 py-3 text-center">
                        <p class="text-sm text-gray-700 mt-2">Pastikan semua field telah diisi!!!!.</p>
                    </div>
                '
            ]);

            return; // Stop further execution
        }

        $checkInTime = Carbon::parse($this->check_in);

        $checkOutTime = $checkInTime->copy()->addMinutes($this->duration);

        $guestToken = Str::random(10);

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
            'check_in' => $checkInTime,
            'check_out' => $checkOutTime,
            'needs' => $this->needs,
            'status' => 'process',
        ]);

        $guestBook->guests()->attach($mainGuest->id);

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

        $this->alert('success', 'Permintaan Anda telah terkirim!', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => false,
            'showCancelButton' => false,
            'allowOutsideClick' => false,
            'html' => '
                <div class="px-2 sm:px-4 max-w-full sm:max-w-lg mx-auto">
                    <p class="text-sm sm:text-base">Salin token di bawah ini untuk mengecek janji Anda dan</p>
                    <p class="text-sm sm:text-base mt-1 text-gray-600">Gunakan token ini untuk verifikasi janji apabila sudah berada di tempat.</p>
                    <div class="bg-gray-100 p-2 sm:p-3 rounded-lg mt-2 sm:mt-3 flex justify-between items-center">
                        <span class="font-mono text-blue-700 font-semibold text-xs sm:text-base break-all mr-2">' . $guestToken . '</span>
                        <button
                            class="bg-blue-500 text-white px-2 sm:px-3 py-1 ml-2 sm:ml-3 rounded hover:bg-blue-600 text-xs sm:text-base whitespace-nowrap"
                            onclick="copyToClipboard(\'' . $guestToken . '\')"
                        >
                            Salin Token
                        </button>
                    </div>
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
            'showConfirmButton' => false,
            'onConfirmed' => 'redirectAfterCopy',
            'allowOutsideClick' => false,
        ]);

        return redirect()->route('home', ['slug' => $this->organizationData->slug]);
    }

    public function getListeners()
    {
        return array_merge(parent::getListeners(), [
            'copied' => 'copied',
        ]);
    }

    public function render()
    {
        return view('livewire.appointment-form', [
            'organizationData' => $this->organizationData,
            'users' => $this->users,
        ])->layout('layouts.app', [
                    'slug' => $this->organizationData->slug,
                ]);
    }
}
