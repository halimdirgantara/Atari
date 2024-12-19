@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-14 py-6 relative">
        <div class="bg-white rounded-lg shadow-2xl p-8">
            <!-- Title Section with Appointment ID -->
            <div class="flex justify-between items-center mb-6 flex-col sm:flex-row">
                <div>
                    <h2 class="text-3xl font-semibold text-blue-900 text-center sm:text-left">Detail Janji Temu</h2>
                </div>
                <!-- Home Icon Button -->
                <div class="mt-4 sm:mt-0 sm:top-11 sm:right-16">
                    <a href="{{ route('landing', ['slug' => $appointment->organization->slug]) }}" class="flex items-center gap-2 text-blue-800 hover:text-blue-900 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                        </svg>
                        <span class="font-medium">Beranda</span>
                    </a>

                </div>
            </div>

            <!-- Status Card -->
            <div class="mb-6 bg-gray-100 bg shadow-sm rounded-lg p-4 flex justify-between items-center flex-col sm:flex-row">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Status Kunjungan</h3>
                    @php
                        $statusClass = match($appointment->status) {
                            'approved' => 'bg-green-600 text-white',  // Hijau lebih lembut
                            'pending' => 'bg-yellow-500 text-white', // Kuning lebih cerah
                            'process' => 'bg-blue-600 text-white',   // Biru lebih kuat
                            'declined' => 'bg-red-500 text-white',     // Merah lebih cerah
                            default => 'bg-gray-300 text-gray-800'   // Abu-abu lebih terang jika status tidak diketahui
                        };

                        $statusDescription = match($appointment->status) {
                            'approved' => 'Kunjungan telah disetujui',
                            'pending' => 'Menunggu persetujuan',
                            'process' => 'Sedang dalam proses',
                            'declined' => 'Kunjungan ditolak',
                            default => 'Status tidak diketahui'
                        };
                    @endphp
                    <div class="mt-2">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $statusClass }}">
                            <span class="mr-2">●</span>
                            {{ ucfirst($appointment->status) }}
                        </span>
                        <p class="mt-2 text-sm text-gray-600">{{ $statusDescription }}</p>
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
                <h3 class="text-xl font-semibold text-blue-800 mb-4 flex items-center justify-center sm:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informasi Tamu
                </h3>

                @foreach($appointment->guests as $index => $guest)
                <div class="bg-gray-100 rounded-lg p-4 mb-4 border-l-4 {{ $index === 0 ? 'border-blue-500' : 'border-gray-300' }}">
                    <!-- Title -->
                    <h4 class="font-semibold text-lg text-blue-900 mb-4">
                        {{ $index === 0 ? 'Tamu 1' : 'Tamu ' . ($index + 1) }}
                    </h4>

                    <!-- Grid Container for Guest Data -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6">
                        <!-- Left Section: Nama & Email -->
                        <div class="space-y-4">
                            <!-- Nama -->
                            <span class="text-gray-600 font-medium">Nama</span>
                            <div class="bg-white rounded-lg p-4 border border-gray-300 flex items-center">
                                <span class="text-gray-800 break-words">{{ $guest->name }}</span>
                            </div>
                            <!-- Email -->
                            <span class="text-gray-600 font-medium">Email</span>
                            <div class="bg-white rounded-lg p-4 border border-gray-300 flex items-center">
                                <span class="text-gray-800 break-words">{{ $guest->email }}</span>
                            </div>
                        </div>

                        <!-- Right Section: Telepon & NIK -->
                        <div class="space-y-4">
                            <!-- Telepon -->
                            <span class="text-gray-600 font-medium">Telepon</span>
                            <div class="bg-white rounded-lg p-4 border border-gray-300 flex items-center">

                                <span class="text-gray-800 break-words">{{ $guest->phone }}</span>
                            </div>
                            <!-- NIK -->
                            <span class="text-gray-600 font-medium">NIK</span>
                            <div class="bg-white rounded-lg p-4 border border-gray-300 flex items-center">

                                <span class="text-gray-800 break-words">{{ $guest->identity_id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- Appointment Details Section -->
            <div class="border-t pt-6">
                <h3 class="text-xl font-semibold text-blue-800 mb-4 flex items-center justify-center sm:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Informasi Kunjungan
                </h3>
                <div class="bg-gray-100 rounded-lg p-4 sm:p-6 mx-2 sm:mx-0">
                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Kolom 1 -->
                        <div class="space-y-4">
                            <!-- Organisasi Tamu -->
                            <div>
                                <span class="block text-sm text-gray-600 mb-1">Organisasi Tamu</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="font-medium text-gray-800">{{ $guest->organization ?? 'Tidak Ditemukan' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Durasi Kunjungan -->
                            <div>
                                <span class="block text-sm text-gray-600 mb-1">Durasi Kunjungan</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($appointment->check_in)->diffInMinutes(\Carbon\Carbon::parse($appointment->check_out)) }} menit</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom 2 -->
                        <div class="space-y-4">
                            <!-- Pihak yang Dituju -->
                            <div>
                                <span class="block text-sm text-gray-600 mb-1">Pihak yang Dituju</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="font-medium text-gray-800">{{ $appointment->host->name ?? 'Tidak Ditemukan' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Waktu Kunjungan -->
                            <div>
                                <span class="block text-sm text-gray-600 mb-1">Waktu Kunjungan</span>
                                <div class="bg-white rounded-lg p-4 border border-gray-300 space-y-2">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                        <span class="font-medium text-gray-800">Check In: {{ \Carbon\Carbon::parse($appointment->check_in)->format('d M Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span class="font-medium text-gray-800">Check Out: {{ \Carbon\Carbon::parse($appointment->check_out)->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Keperluan -->
                    <div class="mt-2">
                        <span class="block text-sm text-gray-600 mb-2">Keperluan</span>
                        <div class="bg-white rounded-lg p-4 border border-gray-300">
                            <p class="font-medium text-gray-800 break-words">{{ $appointment->needs }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
