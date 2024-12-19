<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function landing($slug)
    {
        $organization = Organization::where('slug', $slug)->firstOrFail();
        $statusCounts = [
            'approve' => $organization->guestBooks()->where('status', 'approve')->count(),
            'pending' => $organization->guestBooks()->where('status', 'pending')->count(),
            'process' => $organization->guestBooks()->where('status', 'process')->count(),
            'reject' => $organization->guestBooks()->where('status', 'reject')->count(),
        ];

        $visits = $organization->guestBooks()->with('guests')->paginate(10);

        return view('landing', compact('slug','organization', 'statusCounts', 'visits'));
    }

    
}
