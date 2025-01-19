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

    <!-- Cek Janji Section -->
    <section class="container mx-auto mt-8 px-14">
        <div class="bg-white rounded-lg shadow-lg p-8 border-t-4 border-blue-900 relative flex flex-col gap-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-col items-center sm:items-start">
                    <div class="flex items-center justify-center sm:justify-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h2 class="text-2xl sm:text-3xl font-semibold bg-gradient-to-r from-black to-red-600 bg-clip-text text-transparent">
                            Cek Janji
                        </h2>
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
            <div class="flex items-center justify-center sm:justify-start space-x-2 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm sm:text-base text-gray-600">
                    Masukkan guest token Anda untuk melihat detail janji kunjungan
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex items-center border-2 border-gray-300 rounded-lg px-4 py-3 w-full hover:border-blue-500 transition-colors duration-300">
                    <span class="material-icons text-gray-500 mr-3">badge</span>
                    <input type="text" wire:model="guest_token"
                           class="w-full border-none focus:ring-0 bg-transparent placeholder-gray-400"
                           placeholder="Masukkan token tamu" required>
                </div>
                <button wire:click="checkAppointments"
                        class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-900 transform hover:scale-105 transition-all duration-300 flex items-center min-w-[120px] shadow-md hover:shadow-lg">
                    <span class="material-icons mr-2">search</span>
                    Cari
                </button>
            </div>
        </div>
    </section>

    <!-- Daftar Janji -->
    @if ($appointments && $appointments->isNotEmpty())
    <section class="container mx-auto mt-8 px-4 sm:px-14 mb-8">
        <div class="flex items-center mb-6">
            <span class="material-icons text-blue-900 text-3xl mr-3">list_alt</span>
            <h2 class="text-2xl font-semibold text-blue-900">Janji Temu Anda</h2>
        </div>
        <div class="space-y-6">
            @foreach ($appointments as $appointment)
                <div class="block bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden transform hover:scale-[1.02] border border-gray-100">
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center mb-4">
                            <div class="flex items-start sm:items-center mb-4 sm:mb-0">
                                <span class="material-icons text-gray-500 mr-3">event</span>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        @if(isset($appointment->status))
                                        @php
                                            $statusClass = match($appointment->status) {
                                                'approved' => 'bg-green-600 text-white',
                                                'pending' => 'bg-yellow-500 text-white',
                                                'process' => 'bg-blue-500 text-white',
                                                'declined' => 'bg-red-600 text-white',
                                                'done' => 'bg-green-700 text-white',
                                                default => 'bg-gray-200 text-gray-800 border-gray-500'
                                            };
                                            $statusIcon = match($appointment->status) {
                                                'approved' => 'check_circle',
                                                'pending' => 'hourglass_empty',
                                                'process' => 'autorenew',
                                                'declined' => 'cancel',
                                                'done' => 'task',
                                                default => 'help'
                                            };
                                        @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $statusClass }}">
                                                <span class="material-icons text-sm mr-1">{{ $statusIcon }}</span>
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-left sm:text-right w-full sm:w-auto">
                                <div class="bg-blue-50 rounded-lg px-4 py-2">
                                    <p class="font-semibold text-blue-900">{{ \Carbon\Carbon::parse($appointment->check_in)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->check_out)->format('H:i') }}</p>
                                    <p class="text-sm text-blue-600">{{ \Carbon\Carbon::parse($appointment->check_in)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        @if($appointment->guests && $appointment->guests->isNotEmpty())
                            <!-- Informasi Tamu -->
                            <div class="mt-4 space-y-4">
                                <!-- Tamu Utama -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-start">
                                        <span class="material-icons text-blue-600 mr-3">person</span>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $appointment->guests->first()->name }}</p>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                                    Tamu Utama
                                                </span>
                                                <span class="ml-2">{{ $appointment->guests->first()->organization }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Daftar Tamu Tambahan dengan Dropdown -->
                                @if($appointment->guests->count() > 1)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-start">
                                            <span class="material-icons text-gray-500 mr-3">group</span>
                                            <div class="w-full">
                                                <button onclick="toggleDropdown({{ $appointment->id }})"
                                                    class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                    Tamu Tambahan ({{ $appointment->guests->count() - 1 }})
                                                    <span id="dropdown-icon-{{ $appointment->id }}" class="material-icons ml-2 text-gray-500">expand_more</span>
                                                </button>
                                                <div id="dropdown-{{ $appointment->id }}" class="hidden mt-3">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                        @foreach($appointment->guests->skip(1) as $additionalGuest)
                                                            <div class="flex items-center bg-white rounded p-2">
                                                                <span class="material-icons text-gray-400 text-sm mr-2">person_outline</span>
                                                                <span class="text-sm">{{ $additionalGuest->name }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="mt-4 bg-red-50 rounded-lg p-4 flex items-center">
                                <span class="material-icons text-red-500 mr-2">error</span>
                                <p class="text-red-600 font-medium">Data tamu tidak ditemukan</p>
                            </div>
                        @endif
                    </div>

                    <!-- Footer dengan Instruksi -->
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between">
                        <a href="{{ route('appointment-details', ['slug' => $organization->slug, 'guest_token' => $appointment->guests->first()->guest_token]) }}"
                        class="flex items-center text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-300 transition duration-200 ease-in-out rounded-md p-2">
                            Klik untuk melihat detail lengkap
                            <span class="material-icons text-gray-400 ml-2">chevron_right</span>
                        </a>
                    </div>
                </div>

            @endforeach
        </div>
    </section>
    @endif
    @push('scripts')
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`dropdown-${id}`);
            const icon = document.getElementById(`dropdown-icon-${id}`);

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                icon.textContent = 'expand_less';
            } else {
                dropdown.classList.add('hidden');
                icon.textContent = 'expand_more';
            }
        }
        </script>
    @endpush



</div>
