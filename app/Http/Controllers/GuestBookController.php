<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestBook;
use Carbon\Carbon;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestBookController extends Controller
{
    public function index()
    {
        // Mengambil data visits dengan relasi guests dan paginate
        $visits = GuestBook::with('guests')
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu pembuatan, data terbaru di atas
            ->paginate(5);

        // Menghitung jumlah status berdasarkan status
        $statusCounts = [
            'approve' => GuestBook::where('status', 'Approve')->count(),
            'pending' => GuestBook::where('status', 'Pending')->count(),
            'process' => GuestBook::where('status', 'Process')->count(),
            'reject' => GuestBook::where('status', 'Reject')->count(),
        ];

        // Hapus session success jika bukan dari redirect
        if (!session()->previousUrl() || !str_contains(session()->previousUrl(), 'form')) {
            session()->forget('success');
        }

        // Mengirim data ke view
        return view('landing', compact('visits', 'statusCounts'));
    }

    public function create()
    {
        $users = User::all(['id', 'name', 'nip', 'nik']); // Mengambil data users
        return view('form', compact('users')); // Mengirim data users ke view 'form'
    }

    public function store(Request $request)
    {
        // Validasi input utama
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'host_id' => 'required|exists:users,id',
            'organization' => 'required',
            'identity_id' => 'required',
            'identity_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            // Validasi untuk tamu tambahan
            'guests.*.name' => 'required_with:guests',
            'guests.*.email' => 'required_with:guests|email',
            'guests.*.phone' => 'required_with:guests',
            'guests.*.address' => 'required_with:guests',
            'guests.*.identity_id' => 'required_with:guests',
            'guests.*.identity_file' => 'required_with:guests|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $host = User::find($request->host_id);
        $guestToken = Str::random(10); // Satu token untuk semua tamu

        // Upload file dan buat guest utama
        $mainFilePath = $request->file('identity_file')->store('uploads/ktp', 'public');
        $mainGuest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'organization' => $request->organization,
            'identity_id' => $request->identity_id,
            'identity_file' => $mainFilePath,
            'guest_token' => $guestToken,
        ]);

        // Buat GuestBook
        $guestBook = GuestBook::create([
            'host_id' => $request->host_id,
            'organization_id' => $host->organization->first()->id,
            'needs' => $request->needs,
            'check_in' => Carbon::parse($request->check_in),
            'check_out' => Carbon::parse($request->check_in)->addMinutes($request->duration),
            'status' => 'process',
        ]);

        // Attach tamu utama
        $guestBook->guests()->attach($mainGuest->id);

        // Proses tamu tambahan jika ada
        if ($request->has('guests')) {
            foreach ($request->guests as $guestData) {
                // Upload file KTP tamu tambahan
                $filePath = $guestData['identity_file']->store('uploads/ktp', 'public');

                $additionalGuest = Guest::create([
                    'name' => $guestData['name'],
                    'email' => $guestData['email'],
                    'phone' => $guestData['phone'],
                    'address' => $guestData['address'],
                    'organization' => $mainGuest->organization,
                    'identity_id' => $guestData['identity_id'],
                    'identity_file' => $filePath,
                    'guest_token' => $guestToken, // Gunakan token yang sama
                ]);

                $guestBook->guests()->attach($additionalGuest->id);
            }
        }

        session()->flash('guest_token', $guestToken);
        session()->flash('success', 'Permintaan berhasil dikirim');
        return redirect()->route('landing');
    }
    public function check(Request $request)
    {
        $appointments = collect();

        if ($request->has('guest_token')) {
            $guestToken = $request->input('guest_token');

            // Cari appointment berdasarkan guest_token
            $appointments = GuestBook::with('guests')
                ->whereHas('guests', function($query) use ($guestToken) {
                    $query->where('guest_token', $guestToken);
                })
                ->get();

            if ($appointments->isEmpty()) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }
        }

        return view('check', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = GuestBook::with(['guests', 'host', 'organization'])->find($id);

        if (!$appointment) {
            return redirect()->route('landing')->with('error', 'Janji temu tidak ditemukan');
        }

        return view('appointment_details', compact('appointment'));
    }
}
