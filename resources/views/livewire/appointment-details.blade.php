<div>
    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-10 mr-4">
            <h1 class="text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>
    <div class="container mx-auto px-4 sm:px-14 py-6 relative">
        <div class="bg-white rounded-lg shadow-2xl p-8">
            <!-- Title Section with Appointment ID -->
            <div class="flex justify-between items-center mb-6 flex-col sm:flex-row">
                <div>
                    <h2 class="text-3xl font-semibold text-blue-900 text-center sm:text-left">Detail Janji Temu</h2>
                </div>
                <div class="mt-4 sm:mt-0 sm:top-11 sm:right-16">
                    <a href="{{ route('home', ['slug' => $appointment->organization->slug]) }}" class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg hover:bg-blue-200 hover:shadow-md transition-all duration-300 text-blue-800 hover:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                        </svg>
                        <span class="font-medium">Home</span>
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
                        <p class="mt-2 text-sm text-gray-600">{{ $appointment->needs }}</p>
                    </div>
                </div>
                <div class="text-right mt-4 sm:mt-0">
                    <span class="block text-sm text-gray-600">Dibuat pada:</span>
                    <span class="block font-medium">{{ \Carbon\Carbon::parse($appointment->created_at)->format('d M Y H:i') }}</span>
                    <span class="block text-sm text-gray-600">Terakhir diperbarui:</span>
                    <span class="block font-medium">{{ \Carbon\Carbon::parse($appointment->updated_at)->format('d M Y H:i') }}</span>
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
