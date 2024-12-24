<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Organization;

class CheckIn extends Component
{
    public $organization;
    public $users;
    public function mount($slug)
    {
        // Ambil organisasi berdasarkan slug
        $organization = Organization::where('slug', $slug)->firstOrFail();

        // Ambil data pengguna jika diperlukan
        $users = User::where('organization_id', $organization->id)->get(); // Mengambil data users
    }

    public function render()
    {
        return view('livewire.check-in')->extends('layouts.app');
    }
}
