<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GuestBook;
use App\Models\Organization;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckAppointment extends Component
{
    use LivewireAlert;

    public $guest_token = '';
    public $appointments = [];
    public $organization;

    public function mount($slug)
    {
        $this->organization = Organization::where('slug', $slug)->firstOrFail();
    }

    // Validasi real-time yang lebih informatif
    public function updatedGuestToken()
    {
        $length = strlen($this->guest_token);

        if ($length > 0 && $length < 10) {
            $remainingChars = 10 - $length;
            $message = "Token belum lengkap!";
            $detail = "Masih kurang {$remainingChars} karakter lagi. Token harus terdiri dari 10 karakter.";

            $this->alert('warning', $message, [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'showConfirmButton' => false,
                'timerProgressBar' => true,
                'text' => $detail,
                'padding' => '1rem',
            ]);
        } elseif ($length > 10) {
            $extraChars = $length - 10;
            $this->alert('warning', 'Token terlalu panjang!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'showConfirmButton' => false,
                'timerProgressBar' => true,
                'text' => "Hapus {$extraChars} karakter. Token harus terdiri dari 10 karakter.",
                'padding' => '1rem',
            ]);
        }
    }

    public function checkAppointments()
    {
        try {
            $this->validate([
                'guest_token' => 'required|string|size:10',
            ], [
                'guest_token.required' => 'Token tamu harus diisi.',
                'guest_token.size' => 'Token harus terdiri dari 10 karakter.',
            ]);

            // Ambil daftar janji berdasarkan guest_token dan organisasi
            $this->appointments = GuestBook::with(['guests', 'organization'])
                ->where('organization_id', $this->organization->id)
                ->whereHas('guests', function ($query) {
                    $query->where('guest_token', $this->guest_token);
                })
                ->get();

            if ($this->appointments->isEmpty()) {
                $this->alert('error', 'Janji tidak ditemukan!', [
                    'position' => 'center',
                    'timer' => 5000, // Waktu ditambah untuk memberi waktu membaca
                    'toast' => true,
                    'showConfirmButton' => false,
                    'timerProgressBar' => true,
                    'text' => "Tidak dapat menemukan janji dengan token: {$this->guest_token}\n" .
                             "Silakan periksa kembali token Anda atau hubungi administrator.",
                    'padding' => '1rem',
                ]);
            } else {
                $appointment = $this->appointments->first();
                $mainGuest = $appointment->guests->first();
                $date = \Carbon\Carbon::parse($appointment->check_in)->format('d M Y H:i');

                $this->alert('success', 'Janji berhasil ditemukan!', [
                    'position' => 'center',
                    'timer' => 5000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'timerProgressBar' => true,
                    'text' => "Nama: {$mainGuest->name}\n" .
                             "Waktu Kunjungan: {$date}\n" .
                             "Status: " . ucfirst($appointment->status),
                    'padding' => '1rem',
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $currentLength = strlen($this->guest_token);
            $this->alert('error', 'Token tidak valid!', [
                'position' => 'center',
                'timer' => 4000,
                'toast' => true,
                'showConfirmButton' => false,
                'timerProgressBar' => true,
                'text' => "Panjang token saat ini: {$currentLength} karakter\n" .
                         "Token harus terdiri dari tepat 10 karakter.",
                'padding' => '1rem',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.check-appointment')
            ->layout('layouts.app', [
                'slug' => $this->organization->slug,
            ]);
    }
}
