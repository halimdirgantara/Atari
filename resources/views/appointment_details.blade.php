@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 relative">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Title Section -->
            <h2 class="text-3xl font-semibold text-blue-900 mb-6">Detail Janji Temu</h2>

            <!-- Table for Appointment Details -->
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Informasi</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tamu Section -->
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">Nama Tamu</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $appointment->guests->first()->name ?? 'Nama Tamu Tidak Ditemukan' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">Organisasi</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $appointment->guests->first()->organization ?? 'Organisasi Tidak Ditemukan' }}</td>
                    </tr>

                    <!-- Host Section -->
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">Nama Host</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $appointment->host->name ?? 'Pihak yang Ditemui Tidak Ditemukan' }}</td>
                    </tr>

                    <!-- Appointment Info Section -->
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">Keperluan</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $appointment->needs }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">Check In</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment->check_in)->format('d M Y H:i') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">Check Out</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment->check_out)->format('d M Y H:i') }}</td>
                    </tr>

                    <!-- Status Section -->
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">Status</td>
                        <td class="px-4 py-2 text-sm text-gray-600">
                            @php
                                $statusClass = match($appointment->status) {
                                    'approve' => 'bg-green-600 text-white',
                                    'pending' => 'bg-yellow-400 text-black',
                                    'process' => 'bg-blue-700 text-white',
                                    'reject' => 'bg-red-600 text-white',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                            @endphp
                            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold {{ $statusClass }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Home Icon Button -->
        <div class="absolute top-10 right-8">
            <a href="{{ route('landing') }}" class="text-blue-800 rounded-full hover:bg-blue-900 transition-colors">
                <!-- Heroicons Home Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                  </svg>
            </a>
        </div>
    </div>
@endsection
