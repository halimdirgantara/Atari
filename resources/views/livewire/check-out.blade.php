<div>
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-4 sm:px-11">
            <div class="flex items-center">
                <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
                <h1 class="text-base sm:text-lg font-semibold">BUKU TAMU DARING</h1>
            </div>
        </div>
    </header>
    <main class="container mx-auto mt-8 px-4 sm:px-14">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">Daftar Tamu Disetujui</h2>
                <div class="flex items-center gap-2 text-blue-800">
                    <a href="{{ $slug === null || $slug === 'default' ? route('home') : route('home', ['slug' => $slug]) }}"
                        class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg
                        transition duration-300 ease-in-out transform hover:bg-blue-200 hover:shadow-md hover:text-blue-900 hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                        </svg>
                        <span class="text-sm sm:text-base font-medium">Home</span>
                    </a>
                </div>
            </div>

            @if($approvedGuests->count() > 0)
                <div class="space-y-6">
                    @foreach($approvedGuests as $guestBook)
                        <div id="guest-{{ $guestBook->id }}"
                             class="bg-white rounded-xl border border-gray-100 p-6 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                                <div class="flex items-center mb-4 sm:mb-0">
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-lg">
                                            {{ strtoupper(substr($guestBook->guests->first()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="ml-4 text-center sm:text-left">
                                        <h3 class="font-semibold text-lg text-gray-800">
                                            {{ $guestBook->guests->first()->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500 font-mono">
                                            {{ $this->maskOrganization($guestBook->guests->first()->organization) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-center sm:text-right">
                                    <div class="text-sm text-gray-500 mb-1">Check-in pada</div>
                                    <div class="font-semibold text-blue-600 text-lg">
                                        {{ \Carbon\Carbon::parse($guestBook->check_in)->format('H:i') }}
                                    </div>
                                    <button wire:click="confirmCheckOut({{ $guestBook->id }})"
                                            class="mt-3 bg-red-500 text-white px-4 py-1.5 rounded-lg hover:bg-red-600 transition-all duration-300 text-sm font-medium">
                                        Check-Out
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $approvedGuests->links('pagination::tailwind') }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-48 bg-gray-50 rounded-xl">
                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-gray-500 text-center font-medium">Tidak ada tamu yang bisa checkout saat ini.</p>
                </div>
            @endif
        </div>
    </main>
    @push('scripts')
        <script>
            Livewire.on('guestCheckedOut', guestId => {
                const guestElement = document.getElementById(`guest-${guestId}`);
                if (guestElement) {
                    guestElement.remove();
                }
            });
        </script>
    @endpush
</div>
