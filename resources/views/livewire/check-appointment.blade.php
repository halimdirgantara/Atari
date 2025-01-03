<div>
    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-10 mr-4">
            <h1 class="text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

    <!-- Cek Janji Section -->
    <section class="container mx-auto mt-8 px-14">
        <div class="bg-white rounded-lg shadow-lg p-8 border-t-4 border-blue-900 relative flex flex-col gap-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-blue-900">Cek Janji</h2>
                    <p class="text-gray-600">Pantau status janji temu Anda</p>
                </div>
                <div class="mt-4 sm:mt-0 text-blue-800">
                    <a href="{{ route('home', ['slug' => $organization->slug]) }}" class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg hover:bg-blue-200 hover:shadow-md transition-all duration-300 text-blue-800 hover:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                        </svg>
                        <span class="font-medium">Beranda</span>
                    </a>
                </div>
            </div>
            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <span class="material-icons text-blue-600 mr-3">info</span>
                    <p class="text-sm text-blue-800">Masukkan guest token Anda untuk melihat detail janji temu.</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex items-center border-2 border-gray-300 rounded-lg px-4 py-3 w-full hover:border-blue-500 transition-colors duration-300">
                    <span class="material-icons text-gray-500 mr-3">badge</span>
                    <input type="text" wire:model="guest_token"
                           class="w-full border-none focus:ring-0 bg-transparent placeholder-gray-400"
                           placeholder="Masukkan token tamu" required>
                </div>
                <button wire:click="checkAppointments"
                        class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 flex items-center min-w-[120px] shadow-md hover:shadow-lg">
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
                <h2 class="text-2xl font-semibold text-blue-900">Daftar Janji Temu Anda</h2>
            </div>
            <div class="space-y-6">
                @foreach ($appointments as $appointment)
                    <a href="{{ route('appointment-details', ['slug' => $organization->slug, 'guest_token' => $appointment->guests->first()->guest_token]) }}"
                        class="block bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden transform hover:scale-[1.02] border border-gray-100">
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
                                                    'process' => 'bg-blue-600 text-white',
                                                    'declined' => 'bg-red-500 text-white',
                                                    'done' => 'bg-green-600 text-white',
                                                    default => 'bg-gray-200 text-gray-800 border-gray-500'
                                                };
                                                $statusIcon = match($appointment->status) {
                                                    'approved' => 'check_circle',
                                                    'pending' => 'hourglass_empty',
                                                    'process' => 'refresh',
                                                    'declined' => 'cancel',
                                                    'done' => 'assignment_turned_in',
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

                                    <!-- Daftar Tamu Tambahan -->
                                    @if($appointment->guests->count() > 1)
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-start">
                                                <span class="material-icons text-gray-500 mr-3">group</span>
                                                <div class="w-full">
                                                    <p class="text-sm font-medium text-gray-700 mb-2">
                                                        Tamu Tambahan ({{ $appointment->guests->count() - 1 }})
                                                    </p>
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
                            <span class="text-sm text-gray-600">Klik untuk melihat detail lengkap</span>
                            <span class="material-icons text-gray-400">chevron_right</span>
                        </div>
                    </a>

                @endforeach
            </div>
        </section>
    @endif
</div>
