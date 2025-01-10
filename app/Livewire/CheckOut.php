<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuestBook;
use App\Models\Organization;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckOut extends Component
{
    use WithPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'showCompleteAlert', 'submitFeedback'];


    const STATUS_APPROVED = 'approved';
    const STATUS_PROCESS = 'process';
    const STATUS_DONE = 'done';

    public $organization;
    public $slug;
    public $selectedGuestId;

    public $rating;
    public $feedback;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->organization = Organization::where('slug', $slug)->firstOrFail();
    }

    public function confirmCheckOut($id)
    {
        $this->selectedGuestId = $id;

        $this->alert('warning', 'Yakin ingin checkout?', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Ya, Checkout',
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false
        ]);
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

                $this->emit('showCompleteAlert'); // Emit event untuk alert "Janji selesai"

            } catch (\Exception $e) {
                $this->alert('error', 'Terjadi kesalahan saat proses checkout!', [
                    'position' => 'center',
                    'timer' => null,
                    'toast' => false,
                    'showConfirmButton' => false,
                    'showCancelButton' => false,
                    'allowOutsideClick' => false,
                    'html' => '
                        <p class="text-red-600">Mohon coba lagi beberapa saat.</p>
                        <div class="mt-3">
                            <button
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                                onclick="Swal.close()"
                            >
                                Tutup
                            </button>
                        </div>
                    '
                ]);
            }
        } else {
            $this->alert('error', 'Terjadi kesalahan!', [
                'position' => 'center',
                'timer' => null,
                'toast' => false,
                'showConfirmButton' => false,
                'showCancelButton' => false,
                'allowOutsideClick' => false,
                'html' => '
                    <p class="text-red-600">Tamu tidak ditemukan atau status tidak valid.</p>
                    <div class="mt-3">
                        <button
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                            onclick="Swal.close()"
                        >
                            Tutup
                        </button>
                    </div>
                '
            ]);
        }
    }

    public function showCompleteAlert()
    {
        $checkoutTime = Carbon::now()->format('H:i:s');
        $this->alert('success', 'Janji Anda Telah Selesai', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Lanjutkan',
            'onConfirmed' => 'showRatingFeedbackAlert', // Lanjut ke alert rating dan feedback
            'allowOutsideClick' => false,
            'html' => '
                <p>Anda berhasil di-checkout pada:</p>
                <div class="bg-gray-100 p-3 rounded-lg mt-3 flex justify-between items-center">
                    <span class="font-mono text-blue-700 font-semibold">' . $checkoutTime . '</span>
                </div>
            '
        ]);
    }

    public function showRatingFeedbackAlert()
    {
        $this->alert('warning', 'Beri Penilaian dan Masukan', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Kirim Rating',
            'onConfirmed' => null,
            'html' => '
                <div>
                    <label for="ratingStars" class="block font-semibold mb-2">Beri Rating:</label>
                    <div id="ratingStars" class="flex justify-center gap-2 mb-4">
                        <span class="star cursor-pointer text-gray-400 hover:text-yellow-400 text-3xl" data-value="1">★</span>
                        <span class="star cursor-pointer text-gray-400 hover:text-yellow-400 text-3xl" data-value="2">★</span>
                        <span class="star cursor-pointer text-gray-400 hover:text-yellow-400 text-3xl" data-value="3">★</span>
                        <span class="star cursor-pointer text-gray-400 hover:text-yellow-400 text-3xl" data-value="4">★</span>
                        <span class="star cursor-pointer text-gray-400 hover:text-yellow-400 text-3xl" data-value="5">★</span>
                    </div>
                    <label for="feedbackInput" class="block font-semibold">Masukkan Feedback:</label>
                    <textarea id="feedbackInput" class="swal2-textarea border border-gray-300 rounded-md focus:ring focus:ring-blue-400" placeholder="Masukkan feedback Anda"></textarea>
                </div>
            ',
            'didOpen' => '() => {
                document.querySelectorAll(".star").forEach(star => {
                    star.addEventListener("click", () => {
                        const value = star.getAttribute("data-value");
                        document.querySelectorAll(".star").forEach(s => {
                            s.classList.remove("text-yellow-400");
                            s.classList.add("text-gray-400");
                            if (s.getAttribute("data-value") <= value) {
                                s.classList.remove("text-gray-400");
                                s.classList.add("text-yellow-400");
                            }
                        });
                    });
                });
            }',
            'preConfirm' => '() => {
                const stars = document.querySelectorAll(".star");
                let rating = 0;
                stars.forEach(star => {
                    if (star.classList.contains("text-yellow-400")) {
                        rating = star.getAttribute("data-value");
                    }
                });
                const feedback = document.getElementById("feedbackInput").value;
                if (!rating || rating < 1 || rating > 5 || !feedback) {
                    Swal.showValidationMessage("Rating harus 1-5 dan Feedback tidak boleh kosong.");
                    return false;
                }
                Livewire.emit("submitFeedback", { rating: parseInt(rating), feedback: feedback }); // Kirim data
            }',

            'allowOutsideClick' => false
        ]);
    }

    public function submitFeedback($data)
    {
        $guestBook = GuestBook::find($this->selectedGuestId);

        if ($guestBook) {
            $guestBook->update([
                'rating' => $data['rating'],
                'feedback' => $data['feedback'],
            ]);

            $this->alert('success', 'Rating dan Feedback terkirim!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => false,
                'allowOutsideClick' => false,
            ]);

            return redirect('/');
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
            ->where('status', self::STATUS_APPROVED)
            ->whereDate('check_in', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.check-out', [
            'approvedGuests' => $approvedGuests,
        ])->layout('layouts.app', [
            'slug' => $this->organization->slug,
        ]);
    }
}
