<div>
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-5 sm:px-11">
            <div class="flex items-center">
                <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
                <h1 class="text-base sm:text-lg font-semibold">{{ $organization->name }}</h1>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container mx-auto mt-4 sm:mt-8 px-4 sm:px-14">
        <div class="relative bg-gradient-custom text-white rounded-lg overflow-hidden shadow-xl transform transition duration-500 hover:scale-105 h-52">
            <div class="absolute inset-0">
                <!-- Slideshow Structure -->
                <div class="slideshow block md:hidden opacity-65 ">
                    <img src="{{ asset('images/gedung1.jpg') }}" alt="Gedung 1">
                    <img src="{{ asset('images/gedung2.jpg') }}" alt="Gedung 2">
                    <img src="{{ asset('images/gedung3.jpg') }}" alt="Gedung 3">
                    <img src="{{ asset('images/gedung4.jpg') }}" alt="Gedung 4">
                    <img src="{{ asset('images/gedung5.jpg') }}" alt="Gedung 5">
                </div>

                <div class="slideshow hidden md:block">
                    <img src="{{ asset('images/gedung8.jpg') }}" alt="Gedung 6">
                    <img src="{{ asset('images/gedung7.jpg') }}" alt="Gedung 7">
                    <img src="{{ asset('images/gedung6.jpg') }}" alt="Gedung 8">
                    <img src="{{ asset('images/gedung9.jpg') }}" alt="Gedung 9">
                    <img src="{{ asset('images/gedung10.jpg') }}" alt="Gedung 10">
                </div>

                <div class="absolute inset-0 bg-black opacity-50 backdrop-blur-md"></div>
            </div>

            <div class="p-6 sm:p-11 flex items-center relative z-20 animate-slide-down hero-content">
                <div class="flex-1">
                    <h2 class="text-2xl sm:text-3xl font-extrabold mb-2 sm:mb-4">Selamat Datang di Aplikasi Buku Tamu Daring</h2>
                    <p class="text-sm sm:text-base opacity-90 leading-relaxed">
                        Tinggalkan pesan di buku tamu kami
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center mt-6 sm:mt-9 space-y-3 sm:space-y-0 sm:space-x-3 action-buttons">
            <!-- Button 1: Buat Janji -->
            <button
                onclick="window.location='{{ route('appointment-form', ['slug' => $slug]) }}'"
                class="bg-blue-600 text-white font-semibold px-3 py-3 sm:px-8 sm:py-4 rounded-lg shadow-md hover:shadow-lg transition-all hover:bg-blue-800 duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto transform hover:scale-105">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span>Buat Janji</span>
            </button>

            <!-- Button 2: Cek Janji -->
            <button
                onclick="window.location='{{ route('check-appointment', ['slug' => $organization->slug]) }}'"
                class="bg-yellow-500 text-white font-semibold px-3 py-3 sm:px-8 sm:py-4 rounded-lg shadow-md hover:shadow-lg transition-all hover:bg-yellow-600 duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto transform hover:scale-105">
                <i class="fas fa-search mr-2"></i>
                <span>Cek Janji</span>
            </button>

            @if($isWithinRange)
                <!-- Button 3: Check-In -->
                <button
                    onclick="window.location='{{ route('check-in', ['slug' => $organization->slug]) }}'"
                    class="bg-green-600 text-white font-semibold px-3 py-3 sm:px-8 sm:py-4 rounded-lg shadow-md hover:shadow-lg transition-all hover:bg-green-800 duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto transform hover:scale-105">
                    <span>Check-In</span>
                </button>

                <!-- Button 4: Check-Out -->
                <button
                    onclick="window.location='{{ route('check-out', ['slug' => $organization->slug]) }}'"
                    class="bg-red-500 text-white font-semibold px-3 py-3 sm:px-8 sm:py-4 rounded-lg shadow-md hover:shadow-lg transition-all hover:bg-gray-600 duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto transform hover:scale-105">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Check-Out</span>
                </button>
            @else
                <!-- Hidden Buttons for Outside Range -->
                <button
                    id="check-in-btn"
                    onclick="window.location='{{ route('check-in', ['slug' => $organization->slug]) }}'"
                    class="hidden bg-green-600 text-white font-semibold px-3 py-3 sm:px-8 sm:py-4 rounded-lg shadow-md hover:shadow-lg transition-all hover:bg-green-800 duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto transform hover:scale-105">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>Check-In</span>
                </button>

                <button
                    id="check-out-btn"
                    onclick="window.location='{{ route('check-out', ['slug' => $organization->slug]) }}'"
                    class="hidden bg-orange-800 text-white font-semibold px-3 py-3 sm:px-8 sm:py-4 rounded-lg shadow-md hover:shadow-lg transition-all hover:bg-gray-600 duration-300 ease-in-out flex items-center justify-center w-full sm:w-auto transform hover:scale-105">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>Check-Out</span>
                </button>
            @endif
        </div>


    </section>


    <!-- Status Kunjungan Section -->
    <section class="container mx-auto mt-6 sm:mt-8 px-4 sm:px-14 mb-6 sm:mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8">
            <div class="mb-4 sm:mb-6">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Status Kunjungan</h3>
                <p class="text-sm text-gray-500 mt-1">Ringkasan status semua kunjungan</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                <!-- Status Cards -->
                <div class="status-card bg-gray-50 rounded-lg p-4 border border-gray-200 hover:bg-gray-100 hover:shadow-md transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-600"><i class="fas fa-check text-2xl"></i></span>
                        <span class="text-3xl font-bold text-gray-800">{{ $statusCounts['done'] }}</span>
                    </div>
                    <p class="text-gray-800 font-medium">Done</p>
                    <p class="text-sm text-gray-600 mt-1">Kunjungan selesai</p>
                </div>
                <div class="status-card bg-green-50 rounded-lg p-4 border border-green-200 hover:bg-green-100 hover:shadow-md transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-green-600"><i class="fas fa-check-circle text-2xl"></i></span>
                        <span class="text-3xl font-bold text-green-800">{{ $statusCounts['approved'] }}</span>
                    </div>
                    <p class="text-green-800 font-medium">Approved</p>
                    <p class="text-sm text-green-600 mt-1">Kunjungan disetujui</p>
                </div>
                <div class="status-card bg-yellow-50 rounded-lg p-4 border border-yellow-200 hover:bg-yellow-100 hover:shadow-md transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-yellow-600"><i class="fas fa-clock text-2xl"></i></span>
                        <span class="text-3xl font-bold text-yellow-800">{{ $statusCounts['pending'] }}</span>
                    </div>
                    <p class="text-yellow-800 font-medium">Pending</p>
                    <p class="text-sm text-yellow-600 mt-1">Menunggu konfirmasi</p>
                </div>
                <div class="status-card bg-red-50 rounded-lg p-4 border border-red-200 hover:bg-red-100 hover:shadow-md transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-red-600"><i class="fas fa-times text-2xl"></i></span>
                        <span class="text-3xl font-bold text-red-800">{{ $statusCounts['declined'] }}</span>
                    </div>
                    <p class="text-red-800 font-medium">Declined</p>
                    <p class="text-sm text-red-600 mt-1">Tidak disetujui</p>
                </div>
                <div class="status-card bg-blue-50 rounded-lg p-4 border border-blue-200 hover:bg-blue-100 hover:shadow-md transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-600"><i class="fas fa-spinner text-2xl"></i></span>
                        <span class="text-3xl font-bold text-blue-800">{{ $statusCounts['process'] }}</span>
                    </div>
                    <p class="text-blue -800 font-medium">Process</p>
                    <p class="text-sm text-blue-600 mt-1">Sedang diproses</p>
                </div>
            </div>
        </div>
    </section>






    <!-- Daftar Tamu Section -->
    <section class="container mx-auto mt-6 sm:mt-8 px-4 sm:px-14 pb-8">
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6">
                <div class="mb-3 sm:mb-0">
                    <h3 class="text-lg sm:text-xl font-semibold text-blue-900">Daftar Tamu</h3>
                    <p class="text-sm text-gray-500 mt-1">Kunjungan Dan Janji Tamu Terbaru</p>
                </div>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg text-sm inline-block">
                    Total Tamu: {{ $visits->total() }}
                </span>
            </div>
            <ul class="space-y-4 sm:space-y-5">
                @forelse($visits as $visit)
                    @php
                        $guest = $visit->guests->first();  // Ambil hanya tamu pertama
                        $isEstimated = $visit->status === 'process'; // Status process = estimasi
                        $isCheckedIn = $visit->status === 'approved' || $visit->status === 'done'; // Status approved/done = check-in/check-out
                    @endphp
                    @if($guest)
                    <li class="guest-item flex flex-col sm:flex-row justify-between items-start sm:items-center border border-gray-200 rounded-lg p-4 sm:p-5 transition-transform transform hover:shadow-lg hover:scale-105">
                        <!-- Informasi Utama Tamu -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-100 rounded-full p-2 sm:p-3 flex-shrink-0">
                                <i class="fas fa-user text-blue-500 text-lg sm:text-xl"></i>
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
                                        @php
                                            $emailName = substr($guest->email, 0, strpos($guest->email, '@')); // Bagian sebelum "@"
                                            $emailDomain = substr($guest->email, strpos($guest->email, '@') + 1); // Bagian setelah "@"
                                            $emailHidden = substr($emailName, 0, 3) . str_repeat('*', max(strlen($emailName) - 6, 0)) . substr($emailName, -3) . '@' . $emailDomain;
                                        @endphp
                                        <span class="inline-block sm:hidden"> {{-- Untuk perangkat mobile --}}
                                            @if(strlen($emailName) > 12)
                                                {{ substr($emailHidden, 0, 12) }}<br>{{ substr($emailHidden, 12) }}
                                            @else
                                                {{ $emailHidden }}
                                            @endif
                                        </span>

                                        <span class="hidden sm:inline"> {{-- Untuk perangkat lebih besar --}}
                                            {{ $emailHidden }}
                                        </span>
                                    @else
                                        Email tidak tersedia
                                    @endif
                                </p>



                            </div>
                        </div>

                        <!-- Informasi Status dan Waktu -->
                        <div class="text-left sm:text-right mt-3 sm:mt-0">
                            @if($isEstimated)
                                <!-- Jika status masih process (estimasi waktu) -->
                                <p class="font-medium text-blue-600">
                                    Estimasi Check-in: {{ \Carbon\Carbon::parse($visit->check_in)->format('H:i') }}
                                </p>
                                <p class="font-medium text-blue-600 mt-1">
                                    Estimasi Check-out: {{ \Carbon\Carbon::parse($visit->check_out)->format('H:i') }}
                                </p>
                            @elseif($isCheckedIn)
                                <!-- Jika status approved atau done (real check-in/check-out) -->
                                <p class="font-medium text-blue-600">
                                    Check-in: {{ \Carbon\Carbon::parse($visit->check_in)->format('H:i') }}
                                </p>
                                <p class="font-medium text-blue-600 mt-1">
                                    Check-out: {{ \Carbon\Carbon::parse($visit->check_out)->format('H:i') }}
                                </p>
                            @endif
                            @php
                                    $statusTranslation = [
                                    'approved' => 'Diterima',
                                    'pending' => 'Menunggu Konfirmasi',
                                    'process' => 'Proses',
                                    'declined' => 'Ditolak',
                                    'done' => 'Selesai',
                                    'not_attend' => 'Tidak Hadir',
                                ];

                                // Ambil terjemahan status saat ini
                                $translatedStatus = $statusTranslation[$visit->status] ?? ucfirst($visit->status);
                            @endphp
                            <p class="text-sm mt-2">
                                Status:
                                <span class="font-medium px-3 py-1 rounded-lg text-white
                                    @if($visit->status === 'approved') bg-blue-500
                                    @elseif($visit->status === 'pending') bg-yellow-500
                                    @elseif($visit->status === 'process') bg-gray-400
                                    @elseif($visit->status === 'declined') bg-red-500
                                    @elseif($visit->status === 'done') bg-green-500
                                    @elseif($visit->status === 'not_attend') bg-red-700
                                    @endif">
                                    {{ $translatedStatus }}

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
                {{ $visits->links() }}
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const organizationLatitude = parseFloat('{{ $organization->latitude }}');
            const organizationLongitude = parseFloat('{{ $organization->longitude }}');
            const checkInButton = document.getElementById('check-in-btn');
            const checkOutButton = document.getElementById('check-out-btn');

            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    function (position) {
                        const userLatitude = position.coords.latitude;
                        const userLongitude = position.coords.longitude;

                        const distance = calculateDistance(
                            organizationLatitude,
                            organizationLongitude,
                            userLatitude,
                            userLongitude
                        );

                        if (distance <= 100) {
                            checkInButton.classList.remove('hidden');
                            checkOutButton.classList.remove('hidden');
                        } else {
                            checkInButton.classList.add('hidden');
                            checkOutButton.classList.add('hidden');
                            // alert('Anda berada di luar jangkauan lokasi. Check-In tidak tersedia.');
                        }
                    },
                    function (error) {
                        alert('Harap hidupkan GPS Anda untuk melanjutkan.');
                    },
                    { enableHighAccuracy: true }
                );
            } else {
                alert('Geolokasi tidak didukung di perangkat Anda.');
            }

            function calculateDistance(lat1, lon1, lat2, lon2) {
                const R = 6371e3; // Radius bumi dalam meter
                const phi1 = (lat1 * Math.PI) / 180;
                const phi2 = (lat2 * Math.PI) / 180;
                const deltaPhi = ((lat2 - lat1) * Math.PI) / 180;
                const deltaLambda = ((lon2 - lon1) * Math.PI) / 180;

                const a =
                    Math.sin(deltaPhi / 2) * Math.sin(deltaPhi / 2) +
                    Math.cos(phi1) *
                        Math.cos(phi2) *
                        Math.sin(deltaLambda / 2) *
                        Math.sin(deltaLambda / 2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                return R * c; // Jarak dalam meter
            }
        });
    </script>

    @endpush

</div>



