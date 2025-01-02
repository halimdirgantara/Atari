<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuestBook;
use App\Models\Organization;
use Carbon\Carbon;

class CheckOutAppointment extends Component
{
    use WithPagination;

    public $organization;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->organization = Organization::where('slug', $slug)->firstOrFail();
    }

    public function processCheckOut($id)
    {
        $guestBook = GuestBook::where('id', $id)
            ->where('organization_id', $this->organization->id)
            ->where('status', 'approved')
            ->whereDate('check_in', Carbon::today())
            ->first();

        if ($guestBook) {
            $guestBook->status = 'done';
            $guestBook->check_out = Carbon::now(); // Set waktu check-out
            $guestBook->save();

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Janji berhasil di-check-out pada ' . $guestBook->check_out->format('H:i:s'),
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat proses check-out.',
            ]);
        }
    }

    public function render()
    {
        $approvedGuests = GuestBook::with('guests')
            ->where('organization_id', $this->organization->id)
            ->where('status', 'approved') // Pastikan status ini sesuai
            ->whereDate('check_in', Carbon::today()) // Pastikan tanggal ini sesuai
            ->paginate(5);

        return view('livewire.check-out', [
            'approvedGuests' => $approvedGuests,
        ])->layout('layouts.app', [
            'slug' => $this->organization->slug,
        ]);
    }

}
