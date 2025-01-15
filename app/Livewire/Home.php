<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Import pagination
use App\Models\GuestBook;
use App\Models\Organization;

class Home extends Component
{
    use WithPagination;

    public $slug;
    public $organization;
    public $organizations;
    public $statusCounts;

    public function mount($slug = null)
    {
        // Ambil semua organisasi
        $this->organizations = Organization::all();

        // Cari organisasi berdasarkan slug atau gunakan default
        $this->organization = Organization::where('slug', $slug)
            ->first() ?? Organization::where('id', 1)->first();

        $this->slug = $this->organization->slug;

        // Perbarui data status
        $this->updateStatusCounts();
    }

    private function updateStatusCounts()
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
            'not_attend' => GuestBook::where('organization_id', $this->organization->id)
                ->where('status', 'not_attend')->count(),
        ];
    }

    public function render()
    {
        // Ambil kunjungan tamu dengan pagination
        $visits = GuestBook::with(['guests' => function ($query) {
                $query->select('id', 'guest_book_id', 'name', 'email', 'organization');
            }])
            ->where('organization_id', $this->organization->id)
            ->whereNot('status', 'done')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Batasi 5 tamu per halaman

        return view('livewire.home', [
            'visits' => $visits,
        ])->extends('layouts.app');
    }
}
