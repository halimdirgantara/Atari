<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuestBook;
use App\Models\Organization;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Validator;

class CheckOut extends Component
{
    use WithPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'submitRatingAndFeedback'];

    const STATUS_APPROVED = 'approved';
    const STATUS_PROCESS = 'process';
    const STATUS_DONE = 'done';

    public $organization;
    public $slug;
    public $selectedGuestId;
    public $rating;
    public $feedback;
    public $showModal = false;
    public $showRatingModal = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'feedback' => 'required|string|min:10|max:500'
    ];

    protected $messages = [
        'rating.required' => 'Rating harus diisi',
        'rating.integer' => 'Rating harus berupa angka',
        'rating.min' => 'Rating minimal 1',
        'rating.max' => 'Rating maksimal 5',
        'feedback.required' => 'Feedback harus diisi',
        'feedback.min' => 'Feedback minimal 10 karakter',
        'feedback.max' => 'Feedback maksimal 500 karakter'
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->organization = Organization::where('slug', $slug)->firstOrFail();
    }

    public function confirmCheckOut($id)
    {
        $this->selectedGuestId = $id;
        $this->showModal = true;
    }

    public function confirmed()
    {
        $guestBook = GuestBook::find($this->selectedGuestId);

        if ($guestBook && $guestBook->organization_id === $this->organization->id && $guestBook->status === self::STATUS_APPROVED) {
            try {
                $guestBook->update([
                    'status' => self::STATUS_DONE,
                    'check_out' => Carbon::now(),
                ]);

                $this->showModal = false;
                $this->showRatingModal = true;
                $this->dispatch('guestCheckedOut', $this->selectedGuestId);

            } catch (\Exception $e) {
                $this->alert('error', 'Terjadi kesalahan saat proses checkout!');
            }
        }
    }

    public function submitRatingAndFeedback()
    {
        $this->validate();

        try {
            $guestBook = GuestBook::find($this->selectedGuestId);

            if ($guestBook) {
                $guestBook->update([
                    'rating' => $this->rating,
                    'feedback' => $this->feedback,
                ]);

                $this->showRatingModal = false;
                $this->reset(['rating', 'feedback']);

                $this->alert('success', 'Terima kasih atas penilaian Anda!', [
                    'timer' => 100000, // Timer dalam milidetik (5 detik)
                    'position' => 'center', // Posisi di tengah (horizontal dan vertikal)

                ]);
                return redirect()->route('home', ['slug' => $this->slug]);
            }
        } catch (\Exception $e) {
            $this->alert('error', 'Gagal menyimpan rating dan feedback!');
        }
    }

    public function maskOrganization($organization)
    {
        if (!$organization || strlen($organization) <= 6) {
            return 'N/A';
        }

        $firstThree = substr($organization, 0, 3);
        $lastThree = substr($organization, -3);
        $middleLength = strlen($organization) - 6;
        $stars = str_repeat('*', $middleLength);

        return $firstThree . $stars . $lastThree;
    }

    public function render()
    {
        $approvedGuests = GuestBook::with(['guests', 'host', 'organization'])
            ->where('organization_id', $this->organization->id)
            ->where('status', 'approved') // Hanya tamu dengan status approved
            ->whereDate('check_in', Carbon::today()) // Hanya check-in hari ini
            ->orderBy('check_in', 'desc') // Urutkan berdasarkan waktu check-in
            ->paginate(7);


        return view('livewire.check-out', [
            'approvedGuests' => $approvedGuests,
        ])->layout('layouts.app', [
            'slug' => $this->organization->slug,
        ]);
    }

}
