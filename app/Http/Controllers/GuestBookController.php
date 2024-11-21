<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Pastikan untuk menambahkan ini

class GuestBookController extends Controller
{
    public function index()
    {
        $visits = GuestBook::with('guests')->get();
        $statusCounts = [
            'confirmed' => $visits->where('status', 'confirmed')->count(),
            'pending' => $visits->where('status', 'pending')->count(),
            'cancelled' => $visits->where('status', 'cancelled')->count(),
        ];

        return view('landing', compact('visits', 'statusCounts'));
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'organization' => 'required',
            'identity_id' => 'required',
            'identity_file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Upload file
        $filePath = $request->file('identity_file')->store('uploads/ktp', 'public');

        // Menghasilkan token acak
        $guestToken = Str::random(10);

        // Menyimpan data tamu
        $guest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'organization' => $request->organization,
            'identity_id' => $request->identity_id,
            'identity_file' => $filePath,
            'guest_token' => $guestToken, // Menyimpan guest_token
        ]);

        // Menyimpan data buku tamu
        GuestBook::create([
            'guest_id' => $guest->id,
            'organization_id' => $request->organization_id ?? null,
            'check_in' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('landing')->with('success', 'Appointment created successfully.');
    }

    public function check(Request $request)
    {
        $status = GuestBook::where('guest_id', $request->guest_id)->pluck('status')->first();

        return view('check', compact('status'));
    }
}
