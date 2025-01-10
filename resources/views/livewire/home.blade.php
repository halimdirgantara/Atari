<div wire:poll.1s>
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-4 sm:px-11">
            <div class="flex items-center">
                <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
                <h1 class="text-base sm:text-lg font-semibold">BUKU TAMU DARING</h1>
            </div>
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
                    <h2 class="text-2xl sm:text-3xl font-extrabold mb-2 sm:mb-4">Selamat Datang di {{ $organization->name }}</h2>
                    <p class="text-sm sm:text-base opacity-90 leading-relaxed">
                        Tinggalkan pesan di buku tamu kami
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center mt-6 sm:mt-9 space-y-3 sm:space-y-0 sm:space-x-2 action-buttons">
            <!-- Button 1: Buat Janji -->
            <button onclick="window.location='{{ route('check-in', ['slug' => $slug]) }}'"
                class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-800 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span>Buat Janji</span>
            </button>

            <!-- Button 2: Cek Janji -->
            <button onclick="window.location='{{ route('check-appointment', ['slug' => $organization->slug]) }}'"
                class="bg-yellow-500 text-white font-semibold px-8 py-3 rounded-lg hover:bg-yellow-600 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto">
                <i class="fas fa-search mr-2"></i>
                <span>Cek Janji</span>
            </button>

            <!-- Button 3: Check-Out -->
            <button onclick="window.location='{{ route('check-out', ['slug' => $organization->slug]) }}'"
                class="bg-gray-500 text-white font-semibold px-8 py-3 rounded-lg hover:bg-gray-600 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto mt-4">
                <i class="fas fa-sign-out-alt mr-2"></i>
                <span>Check-Out</span>
            </button>
        </div>

    </section>


    <!-- Status Kunjungan Section -->
    <section wire:poll.5s class="container mx-auto mt-6 sm:mt-8 px-4 sm:px-14 mb-6 sm:mb-8">
        <div class="bg-gray-100 from-blue-100 via-white to-blue-100 rounded-lg shadow-2xl p-4 sm:p-6">
            <div class="mb-4 sm:mb-6">
                <h3 class="text-lg sm:text-xl font-semibold text-blue-900">Status Kunjungan</h3>
                <p class="text-sm text-gray-500 mt-1">Ringkasan status semua kunjungan</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-3 sm:gap-4">
                <!-- Status Cards -->
                <div class="status-card bg-gray-50 rounded-lg p-4 border border-gray-200 hover:bg-gray-100 hover:shadow-lg transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-600"><i class="fas fa-check text-xl"></i></span>
                        <span class="text-2xl font-bold text-gray-600">{{ $statusCounts['done'] }}</span>
                    </div>
                    <p class="text-gray-800 font-medium">Done</p>
                    <p class="text-sm text-gray-600 mt-1">Kunjungan selesai</p>
                </div>
                <div class="status-card bg-green-50 rounded-lg p-4 border border-green-200 hover:bg-green-100 hover:shadow-lg transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-green-600"><i class="fas fa-check-circle text-xl"></i></span>
                        <span class="text-2xl font-bold text-green-600">{{ $statusCounts['approved'] }}</span>
                    </div>
                    <p class="text-green-800 font-medium">Approved</p>
                    <p class="text-sm text-green-600 mt-1">Kunjungan disetujui</p>
                </div>
                <div class="status-card bg-yellow-50 rounded-lg p-4 border border-yellow-200 hover:bg-yellow-100 hover:shadow-lg transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-yellow-600"><i class="fas fa-clock text-xl"></i></span>
                        <span class="text-2xl font-bold text-yellow-600">{{ $statusCounts['pending'] }}</span>
                    </div>
                    <p class="text-yellow-800 font-medium">Pending</p>
                    <p class="text-sm text-yellow-600 mt-1">Menunggu konfirmasi</p>
                </div>
                <div class="status-card bg-red-50 rounded-lg p-4 border border-red-200 hover:bg-red-100 hover:shadow-lg transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-red-600"><i class="fas fa-times text-xl"></i></span>
                        <span class="text-2xl font-bold text-red-600">{{ $statusCounts['declined'] }}</span>
                    </div>
                    <p class="text-red-800 font-medium">Declined</p>
                    <p class="text-sm text-red-600 mt-1">Tidak disetujui</p>
                </div>
                <div class="status-card bg-blue-50 rounded-lg p-4 border border-blue-200 hover:bg-blue-100 hover:shadow-lg transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-600"><i class="fas fa-spinner text-xl"></i></span>
                        <span class="text-2xl font-bold text-blue-600">{{ $statusCounts['process'] }}</span>
                    </div>
                    <p class="text-blue-800 font-medium">Process</p>
                    <p class="text-sm text-blue-600 mt-1">Sedang diproses</p>
                </div>
            </div>
        </div>
    </section>






    <!-- Daftar Tamu Section -->
    <section wire:poll.1s class="container mx-auto mt-6 sm:mt-8 px-4 sm:px-14 pb-8">
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6">
                <div class="mb-3 sm:mb-0">
                    <h3 class="text-lg sm:text-xl font-semibold text-blue-900">Daftar Tamu</h3>
                    <p class="text-sm text-gray-500 mt-1">Kunjungan terbaru</p>
                </div>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm inline-block">
                    Total Tamu: {{ $visits->total() }}
                </span>
            </div>
            <ul class="space-y-4 sm:space-y-5">
                @forelse($visits as $visit)
                    @php
                        $guest = $visit->guests->first();  // Ambil hanya tamu pertama
                    @endphp
                    @if($guest)
                    <li class="guest-item flex flex-col sm:flex-row justify-between items-start sm:items-center border border-gray-200 rounded-lg p-4 sm:p-5 transition-transform transform hover:shadow-lg hover:scale-105">
                        <!-- Informasi Utama Tamu -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-100 rounded-full p-3 flex-shrink-0">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-lg">
                                    {{ substr($guest->name, 0, 4) . str_repeat('*', max(strlen($guest->name) - 8, 0)) . substr($guest->name, -4) }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="fas fa-building mr-2"></i>{{ $guest->organization }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1 break-words">
                                    <i class="fas fa-envelope mr-2"></i>
                                    @if($guest->email)
                                        {{ substr($guest->email, 0, 3) . str_repeat('*', strpos($guest->email, '@') - 4) . substr($guest->email, strpos($guest->email, '@') - 3) }}
                                    @else
                                        Email tidak tersedia
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Informasi Status dan Waktu -->
                        <div class="text-left sm:text-right mt-3 sm:mt-0">
                            <p class="font-medium text-blue-600">
                                Check-in: {{ \Carbon\Carbon::parse($visit->check_in)->format('H:i') }}
                            </p>
                            <p class="font-medium text-blue-600 mt-1">
                                Check-out: {{ \Carbon\Carbon::parse($visit->check_out)->format('H:i') }}
                            </p>
                            <p class="text-sm mt-2">
                                Status:
                                <span class="font-medium px-3 py-1 rounded-full text-white
                                    @if($visit->status === 'approved') bg-blue-500
                                    @elseif($visit->status === 'pending') bg-yellow-500
                                    @elseif($visit->status === 'process') bg-gray-400
                                    @elseif($visit->status === 'reject') bg-red-500
                                    @elseif($visit->status === 'done') bg-green-500
                                    @elseif($visit->status === 'not_attend') bg-red-700
                                    @endif">
                                    {{ ucfirst($visit->status) }}
                                </span>
                            </p>
                        </div>
                    </li>
                    @endif
                @empty
                    <li class="text-center py-4 text-gray-500">
                        Belum ada kunjungan tamu
                    </li>
                @endforelse
            </ul>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $visits->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('show-alert', (event) => {
                Swal.fire({
                    title: 'Permintaan Anda telah dikirim!',
                    html: `
                        <p>${event.message}</p>
                        <div class="bg-gray-100 p-3 rounded-lg mt-3 flex justify-between items-center">
                            <span class="font-mono text-blue-700 font-semibold">${event.guest_token}</span>
                            <button class="bg-blue-500 text-white px-3 py-1 ml-3 rounded hover:bg-blue-600"
                                    id="copy-token-button">
                                Salin Token
                            </button>
                        </div>
                    `,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                });

                // Tambahkan event listener untuk tombol salin
                document.getElementById('copy-token-button').addEventListener('click', () => {
                    navigator.clipboard.writeText(event.guest_token).then(() => {
                        Swal.fire({
                            title: 'Token berhasil disalin',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }).catch(err => {
                        Swal.fire({
                            title: 'Gagal menyalin token',
                            text: 'Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                });
            });
        });
    </script>
    @endpush

</div>



