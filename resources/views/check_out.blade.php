<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-Out</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-4 sm:px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
            <h1 class="text-base sm:text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-4 sm:px-14">
        <div class="bg-white rounded-lg shadow-lg p-8 relative flex flex-col gap-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <h2 class="text-2xl font-semibold text-blue-900">Daftar Tamu yang Disetujui Hari Ini</h2>

                <!-- Home Icon Button -->
                <div class="mt-4 md:mt-0 text-blue-800" >
                    <a href="{{ route('landing', ['slug' => $organization->slug]) }}" class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg hover:bg-blue-200 hover:shadow-md hover:text-blue-900 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                        </svg>
                        <span class="font-medium">Beranda</span>
                    </a>
                </div>

            </div>

            @if($approvedGuests->count() > 0)
                <div class="space-y-6">
                    @foreach($approvedGuests as $guestBook)
                        @php
                            $mainGuest = $guestBook->guests->first(); // Ambil tamu utama
                        @endphp
                        <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-lg flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                            <div class="flex-1 space-y-4">
                                <div class="grid grid-cols-1 gap-2">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                        <span class="font-medium text-gray-800 sm:min-w-[120px]">Nama</span>
                                        <span class="text-gray-700">: {{ $mainGuest->name }}</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                        <span class="font-medium text-gray-800 sm:min-w-[120px]">Organisasi</span>
                                        <span class="text-gray-700">: {{ $mainGuest->organization ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                        <span class="font-medium text-gray-800 sm:min-w-[120px]">Waktu Check-In</span>
                                        <span class="text-gray-700">: {{ $guestBook->check_in }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 mt-4 md:mt-0 w-full md:w-auto">
                                <button onclick="processCheckOut('{{ route('process_check_out', ['slug' => $organization->slug, 'id' => $guestBook->id]) }}')"
                                    class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-all duration-300 w-full md:w-auto">
                                    Check-Out
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $approvedGuests->links('pagination::tailwind') }}
                </div>
            @else
                <div class="flex justify-center items-center h-48">
                    <p class="text-gray-500 text-center">Tidak ada tamu yang disetujui hari ini.</p>
                </div>
            @endif
        </div>
    </main>


    <script>
        function processCheckOut(url) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin melakukan check-out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Check-Out!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'swal-popup-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: data.message,
                                customClass: {
                                    popup: 'swal-popup-custom'
                                }
                            }).then(() => {
                                location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat proses check-out.',
                                customClass: {
                                    popup: 'swal-popup-custom'
                                }
                            });
                        });
                }
            });
        }
    </script>

    <style>
        @media (max-width: 768px) {
            .swal-popup-custom {
                width: 80% !important;
                max-width: 300px !important;
                padding: 10px !important;
            }

            .swal2-title {
                font-size: 16px !important;
            }

            .swal2-html-container {
                font-size: 14px !important;
            }

            .swal2-confirm {
                font-size: 12px !important;
                padding: 6px 12px !important;
            }

            .swal2-cancel {
                font-size: 12px !important;
                padding: 6px 12px !important;
            }
        }
    </style>

    @livewireScripts
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('reloadPage', () => {
                location.reload(); // Reload halaman
            });
        });
    </script>

</body>

</html>
