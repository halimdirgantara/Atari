<div>
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-5 sm:px-11">
            <div class="flex items-center">
                <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
                <h1 class="text-base sm:text-lg font-semibold">{{ $organization->name }}</h1>
            </div>
            <!-- Home Button for Mobile dengan Desain Modern -->
            <div class="flex sm:hidden">
                <a href="{{ route('home', ['slug' => $organization->slug]) }}"
                    class="flex items-center gap-2 px-4 py-1.5 bg-blue-100 text-blue-900 rounded-lg transition-all duration-300 ease-in-out transform hover:bg-amber-500 hover:shadow-md hover:scale-105 border-2 border-amber-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>
    <main class="container mx-auto mt-8 px-4 sm:px-14">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="flex justify-between items-center mb-6 flex-col sm:flex-row">
                <div class="flex flex-col items-center sm:items-start">
                    <div class="flex items-center justify-center sm:justify-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h2 class="text-2xl sm:text-3xl font-semibold bg-gradient-to-r from-black to-red-600 bg-clip-text text-transparent">
                            Check-out Tamu
                        </h2>
                    </div>

                    <!-- Subtitle dengan Ikon Info -->
                    <div class="flex items-center justify-center sm:justify-start space-x-2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm sm:text-base text-gray-600">
                            Informasi lebih lanjut tentang check-out Anda.
                        </p>
                    </div>
                </div>

                <div class="mt-4 sm:mt-0 flex-shrink-0 flex items-center justify-center sm:justify-start gap-2 text-blue-800 hidden sm:flex">
                    <a href="{{ route('home', ['slug' => $organization->slug]) }}"
                        class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg transition duration-300 ease-in-out transform hover:bg-blue-200 hover:shadow-md hover:text-blue-900 hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                        </svg>
                        <span class="hidden sm:inline text-sm sm:text-base font-medium">Home</span>
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
                                    <div class="h-8 w-8 sm:h-10 sm:w-10 md:h-12 md:w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-xs sm:text-sm md:text-lg">
                                            {{ strtoupper(substr($guestBook->guests->first()->name, 0, 1)) }}
                                        </span>
                                    </div>

                                    <div class="ml-4 text-center sm:text-left">
                                        <h3 class="font-semibold text-lg text-gray-800">
                                            {{ $guestBook->guests->first()->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500 font-mono truncate sm:whitespace-normal break-words sm:max-w-none max-w-[150px]">
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
    <!-- Confirmation Modal -->
    <div x-show="$wire.showModal"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full p-8"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4">
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Konfirmasi Check-out</h3>
                    <p class="text-sm text-gray-600">Apakah Anda yakin ingin melakukan check-out?</p>
                </div>
                <div class="mt-6 flex justify-center space-x-3">
                    <button wire:click="$set('showModal', false)"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                    <button wire:click="confirmed"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-800 transition duration-200">
                        Ya, Check-out
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Rating Modal -->
    <div x-show="$wire.showRatingModal"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full p-6"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4">

                <!-- Alert Section -->
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Janji Anda Sudah Selesai!</strong>
                    <span class="block sm:inline">Silakan beri rating dan feedback Anda di bawah ini.</span>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition-transform transform hover:scale-110 border border-transparent hover:border-yellow-400 rounded-md p-1">
                                <svg class="w-8 h-8 {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-200"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        @endfor
                    </div>
                    @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                    <textarea wire:model.defer="feedback" rows="4" class="w-full rounded-md border border-gray-400 focus:border-blue-500 focus:ring focus:ring-blue-200 p-4" placeholder="Berikan feedback Anda..."></textarea>
                    @error('feedback') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-center space ```html
                <div class="flex justify-center space-x-3">
                    <button wire:click="submitRatingAndFeedback" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-900">
                        Kirim
                    </button>
                </div>
            </div>
        </div>
    </div>


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
