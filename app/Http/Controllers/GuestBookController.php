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
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'host_id' => 'required|exists:users,id',
            'organization' => 'required',
            'identity_id' => 'required',
            'identity_file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $host = User::find($request->host_id);

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
            'needs' => $request->needs,
            'guest_token' => $guestToken,
        ]);

        // Validasi host dan organisasi
        if (!$host || is_null($host->organization)) {
            return redirect()->back()->with('error', 'Host atau organisasi tidak ditemukan.');
        }

        // Ambil ID organisasi pertama yang terhubung dengan pengguna
        $organization_id = $host->organization->first()->id;

        // Hitung check_out berdasarkan check_in + durasi
        $check_in = \Carbon\Carbon::parse($request->check_in);
        $check_out = $check_in->copy()->addMinutes($request->duration);

        // Create guest book
        $guestBook = GuestBook::create([
            'host_id' => $request->host_id ?? auth()->id(),
            'organization_id' => $organization_id,
            'needs' => $request->needs,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'status' => 'process',
        ]);

        // Sync relasi
        $guestBook->guests()->attach($guest->id);

        session()->flash('success', 'Permintaan berhasil dikirim');
        return redirect()->route('landing');
    }

    public function check(Request $request)
    {
        // Hapus session success
        session()->forget('success');

        $status = null;
        $appointments = collect();  // Inisialisasi koleksi kosong
        $errorMessage = null; // Variabel untuk menyimpan pesan error

        if ($request->has('guest_id')) {
            $guestId = $request->input('guest_id');

            // Cari janji temu berdasarkan guest_id (nama atau organisasi)
            $appointments = GuestBook::with('guests')
                ->whereHas('guests', function($query) use ($guestId) {
                    $query->where('name', 'like', '%'.$guestId.'%')
                        ->orWhere('organization', 'like', '%'.$guestId.'%');
                })
                ->get();

            if ($appointments->isNotEmpty()) {
                $status = $appointments->first()->status;
            } else {
                $errorMessage = 'Data Tidak Ditemukan';
            }
        }

        return view('check', compact('status', 'appointments', 'errorMessage'));
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
