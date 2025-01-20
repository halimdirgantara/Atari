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

    <div class="container mx-auto px-4 sm:px-14 py-6 relative">
        <div class="bg-white  shadow-2xl p-8 border-t-4 border-blue-900 rounded-lg relative flex flex-col gap-4">
            <!-- Title Section with Appointment ID -->
            <div class="flex justify-between items-center mb-6 flex-col sm:flex-row">
                <div class="flex flex-col items-center sm:items-start">
                    <div class="flex items-center justify-center sm:justify-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h2 class="text-2xl sm:text-3xl font-semibold bg-gradient-to-r from-black to-red-600 bg-clip-text text-transparent">
                            Detail Janji Temu
                        </h2>
                    </div>

                    <!-- Subtitle dengan Ikon Info -->
                    <div class="flex items-center justify-center sm:justify-start space-x-2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm sm:text-base text-gray-600">
                            Informasi lebih lanjut tentang janji temu Anda.
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

            <!-- Status Card -->
            <div class="mb-6 bg-gray-100 shadow-sm rounded-lg p-4 flex justify-between items-center flex-col sm:flex-row">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Status Kunjungan</h3>
                    @php
                        $statusClass = match($appointment->status) {
                            'approved' => 'bg-green-600 text-white',
                            'pending' => 'bg-yellow-500 text-white',
                            'process' => 'bg-blue-600 text-white',
                            'declined' => 'bg-red-500 text-white',
                            'done' => 'bg-green-600 text-white',
                            default => 'bg-gray-300 text-gray-800',
                        };
                    @endphp
                    <div class="mt-2">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                </div>
                <div class="text-right mt-4 sm:mt-0">
                    <span class="block text-sm text-gray-600">Dibuat pada:</span>
                    <span class="block font-medium">{{ \Carbon\Carbon::parse($appointment->created_at)->format('d M Y H:i') }}</span>
                </div>
            </div>

            <!-- Guest Information Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-blue-800 mb-4">Informasi Tamu</h3>
                @foreach($appointment->guests as $index => $guest)
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 border-l-4 {{ $index === 0 ? 'border-blue-500' : 'border-gray-300' }}">
                        <h4 class="font-semibold text-lg text-blue-900 mb-4">
                            {{ $index === 0 ? 'Tamu Utama' : 'Tamu ' . ($index + 1) }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                            <div class="space-y-4">
                                <span class="text-gray-600 font-medium">Nama</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300 overflow-hidden">{{ $guest->name }}</div>

                                <span class="text-gray-600 font-medium">Email</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300 overflow-hidden">{{ $guest->email }}</div>
                            </div>
                            <div class="space-y-4">
                                <span class="text-gray-600 font-medium">Telepon</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300 overflow-hidden">
                                    @php
                                        $phone = $guest->phone;
                                        $phoneFormatted = strlen($phone) > 6
                                            ? substr($phone, 0, 3) . str_repeat('*', strlen($phone) - 6) . substr($phone, -3)
                                            : $phone;
                                    @endphp
                                    {{ $phoneFormatted }}
                                </div>

                                <span class="text-gray-600 font-medium">NIK</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300 overflow-hidden">
                                    @php
                                        $identity = $guest->identity_id;
                                        $identityFormatted = strlen($identity) > 6
                                            ? substr($identity, 0, 3) . str_repeat('*', strlen($identity) - 6) . substr($identity, -3)
                                            : $identity;
                                    @endphp
                                    {{ $identityFormatted }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Additional Information Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-blue-800 mb-4">Informasi Kunjungan</h3>
                <div class="bg-gray-100 rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                        <div class="space-y-2">
                            <span class="text-gray-600 font-medium block">Organisasi</span>
                            <div class="bg-white rounded-lg p-3 border border-gray-300 text-gray-800 overflow-hidden">{{ $guest->organization }}</div>
                        </div>
                        <div class="space-y-2">
                            <span class="text-gray-600 font-medium block">Tanggal Check-In</span>
                            <div class="bg-white rounded-lg p-3 border border-gray-300 text-gray-800 overflow-hidden">{{ \Carbon\Carbon::parse($appointment->check_in)->format('d M Y H:i') }}</div>
                        </div>
                        <div class="space-y-2">
                            <span class="text-gray-600 font-medium block">Bertemu Dengan</span>
                            <div class="bg-white rounded-lg p-3 border border-gray-300 text-gray-800 overflow-hidden">{{ $appointment->host->name ?? 'Tidak Diketahui' }}</div>
                        </div>
                        <div class="space-y-2">
                            <span class="text-gray-600 font-medium block">Tanggal Check-Out</span>
                            <div class="bg-white rounded-lg p-3 border border-gray-300 text-gray-800 overflow-hidden">{{ \Carbon\Carbon::parse($appointment->check_out)->format('d M Y H:i') }}</div>
                        </div>
                        <div class="space-y-2 sm:col-span-2">
                            <span class="text-gray-600 font-medium block">Keperluan</span>
                            <div class="bg-white rounded-lg p-3 border border-gray-300 text-gray-800 break-words whitespace-normal overflow-hidden">
                                {{ $appointment->needs }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
