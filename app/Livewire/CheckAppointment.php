<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GuestBook;
use App\Models\Organization;

class CheckAppointment extends Component
{
    public $guest_token;
    public $appointments = [];
    public $organization;

    public function mount($slug)
    {
        // Ambil data organisasi berdasarkan slug
        $this->organization = Organization::where('slug', $slug)->firstOrFail();
    }

    public function checkAppointments()
    {
        // Validasi input token
        $this->validate([
            'guest_token' => 'required|string|size:10',
        ], [
            'guest_token.required' => 'Token tamu harus diisi.',
            'guest_token.size' => 'Token harus terdiri dari 10 karakter.',
        ]);

        // Ambil daftar janji berdasarkan guest_token dan organisasi
        $this->appointments = GuestBook::with('guests')
            ->where('organization_id', $this->organization->id)
            ->whereHas('guests', function ($query) {
                $query->where('guest_token', $this->guest_token);
            })
            ->get();

        // Periksa apakah ada janji yang ditemukan
        if ($this->appointments->isEmpty()) {
            // Tampilkan notifikasi jika janji tidak ditemukan
            $this->dispatch('show-notification', [
                'type' => 'error',
                'message' => 'Janji Anda tidak ditemukan. Silakan periksa kembali token yang Anda masukkan.',
            ]);
        } else {
            // Tampilkan notifikasi jika janji ditemukan
            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Janji Anda berhasil ditemukan!',
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
