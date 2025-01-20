<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Guest;
use App\Models\GuestBook;
use App\Models\Organization;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckIn extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    const STATUS_APPROVED = 'approved';

    // Form Properties
    public $name;
    public $email;
    public $phone;
    public $address;
    public $identity_file;
    public $identity_id;
    public $host_id;
    public $organization;
    public $check_in;
    public $duration;
    public $needs;
    public $guests = [];

    // Token Search Properties
    public $guest_token = '';
    public $appointment;
    public $organizationData;
    public $users;
    public $showForm = true;

    public function mount($slug)
    {
        $this->organizationData = $slug
            ? Organization::where('slug', $slug)->firstOrFail()
            : Organization::where('id', 1)->firstOrFail();

        $this->users = User::where('organization_id', $this->organizationData->id)->get();
        $this->check_in = now()->format('Y-m-d\TH:i');
    }

    public function toggleView()
    {
        $this->showForm = !$this->showForm;
        $this->reset(['guest_token', 'appointment']);
    }

    public function updatedGuestToken()
    {
        if (strlen($this->guest_token) < 10) {
            $this->alert('warning', 'Token terlalu pendek!<br><div class="text-sm text-gray-500">Token harus 10 karakter</div>', [
                'position' => 'center',
                'timer' => 4000,
                'toast' => false,
                'showConfirmButton' => false,
            ]);
        } elseif (strlen($this->guest_token) > 10) {
            $this->alert('warning', 'Token terlalu panjang!<br><div class="text-sm text-gray-500">Token harus 10 karakter</div>', [
                'position' => 'center',
                'timer' => 4000,
                'toast' => false,
                'showConfirmButton' => false,
            ]);
        }
    }

    public function searchAppointment()
    {
        $this->validate([
            'guest_token' => 'required|string|size:10',
        ], [
            'guest_token.required' => 'Token tamu harus diisi.',
            'guest_token.size' => 'Token harus terdiri dari 10 karakter.',
        ]);

        $this->appointment = GuestBook::with(['guests', 'host', 'organization'])
            ->where('organization_id', $this->organizationData->id)
            ->whereHas('guests', function ($query) {
                $query->where('guest_token', $this->guest_token);
            })
            ->first();

            if (!$this->appointment) {
                // Alert jika janji tidak ditemukan
                $this->alert('error', 'Janji tidak ditemukan!', [
                    'position' => 'center',
                    'timer' => 4000,
                    'toast' => false,
                    'showConfirmButton' => false,
                ]);
            } else {
                // Alert jika janji ditemukan
                $this->alert('success', 'Janji berhasil ditemukan!', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => false,
                    'showConfirmButton' => false,
                ]);
            }
    }

    public function confirmCheckIn()
    {
        // Pastikan data janji temu ditemukan
        if ($this->appointment) {
            // Cek status janji temu
            if ($this->appointment->status === 'process') {
                // Jika status masih "process", tampilkan alert
                $this->alert('error', 'Maaf, janji Anda belum diterima!', [
                    'position' => 'center',
                    'timer' => 4000,
                    'toast' => false,
                    'showConfirmButton' => false,
                ]);
                return;
            }

            // Hanya lanjutkan jika status "approved"
            if ($this->appointment->status === 'approved') {
                // Hitung durasi awal berdasarkan selisih check_in dan check_out
                $durationInMinutes = \Carbon\Carbon::parse($this->appointment->check_out)
                    ->diffInMinutes(\Carbon\Carbon::parse($this->appointment->check_in));

                // Update waktu check_in dengan waktu saat ini
                $newCheckIn = Carbon::now();
                $newCheckOut = $newCheckIn->copy()->addMinutes($durationInMinutes); // Tambahkan durasi ke waktu check_in

                // Update database
                $this->appointment->update([
                    'check_in' => $newCheckIn,
                    'check_out' => $newCheckOut,
                ]);

                // Tampilkan alert berhasil
                $this->alert('success', 'Check-in berhasil!', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => false,
                    'showConfirmButton' => false,
                ]);

                // Reset token dan janji temu
                $this->appointment = null;
                $this->guest_token = '';

                // Redirect ke halaman home
                return redirect()->route('home', ['slug' => $this->organizationData->slug]);
            }

            // Jika status bukan "approved" atau "process", tampilkan alert
            $this->alert('error', 'Status janji tidak valid untuk check-in!', [
                'position' => 'center',
                'timer' => 4000,
                'toast' => false,
                'showConfirmButton' => false,
            ]);
        }
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

        $checkOutTime = Carbon::parse($this->check_in)->addMinutes($this->duration);
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
            'check_in' => now(),
            'check_out' => $checkOutTime,
            'needs' => $this->needs,
            'status' => 'process',
        ]);

        $guestBook->update([
            'status' => 'approved',

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

        $this->alert('success', 'Check-in Berhasil!!', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => false,
            'allowOutsideClick' => false,
            'persistent' => true,
            'padding' => '1rem'
        ]);
        return redirect()->route('home', ['slug' => $this->organizationData->slug]);
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
