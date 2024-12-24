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
    public function mount()
    {
        $this->organizations = Organization::all();

        $this->organization = Organization::where('id', 1)->first();

        $this->slug = $this->organization->slug;

        // Perhitungan status kunjungan berdasarkan organisasi tertentu
        $this->statusCounts = [
            'pending' => GuestBook::count(),
            'approved' => GuestBook::count(),
            'declined' => GuestBook::count(),
            'process' => GuestBook::count(),
            'done' => GuestBook::count(),
        ];

        // Ambil kunjungan terbaru berdasarkan organisasi tertentu
        $this->visits = GuestBook::with('guests')
            ->where('status', '!=', 'done')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.home')->extends('layouts.app');
    }
}
