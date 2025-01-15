<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\GuestBook;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrganizationController extends Controller
{
    public function landing($slug)
    {
        $organization = Organization::where('slug', $slug)->firstOrFail();

        // Perhitungan status kunjungan berdasarkan organisasi tertentu
        $statusCounts = [
            'pending' => GuestBook::where('organization_id', $organization->id)->where('status', 'pending')->count(),
            'approved' => GuestBook::where('organization_id', $organization->id)->where('status', 'approved')->count(),
            'declined' => GuestBook::where('organization_id', $organization->id)->where('status', 'declined')->count(),
            'process' => GuestBook::where('organization_id', $organization->id)->where('status', 'process')->count(),
            'done' => GuestBook::where('organization_id', $organization->id)->where('status', 'done')->count(),
        ];

        // Ambil kunjungan terbaru berdasarkan organisasi tertentu
        $visits = GuestBook::with('guests')
            ->where('organization_id', $organization->id)
            ->where('status', '!=', 'done')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('landing', compact('slug', 'organization', 'statusCounts', 'visits'));
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

        // Ubah status menjadi "done" dan set waktu check-out
        $guestBook->status = 'done';
        $guestBook->check_out = Carbon::now();
        $guestBook->save();

        return response()->json(['message' => 'Janji Anda sudah selesai!', 'check_out_time' => $guestBook->check_out->format('H:i:s')]);
    }
}
