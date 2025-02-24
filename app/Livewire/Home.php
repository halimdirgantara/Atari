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


    // Tambahkan properti ini untuk validasi lokasi
    public $latitude;
    public $longitude;
    public $isWithinRange = false; // Untuk menentukan apakah dalam jarak tertentu





    public function mount($slug = null)
    {
        // Ambil semua organisasi
        $this->organizations = Organization::all();

        // Cari organisasi berdasarkan slug atau gunakan default
        $this->organization = Organization::where('slug', $slug)
            ->first() ?? Organization::where('id', 1)->first();

        $this->slug = $this->organization->slug;

        // Ambil koordinat dari organisasi
        $this->latitude = $this->organization->latitude;
        $this->longitude = $this->organization->longitude;

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

    public function checkLocation($userLat, $userLng)
    {
        $distance = $this->calculateDistance($this->latitude, $this->longitude, $userLat, $userLng);

        // Jika jarak kurang dari 50 meter
        if ($distance <= 200) {
            $this->isWithinRange = true;
        } else {
            $this->isWithinRange = false;
        }
    }

    // Fungsi menghitung jarak menggunakan Haversine Formula
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Jarak dalam meter
        return $distance;
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
            ->paginate(7); // Batasi 5 tamu per halaman

        return view('livewire.home', [
            'visits' => $visits,
        ])->extends('layouts.app');
    }
}
