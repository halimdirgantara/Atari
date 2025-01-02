<div>
    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-4 sm:px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
            <h1 class="text-base sm:text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-4 sm:px-14">
        <div class="bg-white rounded-lg shadow-lg p-8 relative flex flex-col gap-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <h2 class="text-2xl font-semibold text-blue-900">Daftar Tamu yang Disetujui Hari Ini</h2>

                <!-- Home Icon Button -->
                <div class="mt-4 md:mt-0 text-blue-800">
                    <a href="{{ route('home', ['slug' => $slug]) }}"
                        class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg hover:bg-blue-200 hover:shadow-md hover:text-blue-900 transition-all duration-300">
                        <i class="fas fa-home"></i>
                        <span class="font-medium">Beranda</span>
                    </a>
                </div>
            </div>

            @if($approvedGuests->count() > 0)
                <div class="space-y-6">
                    @foreach($approvedGuests as $guestBook)
                        @php
                            $mainGuest = $guestBook->guests->first();
                        @endphp
                        <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-lg flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                            <div class="flex-1 space-y-4">
                                <div class="grid grid-cols-1 gap-2">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                        <span class="font-medium text-gray-800 sm:min-w-[120px]">Nama</span>
                                        <span class="text-gray-700">: {{ $mainGuest->name }}</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                        <span class="font-medium text-gray-800 sm:min-w-[120px]">Organisasi</span>
                                        <span class="text-gray-700">: {{ $mainGuest->organization ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                        <span class="font-medium text-gray-800 sm:min-w-[120px]">Waktu Check-In</span>
                                        <span class="text-gray-700">: {{ $guestBook->check_in }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 mt-4 md:mt-0 w-full md:w-auto">
                                <button wire:click="processCheckOut({{ $guestBook->id }})"
                                    class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-all duration-300 w-full md:w-auto">
                                    Check-Out
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $approvedGuests->links('pagination::tailwind') }}
                </div>
            @else
                <div class="flex justify-center items-center h-48">
                    <p class="text-gray-500 text-center">Tidak ada tamu yang disetujui hari ini.</p>
                </div>
            @endif
        </div>
    </main>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', () => {
        window.addEventListener('alert', event => {
            Swal.fire({
                icon: event.detail.type,
                title: event.detail.message,
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false,
            });
        });
    });
</script>
@endpush
