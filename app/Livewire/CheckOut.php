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
                // Update status dan checkout time
                $guestBook->update([
                    'status' => self::STATUS_DONE,
                    'check_out' => Carbon::now(),
                ]);

                // Tampilkan form rating
                $this->alert('success', 'Janji Anda Sudah Selesai!', [
                    'position' => 'center',
                    'timer' => null,
                    'toast' => false,
                    'showConfirmButton' => true,
                    'showCancelButton' => false,
                    'html' => '
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200">
                            <div class="flex items-center justify-center mb-4">
                            </div>
                            <p class="text-center text-gray-600 mb-6">Silakan beri rating dan feedback Anda di bawah ini:</p>

                            <form id="ratingForm" class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                                <div class="mb-5">
                                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                    <select id="rating" wire:model.defer="rating"
                                        class="block w-full rounded-md border-gray-300 py-2.5 pl-3 pr-10 text-gray-700
                                        focus:border-blue-500 focus:outline-none focus:ring-blue-500 transition-colors
                                        hover:border-gray-400">
                                        <option value="" class="text-gray-500">Pilih Rating</option>
                                        <option value="1" class="bg-red-50 hover:bg-red-100">Sangat Buruk</option>
                                        <option value="2" class="bg-orange-50 hover:bg-orange-100">Buruk</option>
                                        <option value="3" class="bg-yellow-50 hover:bg-yellow-100">Cukup</option>
                                        <option value="4" class="bg-green-50 hover:bg-green-100">Baik</option>
                                        <option value="5" class="bg-emerald-50 hover:bg-emerald-100">Sangat Baik</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                                    <textarea id="feedback"
                                        class="block w-full rounded-md border-gray-300 shadow-sm
                                        focus:border-blue-500 focus:ring-blue-500 transition-colors
                                        hover:border-gray-400 resize-none"
                                        rows="4"
                                        placeholder="Tuliskan feedback Anda di sini..."
                                        wire:model.defer="feedback">
                                    </textarea>
                                </div>
                            </form>
                        </div>
                    ',
                    'confirmButtonText' => 'Kirim',
                    'confirmButtonColor' => '#10B981',
                    'onConfirmed' => 'submitRatingAndFeedback',
                    'inputAttributes' => [
                        'rating' => 'rating',
                        'feedback' => 'feedback',
                    ],
                    'allowOutsideClick' => false,
                    'customClass' => [
                        'container' => 'max-w-lg',
                        'popup' => 'rounded-xl p-0',
                        'confirmButton' => 'px-6 py-2.5 font-medium text-sm rounded-lg'
                    ]
                ]);
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

    public function submitRatingAndFeedback($rating, $feedback)
    {
        dd($rating, $feedback);
        try {
            $guestBook = GuestBook::find($this->selectedGuestId);

            if ($guestBook) {
                $guestBook->update([
                    'rating' => $this->rating,
                    'feedback' => $this->feedback,
                ]);

                $this->alert('success', 'Terima kasih atas feedback Anda!', [
                    'position' => 'center',
                    'timer' => null,
                    'toast' => false,
                    'showConfirmButton' => true,
                    'showCancelButton' => false,
                    'confirmButtonText' => 'OK',
                    'confirmButtonColor' => '#10B981',
                    'allowOutsideClick' => false,
                    'didOpen' => "() => {
                        const confirmButton = document.querySelector('.swal2-confirm');
                        if (confirmButton) {
                            confirmButton.onclick = () => window.location.href = '" . route('home', ['slug' => $this->slug]) . "'
                        }
                    }",
                    'html' => '
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200">
                            <div class="flex items-center justify-center mb-4">
                                <div class="bg-green-100 rounded-full p-3">
                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-center text-lg font-medium text-green-800">Terima kasih atas feedback Anda!</p>
                            <p class="text-center text-gray-600 mt-2">Feedback Anda sangat berarti untuk peningkatan layanan kami.</p>
                        </div>
                    ',
                    'customClass' => [
                        'container' => 'max-w-lg',
                        'popup' => 'rounded-xl p-0',
                        'confirmButton' => 'px-6 py-2.5 font-medium text-sm rounded-lg'
                    ]
                ]);


            }
        } catch (\Exception $e) {
            $this->alert('error', 'Gagal menyimpan rating dan feedback!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
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
