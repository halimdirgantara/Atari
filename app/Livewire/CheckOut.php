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

    protected $listeners = ['confirmed'];

    const STATUS_APPROVED = 'approved';
    const STATUS_PROCESS = 'process';
    const STATUS_DONE = 'done';

    public $organization;
    public $slug;
    public $selectedGuestId;

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

                $checkoutTime = Carbon::now()->format('H:i:s');
                $this->alert('success', 'Janji Anda Telah Selesai', [
                    'position' => 'center',
                    'timer' => null,
                    'toast' => false,
                    'showConfirmButton' => false,
                    'showCancelButton' => false,
                    'allowOutsideClick' => false,
                    'html' => '
                        <p>Anda berhasil di-checkout pada:</p>
                        <div class="bg-gray-100 p-3 rounded-lg mt-3 flex justify-between items-center">
                            <span class="font-mono text-blue-700 font-semibold">' . $checkoutTime . '</span>
                            <button
                                class="bg-blue-500 text-white px-3 py-1 ml-3 rounded hover:bg-blue-600"
                                onclick="window.location.href=\'/' . $this->slug . '\'"
                            >
                                OK
                            </button>
                        </div>
                    '

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
