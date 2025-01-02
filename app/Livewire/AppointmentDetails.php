<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GuestBook;
use App\Models\Organization;

class AppointmentDetails extends Component
{
    public $appointment;
    public $organization;

    public function mount($slug, $guest_token)
    {
        // Ambil data organisasi berdasarkan slug
        $this->organization = Organization::where('slug', $slug)->firstOrFail();

        // Ambil janji temu berdasarkan token tamu
        $this->appointment = GuestBook::with(['guests', 'host', 'organization'])
            ->where('organization_id', $this->organization->id)
            ->whereHas('guests', function ($query) use ($guest_token) {
                $query->where('guest_token', $guest_token);
            })
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.appointment-details')
            ->layout('layouts.app');
    }
}
