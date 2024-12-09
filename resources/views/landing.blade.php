<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Book</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        @keyframes slideDown {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-down {
            animation: slideDown 1s ease-out forwards;
        }

        .slideshow img:nth-child(1) { animation: fade 15s infinite 0s; }
        .slideshow img:nth-child(2) { animation: fade 15s infinite 3s; }
        .slideshow img:nth-child(3) { animation: fade 15s infinite 6s; }
        .slideshow img:nth-child(4) { animation: fade 15s infinite 9s; }
        .slideshow img:nth-child(5) { animation: fade 15s infinite 12s; }

        @keyframes fade {
            0% { opacity: 0; }
            10% { opacity: 1; }
            20% { opacity: 1; }
            30% { opacity: 0; }
            100% { opacity: 0; }
        }

        .bg-gradient-custom {
            background-image: url('/mnt/data/image.png'), linear-gradient(to right, #3f0595, #b8b1d5); /* Update image path */
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-blue-900 text-white py-4">
        <div class="container mx-auto flex items-center">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-10 mr-4">
            <h1 class="text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container mx-auto mt-8 px-5">
        <div class="relative bg-gradient-custom text-white rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-105 h-52">
            <div class="absolute inset-0">
                <!-- Slideshow for Mobile -->
                <div class="slideshow-mobile relative h-full w-full block md:hidden">
                    <img src="{{ asset('images/gedung1.jpg') }}" alt="Gedung 1" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-100">
                    <img src="{{ asset('images/gedung2.jpg') }}" alt="Gedung 2" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                    <img src="{{ asset('images/gedung3.jpg') }}" alt="Gedung 3" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                    <img src="{{ asset('images/gedung4.jpg') }}" alt="Gedung 4" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                    <img src="{{ asset('images/gedung5.jpg') }}" alt="Gedung 5" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                </div>

                <!-- Slideshow for Desktop -->
                <div class="slideshow-desktop relative h-full w-full hidden md:block">
                    <img src="{{ asset('images/gedung6.jpg') }}" alt="Gedung 6" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-100">
                    <img src="{{ asset('images/gedung7.jpg') }}" alt="Gedung 7" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                    <img src="{{ asset('images/gedung8.jpg') }}" alt="Gedung 8" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                    <img src="{{ asset('images/gedung9.jpg') }}" alt="Gedung 9" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                    <img src="{{ asset('images/gedung10.jpg') }}" alt="Gedung 10" class="absolute inset-0 h-full w-full object-cover transition-opacity duration-1000 ease-in-out opacity-0">
                </div>

                <!-- Overlay -->
                <div class="absolute inset-0 bg-black opacity-50 backdrop-blur-md"></div>
            </div>
            <div class="p-11 flex items-center relative z-20 animate-slide-down">
                <div class="flex-1">
                    <h2 class="text-3xl font-extrabold mb-4">Selamat Datang!</h2>
                    <p class="text-base opacity-90">Tinggalkan pesan di buku tamu kami</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col items-center mt-9 space-y-4 sm:flex-row sm:space-y-0 sm:space-x-2">
            <button onclick="window.location='{{ route('form') }}'"
                class="bg-blue-600 text-white font-semibold px-12 py-2 rounded-md hover:bg-blue-900 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <i class="fas fa-calendar-alt mr-2"></i>Buat Janji
            </button>

            <button onclick="window.location='{{ route('check') }}'"
                class="bg-yellow-500 text-white font-semibold px-12 py-2 rounded-md hover:bg-yellow-900 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <i class="fas fa-check mr-2"></i>Cek Janji
            </button>
        </div>
    </section>

    <!-- Daftar Tamu Section -->
    <section class="container mx-auto mt-8 px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Daftar Tamu</h3>
            <ul class="space-y-4">
                @foreach($visits as $visit)
                    @foreach($visit->guests as $guest)
                        <li class="flex justify-between items-center border border-gray-200 rounded-lg p-4">
                            <div>
                                <p class="font-semibold">{{ $guest->name }}</p>
                                <p class="text-sm text-gray-500">{{ $guest->organization }}</p>
                            </div>
                            <p class="text-gray-500">
                                {{ \Carbon\Carbon::parse($visit->check_in)->format('H:i') }} |
                                {{ $visit->created_at->format('d M Y') }}
                            </p>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Status Kunjungan Section -->
    <section class="container mx-auto mt-8 px-4 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Status Kunjungan</h3>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="text-center border border-gray-200 rounded-lg p-4">
                    <p class="text-xl font-semibold">{{ $statusCounts['approve'] }}</p>
                    <p class="text-gray-500">Terkonfirmasi</p>
                </div>
                <div class="text-center border border-gray-200 rounded-lg p-4">
                    <p class="text-xl font-semibold">{{ $statusCounts['pending'] }}</p>
                    <p class="text-gray-500">Tertunda</p>
                </div>
                <div class="text-center border border-gray-200 rounded-lg p-4">
                    <p class="text-xl font-semibold">{{ $statusCounts['process'] }}</p>
                    <p class="text-gray-500">Menunggu</p>
                </div>
                <div class="text-center border border-gray-200 rounded-lg p-4">
                    <p class="text-xl font-semibold">{{ $statusCounts['reject'] }}</p>
                    <p class="text-gray-500">Ditolak</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

    <!-- Script alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Permintaan anda sudah terkirim',
                    showConfirmButton: false,
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>
</html>
