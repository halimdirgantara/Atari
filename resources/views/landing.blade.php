<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Book</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        @keyframes slideDown {
            0% { transform: translateY(-20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .animate-slide-down {
            animation: slideDown 1s ease-out forwards;
        }

        .slideshow {
            position: relative;
            height: 100%;
            width: 100%;
        }

        .slideshow img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        @keyframes slideshow {
            0%, 5% { opacity: 0; }
            15%, 45% { opacity: 1; }
            50%, 100% { opacity: 0; }
        }

        .slideshow img:nth-child(1) { animation: slideshow 20s infinite 0s; }
        .slideshow img:nth-child(2) { animation: slideshow 20s infinite 4s; }
        .slideshow img:nth-child(3) { animation: slideshow 20s infinite 8s; }
        .slideshow img:nth-child(4) { animation: slideshow 20s infinite 12s; }
        .slideshow img:nth-child(5) { animation: slideshow 20s infinite 16s; }

        .bg-gradient-custom {
            background-image: linear-gradient(to right, #3f0595, #b8b1d5);
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }

        .status-card {
            transition: all 0.3s ease;
        }

        .status-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .guest-item {
            transition: all 0.3s ease;
        }

        .guest-item:hover {
            background-color: #f8fafc;
            transform: scale(1.01);
        }

        /* Mobile Optimizations */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .guest-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }

            .guest-item > div:last-child {
                margin-top: 0.5rem;
                text-align: left;
                width: 100%;
            }

            .status-card {
                margin-bottom: 1rem;
            }

            .hero-content {
                padding: 1.5rem !important;
            }

            .action-buttons {
                width: 100%;
            }

            .action-buttons button {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-4 sm:px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
            <h1 class="text-base sm:text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container mx-auto mt-4 sm:mt-8 px-4 sm:px-14">
        <div class="relative bg-gradient-custom text-white rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-105 h-52">
            <div class="absolute inset-0">
                <!-- Slideshow Structure -->
                <div class="slideshow block md:hidden">
                    <img src="{{ asset('images/gedung1.jpg') }}" alt="Gedung 1">
                    <img src="{{ asset('images/gedung2.jpg') }}" alt="Gedung 2">
                    <img src="{{ asset('images/gedung3.jpg') }}" alt="Gedung 3">
                    <img src="{{ asset('images/gedung4.jpg') }}" alt="Gedung 4">
                    <img src="{{ asset('images/gedung5.jpg') }}" alt="Gedung 5">
                </div>

                <div class="slideshow hidden md:block">
                    <img src="{{ asset('images/gedung6.jpg') }}" alt="Gedung 6">
                    <img src="{{ asset('images/gedung7.jpg') }}" alt="Gedung 7">
                    <img src="{{ asset('images/gedung8.jpg') }}" alt="Gedung 8">
                    <img src="{{ asset('images/gedung9.jpg') }}" alt="Gedung 9">
                    <img src="{{ asset('images/gedung10.jpg') }}" alt="Gedung 10">
                </div>

                <div class="absolute inset-0 bg-black opacity-50 backdrop-blur-md"></div>
            </div>

            <div class="p-6 sm:p-11 flex items-center relative z-20 animate-slide-down hero-content">
                <div class="flex-1">
                    <h2 class="text-2xl sm:text-3xl font-extrabold mb-2 sm:mb-4">Selamat Datang!</h2>
                    <p class="text-sm sm:text-base opacity-90 leading-relaxed">
                        Tinggalkan pesan di buku tamu kami
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center mt-6 sm:mt-9 space-y-3 sm:space-y-0 sm:space-x-2 action-buttons">
            <button onclick="window.location='{{ route('form') }}'"
                class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-900 shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center w-full sm:w-auto">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span>Buat Janji</span>
            </button>

            <button onclick="window.location='{{ route('check') }}'"
                class="bg-yellow-500 text-white font-semibold px-8 py-3 rounded-lg hover:bg-yellow-900 shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center w-full sm:w-auto">
                <i class="fas fa-check mr-2"></i>
                <span>Cek Janji</span>
            </button>
        </div>
    </section>

    <!-- Daftar Tamu Section -->
    <section class="container mx-auto mt-6 sm:mt-8 px-4 sm:px-14">
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6">
                <div class="mb-3 sm:mb-0">
                    <h3 class="text-lg sm:text-xl font-semibold text-blue-900">Daftar Tamu</h3>
                    <p class="text-sm text-gray-500 mt-1">Kunjungan terbaru</p>
                </div>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm inline-block">
                    Total buku tamu: {{ $visits->total() }}
                </span>
            </div>
            <ul class="space-y-3 sm:space-y-4">
                @foreach($visits as $visit)
                    @foreach($visit->guests as $guest)
                        <li class="guest-item flex justify-between items-start sm:items-center border border-gray-200 rounded-lg p-3 sm:p-4 hover:border-blue-300">
                            <div class="flex items-start sm:items-center space-x-3 sm:space-x-4">
                                <div class="bg-blue-100 rounded-full p-2 flex-shrink-0">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $guest->name }}</p>
                                    <div class="flex items-center text-sm text-gray-500 mt-1">
                                        <i class="fas fa-building mr-2"></i>
                                        <span>{{ $guest->organization }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left sm:text-right mt-2 sm:mt-0">
                                <p class="font-medium text-blue-600">
                                    {{ \Carbon\Carbon::parse($visit->check_in)->format('H:i') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $visit->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                @endforeach
            </ul>

            <div class="mt-4 sm:mt-6">
                {{ $visits->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

    <!-- Status Kunjungan Section -->
    <section class="container mx-auto mt-6 sm:mt-8 px-4 sm:px-14 mb-6 sm:mb-8">
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
            <div class="mb-4 sm:mb-6">
                <h3 class="text-lg sm:text-xl font-semibold text-blue-900">Status Kunjungan</h3>
                <p class="text-sm text-gray-500 mt-1">Ringkasan status semua kunjungan</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 sm:gap-4">
                <!-- Status Cards -->
                <div class="status-card bg-green-50 rounded-lg p-4 border border-green-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-green-600"><i class="fas fa-check-circle text-xl"></i></span>
                        <span class="text-2xl font-bold text-green-600">{{ $statusCounts['approve'] }}</span>
                    </div>
                    <p class="text-green-800 font-medium">Terkonfirmasi</p>
                    <p class="text-sm text-green-600 mt-1">Kunjungan disetujui</p>
                </div>

                <div class="status-card bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-yellow-600"><i class="fas fa-clock text-xl"></i></span>
                        <span class="text-2xl font-bold text-yellow-600">{{ $statusCounts['pending'] }}</span>
                    </div>
                    <p class="text-yellow-800 font-medium">Tertunda</p>
                    <p class="text-sm text-yellow-600 mt-1">Menunggu konfirmasi</p>
                </div>

                <div class="status-card bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-600"><i class="fas fa-spinner text-xl"></i></span>
                        <span class="text-2xl font-bold text-blue-600">{{ $statusCounts['process'] }}</span>
                    </div>
                    <p class="text-blue-800 font-medium">Menunggu</p>
                    <p class="text-sm text-blue-600 mt-1">Sedang diproses</p>
                </div>

                <div class="status-card bg-red-50 rounded-lg p-4 border border-red-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-red-600"><i class="fas fa-times-circle text-xl"></i></span>
                        <span class="text-2xl font-bold text-red-600">{{ $statusCounts['reject'] }}</span>
                    </div>
                    <p class="text-red-800 font-medium">Ditolak</p>
                    <p class="text-sm text-red-600 mt-1">Tidak disetujui</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Permintaan anda sudah terkirim',
                    html: `
                        <p>Simpan token ini untuk mengecek janji anda: <strong>{{ session("guest_token") }}</strong></p>
                        <button id="copyToken" class="swal2-confirm swal2-styled" style="background-color: #5cb85c; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 14px;">Salin Token</button>
                    `,
                    showConfirmButton: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Optional: You can add any action here when the OK button is clicked
                    }
                });

                // Add event listener for the copy button
                document.addEventListener('click', function (event) {
                    if (event.target.id === 'copyToken') {
                        const token = '{{ session("guest_token") }}';
                        navigator.clipboard.writeText(token).then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Token disalin!',
                                text: 'Token berhasil disalin ke clipboard.',
                                confirmButtonText: 'OK'
                            });
                        }).catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal menyalin!',
                                text: 'Terjadi kesalahan saat menyalin token.',
                                confirmButtonText: 'OK'
                            });
                        });
                    }
                });
            @endif
        });
    </script>
</body>
</html>
