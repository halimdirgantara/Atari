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
            'pending' => GuestBook::where('status', 'pending')->count(),
            'approved' => GuestBook::where('status', 'approved')->count(),
            'declined' => GuestBook::where('status', 'declined')->count(),
            'process' => GuestBook::where('status', 'process')->count(),
            'done' => GuestBook::where('status', 'done')->count(),
        ];

        // Hapus session success jika bukan dari redirect
        if (!session()->previousUrl() || !str_contains(session()->previousUrl(), 'check-in')) {
            session()->forget('success');
        }

        // Mengirim data ke view
        return view('landing', compact('visits', 'statusCounts'));
    }

    public function create()
    {
        $users = User::all(['id', 'name', 'nip', 'nik']); // Mengambil data users
        return view('check-in', compact('users')); // Mengirim data users ke view 'form'
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
            'identity_id' => 'nullable', // Tidak wajib
            'identity_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', // Tidak wajib
            // Validasi untuk tamu tambahan
            'guests.*.name' => 'required_with:guests',
            'guests.*.email' => 'required_with:guests|email',
            'guests.*.phone' => 'required_with:guests',
            'guests.*.address' => 'required_with:guests',
            'guests.*.identity_id' => 'nullable', // Tidak wajib
            'guests.*.identity_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', // Tidak wajib
        ]);

        $host = User::find($request->host_id);

        $guestToken = Str::random(10); // Satu token untuk semua tamu

        /// Upload file dan buat guest utama
        $mainFilePath = null;
        if ($request->hasFile('identity_file')) {
            $mainFilePath = $request->file('identity_file')->store('uploads/ktp', 'public');
        }
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
            'organization_id' => $host->organization_id,
            'needs' => $request->needs,
            'check_in' => Carbon::now(), // Gunakan waktu sekarang untuk check-in
            'check_out' => Carbon::now()->addMinutes($request->duration), // Durasi dihitung dari sekarang
            'status' => 'process',
        ]);

        // Attach tamu utama
        $guestBook->guests()->attach($mainGuest->id);

        // Proses tamu tambahan jika ada
        if ($request->has('guests')) {
            foreach ($request->guests as $guestData) {
                $filePath = null;
                // Cek apakah file diunggah oleh tamu tambahan
                if (isset($guestData['identity_file']) && $guestData['identity_file']) {
                    $filePath = $guestData['identity_file']->store('uploads/ktp', 'public');
                }

                $additionalGuest = Guest::create([
                    'name' => $guestData['name'],
                    'email' => $guestData['email'],
                    'phone' => $guestData['phone'],
                    'address' => $guestData['address'],
                    'organization' => $mainGuest->organization,
                    'identity_id' => $guestData['identity_id'],
                    'identity_file' => $filePath, // Sama, jika tidak ada file, tetap null
                    'guest_token' => $guestToken, // Gunakan token yang sama
                ]);

                $guestBook->guests()->attach($additionalGuest->id);
            }
        }

        session()->flash('guest_token', $guestToken);
        session()->flash('success', 'Permintaan berhasil dikirim');
        return redirect()->route('landing', ['slug' => $host->organization->slug]);
    }


    public function check(Request $request, $slug)
    {
        // Ambil organisasi berdasarkan slug
        $organization = Organization::where('slug', $slug)->firstOrFail();

        // Default appointments kosong
        $appointments = collect();

        // Proses jika guest_token tersedia di request
        if ($request->has('guest_token')) {
            $guestToken = $request->input('guest_token');

            // Cari appointments berdasarkan guest_token dan organisasi
            $appointments = GuestBook::with('guests')
                ->where('organization_id', $organization->id)
                ->whereHas('guests', function($query) use ($guestToken) {
                    $query->where('guest_token', $guestToken);
                })
                ->get();

            if ($appointments->isEmpty()) {
                return redirect()->back()->with('error', 'Data tidak ditemukan atau tidak sesuai dengan organisasi ini.');
            }
        }

        return view('check', compact('appointments', 'organization'));
    }

    public function show($slug, $guest_token)
    {
        $organization = Organization::where('slug', $slug)->firstOrFail();

        $appointment = GuestBook::with(['guests', 'host', 'organization'])
            ->where('organization_id', $organization->id)
            ->whereHas('guests', function ($query) use ($guest_token) {
                $query->where('guest_token', $guest_token);
            })
            ->first();

        if (!$appointment) {
            return redirect()->route('landing', ['slug' => $slug])->with('error', 'Janji temu tidak ditemukan');
        }

        return view('appointment_details', compact('appointment', 'organization'));
    }


    public function checkin($slug)
    {
        // Ambil organisasi berdasarkan slug
        $organization = Organization::where('slug', $slug)->firstOrFail();

        // Ambil data pengguna jika diperlukan
        $users = User::where('organization_id', $organization->id)->get(); // Mengambil data users

        // Kirim data ke view 'form'
        return view('check-in', compact('organization', 'users'));
    }

    public function checkBySlug($slug)
    {
        // Ambil organisasi berdasarkan slug
        $organization = Organization::where('slug', $slug)->firstOrFail();

        return view('check', compact('organization'));
    }

    public function checkOutPage($slug)
    {
        // Ambil organisasi berdasarkan slug
        $organization = Organization::where('slug', $slug)->firstOrFail();

        // Ambil daftar tamu dengan status "approved" dan "check_in" pada hari ini dengan pagination
        $approvedGuests = GuestBook::with('guests')
            ->where('organization_id', $organization->id)
            ->where('status', 'approved')
            ->whereDate('check_in', Carbon::today()) // Hanya check_in hari ini
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Batasi 5 per halaman

        // Jika Anda ingin mengatur appointment, Anda bisa melakukannya di sini
        $appointment = null; // Atur sesuai kebutuhan Anda

        return view('check_out', compact('organization', 'approvedGuests', 'appointment'));
    }
    public function processCheckOut($slug, $id)
    {
        // Ambil organisasi berdasarkan slug
        $organization = Organization::where('slug', $slug)->firstOrFail();

        // Ambil GuestBook berdasarkan ID
        $guestBook = GuestBook::where('id', $id)
            ->where('organization_id', $organization->id)
            ->where('status', 'approved') // Pastikan status "approved"
            ->whereDate('check_in', Carbon::today()) // Pastikan check_in hari ini
            ->firstOrFail();

        // Ubah status menjadi "done"
        $guestBook->status = 'done';
        $guestBook->save();

        return response()->json(['message' => 'Janji Anda sudah selesai!']);
    }

}
