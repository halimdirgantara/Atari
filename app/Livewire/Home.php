<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GuestBook;
use App\Models\Organization;

class Home extends Component
{
    public $slug;
    public $organization;
    public $organizations;
    public $statusCounts;
    public $visits;

    public function mount($slug = null)
    {
        // Ambil semua organisasi
        $this->organizations = Organization::all();

        // Cari organisasi berdasarkan slug atau gunakan default
        $this->organization = Organization::where('slug', $slug)
            ->first() ?? Organization::where('id', 1)->first();

        $this->slug = $this->organization->slug;

        // Perbarui data
        $this->updateData();
    }

    private function updateData()
    {
        // Hitung status kunjungan
        $this->statusCounts = [
            'pending' => GuestBook::where('organization_id', $this->organization->id)
                ->where('status', 'pending')->count(),
            'approved' => GuestBook::where('organization_id', $this->organization->id)
                ->where('status', 'approved')->count(),
            'declined' => GuestBook::where('organization_id', $this->organization->id)
                ->where('status', 'declined')->count(),
            'process' => GuestBook::where('organization_id', $this->organization->id)
                ->where('status', 'process')->count(),
            'done' => GuestBook::where('organization_id', $this->organization->id)
                ->where('status', 'done')->count(),
        ];

        // Ambil kunjungan dengan eager loading yang optimal
        $this->visits = GuestBook::with(['guests' => function($query) {
                $query->select('id', 'guest_book_id', 'name', 'email', 'organization');
            }])
            ->where('organization_id', $this->organization->id)
            ->whereNot('status', 'done')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.home')->extends('layouts.app');
    }
}
