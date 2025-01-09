<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GuestBook;
use Carbon\Carbon;

class MarkNotAttend extends Command
{
    protected $signature = 'guestbook:mark-not-attend';
    protected $description = 'Mark guests as Not Attend if they fail to check-out within 20 minutes after the scheduled time';

    public function handle()
    {
        $now = Carbon::now();

        // tamu berstatus "Approved" yang melewati batas waktu check-out + toleransi
        $guests = GuestBook::where('status', 'approved')
            ->where('check_out', '<', $now->subMinutes(10))
            ->get();

        foreach ($guests as $guest) {
            $guest->update(['status' => 'not_attend']);
            $this->info("Guest ID {$guest->id} marked as Not Attend.");
        }

        $this->info('Marking process completed.');
    }
}




// php artisan guestbook:mark-not-attend
// * * * * * php C:/laragon/www/Atari/artisan schedule:run >> /dev/null 2>&1
