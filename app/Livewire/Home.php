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
        // Ambil semua organisasi untuk keperluan navigasi atau dropdown
        $this->organizations = Organization::all();

        // Jika slug diberikan, cari organisasi berdasarkan slug, jika tidak gunakan default (id = 1)
        $this->organization = Organization::where('slug', $slug)->first() ?? Organization::where('id', 1)->first();

        // Tetapkan slug saat ini
        $this->slug = $this->organization->slug;

        // Perbarui data status kunjungan dan kunjungan terbaru berdasarkan organisasi
        $this->updateData();
    }

    private function updateData()
    {
        // Perhitungan status kunjungan untuk organisasi yang dipilih
        $this->statusCounts = [
            'pending' => GuestBook::where('organization_id', $this->organization->id)->where('status', 'pending')->count(),
            'approved' => GuestBook::where('organization_id', $this->organization->id)->where('status', 'approved')->count(),
            'declined' => GuestBook::where('organization_id', $this->organization->id)->where('status', 'declined')->count(),
            'process' => GuestBook::where('organization_id', $this->organization->id)->where('status', 'process')->count(),
            'done' => GuestBook::where('organization_id', $this->organization->id)->where('status', 'done')->count(),
        ];

        // Ambil kunjungan terbaru untuk organisasi yang dipilih
        $this->visits = GuestBook::with('guests')
            ->where('organization_id', $this->organization->id)
            ->whereNot('status', 'done') // Filter status 'done'
            ->orderBy('created_at', 'desc')
            ->get();


    }

    public function render()
    {
        return view('livewire.home')->extends('layouts.app');
    }
}
