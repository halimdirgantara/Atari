<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestBook;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Pastikan untuk menambahkan ini

class GuestBookController extends Controller
{
    public function index()
    {
        // Mengambil data visits dengan relasi guests dan paginate
        $visits = GuestBook::with('guests')->paginate(5); // Adjust the number as needed

        // Menghitung jumlah status berdasarkan status
        $statusCounts = [
            'approve' => GuestBook::where('status', 'Approve')->count(),
            'pending' => GuestBook::where('status', 'Pending')->count(),
            'process' => GuestBook::where('status', 'Process')->count(),
            'reject' => GuestBook::where('status', 'Reject')->count(),
        ];

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


        $host = User::find($request->host_id);

        if (!$host || is_null($host->organization)) {
            // Jika host tidak ada atau tidak memiliki organisasi, tangani error atau beri pesan
            return redirect()->back()->with('error', 'Host atau organisasi tidak ditemukan.');
        }

        // Ambil ID organisasi pertama yang terhubung dengan pengguna
        $organization_id = $host->organization->first()->id;

        // create guest book
        $guestBook = GuestBook::create([
            'host_id' => $request->host_id ?? auth()->id(),
            'organization_id' => $organization_id,//User::find( $request->host_id )->organizations->first()->id,
            'needs' => $request->needs,
            'check_in' => now(),
            'check_out' => $request->check_out,
            'status' => 'process',
            'guest_id' => $guest->id,
        ]);


        //Sync relasi
        $guestBook->guests()->attach($guest->id);



        return redirect()->route('landing')->with('success', 'Permintaan berhasil dikirim');



    }

    public function check(Request $request)
    {
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
                // Dapatkan status janji temu pertama (semua janji temu tamu memiliki status yang sama)
                $status = $appointments->first()->status;
            } else {
                // Jika tidak ada janji temu yang ditemukan, simpan pesan error
                $errorMessage = 'Data Tidak Ditemukan';
            }
        }

        // Kirim status, appointments, dan errorMessage ke view
        return view('check', compact('status', 'appointments', 'errorMessage'));
    }



}
