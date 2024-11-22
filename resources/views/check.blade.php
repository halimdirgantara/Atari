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
            <h2 class="text-2xl font-semibold mb-4">Cek Status Janji</h2>
            @if(isset($status))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Status Anda:</strong>
                    <span class="block sm:inline">{{ $status }}</span>
                </div>
            @else
                <p class="text-gray-600 mb-6">Masukkan nama untuk melihat status janji.</p>
                <form method="GET" action="{{ route('check') }}" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 w-full">
                        <span class="material-icons text-gray-500 mr-3">badge</span>
                        <input type="text" name="guest_id" class="w-full border-none focus:ring-0" placeholder="ID Tamu" required>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py- rounded-md hover:bg-blue-700 flex items-center">
                        <span class="material-icons mr-2">search</span> Cari
                    </button>
                </form>
            @endif
        </div>
    </section>

    <!-- Optional: Daftar Janji Temu Section (Display if multiple appointments are available) -->
    @if(isset($appointments) && $appointments->count() > 0)
        <section class="container mx-auto mt-6 px-4">
            <h2 class="text-2xl font-semibold mb-4">Daftar Janji Temu Anda</h2>
            <div class="space-y-4">
                @foreach($appointments as $appointment)
                    <div class="bg-white rounded-lg shadow-md p-4 flex justify-between items-center">
                        <div class="flex items-center">
                            <span class="material-icons text-gray-500 mr-3">person</span>
                            <div>
                                <p class="font-semibold">{{ $appointment->guest->name }}</p>
                                <p class="text-sm text-gray-500">{{ $appointment->guest->organization }}</p>
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

    <!-- Optional: If you want to display a message when no appointments are found -->
    @if(isset($status) && (!$appointments || $appointments->count() == 0))
        <section class="container mx-auto mt-6 px-4">
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Info:</strong>
                <span class="block sm:inline">Tidak ada janji temu yang ditemukan untuk ID tamu tersebut.</span>
            </div>
        </section>
    @endif
</body>
</html>
