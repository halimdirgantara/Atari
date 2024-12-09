<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Janji</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Header -->
    <header class="bg-blue-900 text-white py-4">
        <div class="container mx-auto flex items-center">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-10 mr-4">
            <h1 class="text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

    <!-- Cek Janji Section -->
    <section class="container mx-auto mt-8 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold mb-4">Cek Janji</h2>
            <p class="text-gray-600 mb-6">Masukkan nama atau organisasi untuk melihat status janji.</p>
            <form method="GET" action="{{ route('check') }}" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4" id="checkForm">
                <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 w-full">
                    <span class="material-icons text-gray-500 mr-3">badge</span>
                    <input type="text" name="guest_id" id="guest_id" class="w-full border-none focus:ring-0" placeholder="nama atau organisasi" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2.5 rounded-md hover:bg-blue-900 flex items-center">
                    <span class="material-icons mr-2">search</span> Cari
                </button>
            </form>
        </div>
    </section>

    <!-- Optional: Daftar Janji Temu -->
    @if(isset($appointments) && $appointments->count() > 0)
        <section class="container mx-auto mt-6 px-4">
            <h2 class="text-2xl font-semibold mb-4">Daftar Janji Temu Anda</h2>
            <div class="space-y-4">
                @foreach($appointments as $appointment)
                    <div class="bg-white rounded-lg shadow-md p-4 flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <span class="material-icons text-gray-500">person</span>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $appointment->guest->name }}</p>
                                <p class="text-sm text-gray-500">{{ $appointment->guest->organization }}</p>
                                @if(isset($appointment->status))
                                    @php
                                        $statusClass = match($appointment->status) {
                                            'approve' => 'bg-green-100 text-green-800',
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'process' => 'bg-blue-100 text-blue-800',
                                            'reject' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium mt-2 {{ $statusClass }}">
                                        {{ $appointment->status }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($appointment->check_in)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->check_out)->format('H:i') }}</p>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appointment->check_in)->format('d M Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- SweetAlert2 Script -->
    @if(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif
    @if($errorMessage)
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Ditemukan',
                text: '{{ $errorMessage }}',
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif

</body>
</html>
