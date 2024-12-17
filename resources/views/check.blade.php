<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Janji</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Header dengan Shadow -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-10 mr-4">
            <h1 class="text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

    <!-- Cek Janji Section yang Ditingkatkan -->
    <section class="container mx-auto mt-8 px-14">
        <div class="bg-white rounded-lg shadow-lg p-8 border-t-4 border-blue-900">
            <div class="flex items-center mb-4">
                <span class="material-icons text-blue-900 text-3xl mr-3">schedule</span>
                <div>
                    <h2 class="text-2xl font-semibold text-blue-900">Cek Janji</h2>
                    <p class="text-gray-600">Pantau status janji temu Anda</p>
                </div>
            </div>
            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <span class="material-icons text-blue-600 mr-3">info</span>
                    <p class="text-sm text-blue-800">
                        Masukkan guest token yang telah diberikan untuk melihat detail dan status janji temu Anda.
                        Token ini diberikan saat Anda membuat janji.
                    </p>
                </div>
            </div>
            <form method="GET" action="{{ route('check') }}" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4" id="checkForm">
                <div class="flex items-center border-2 border-gray-300 rounded-lg px-4 py-3 w-full hover:border-blue-500 transition-colors duration-300">
                    <span class="material-icons text-gray-500 mr-3">badge</span>
                    <input type="text" name="guest_token" id="guest_token"
                           class="w-full border-none focus:ring-0 bg-transparent placeholder-gray-400"
                           placeholder="Masukkan guest token Anda" required>
                </div>
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-700
                               transform hover:scale-105 transition-all duration-300 flex items-center min-w-[120px]
                               shadow-md hover:shadow-lg">
                    <span class="material-icons mr-2">search</span>
                    Cari
                </button>
            </form>
        </div>
    </section>

    <!-- Daftar Janji Temu yang Ditingkatkan -->
    @if(isset($appointments) && $appointments->count() > 0)
    <section class="container mx-auto mt-8 px-14 mb-8">
        <div class="flex items-center mb-6">
            <span class="material-icons text-blue-900 text-3xl mr-3">list_alt</span>
            <h2 class="text-2xl font-semibold text-blue-900">Daftar Janji Temu Anda</h2>
        </div>
        <div class="space-y-6">
            @foreach($appointments as $appointment)
            <a href="{{ route('appointment_details', ['id' => $appointment->id]) }}"
               class="block bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden
                      transform hover:scale-[1.02] border border-gray-100">
                <div class="p-6">
                    <!-- Header dengan Status -->
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <span class="material-icons text-gray-500 mr-3">event</span>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500">#{{ $appointment->id }}</span>
                                    @if(isset($appointment->status))
                                        @php
                                        $statusClass = match($appointment->status) {
                                            'approve' => 'bg-green-100 text-green-800 border-green-200',
                                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'process' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'reject' => 'bg-red-100 text-red-800 border-red-200',
                                            default => 'bg-gray-100 text-gray-800 border-gray-200'
                                        };
                                        $statusIcon = match($appointment->status) {
                                            'approve' => 'check_circle',
                                            'pending' => 'hourglass_empty',
                                            'process' => 'refresh',
                                            'reject' => 'cancel',
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
                        <div class="text-right">
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
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-sm text-gray-600">Klik untuk melihat detail lengkap</span>
                    <span class="material-icons text-gray-400">chevron_right</span>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Scripts -->
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

    @if(session('guest_token'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Guest Token',
            text: 'Simpan token ini untuk mengecek janji Anda: {{ session('guest_token') }}',
            confirmButtonColor: '#3085d6',
        });
    </script>
    @endif

</body>
</html>
