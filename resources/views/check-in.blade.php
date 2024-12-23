<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Janji</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Header dengan Shadow -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-4 sm:px-6 lg:px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-10 mr-4">
            <h1 class="text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>

<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-2xl p-4 sm:p-6 md:p-8 relative">
            <!-- Form Header -->
            <div class="mb-8 border-b pb-4">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Formulir Buku Tamu</h2>
                <p class="text-sm sm:text-base text-gray-600 mt-2">Silakan isi formulir di bawah untuk membuat janji</p>

                <!-- Home Icon Button -->
                <div class="mt-4 sm:mt-0 sm:absolute sm:top-9 sm:right-10 flex items-center gap-2 text-blue-800">
                    <a href="{{ route('landing', ['slug' => $organization->slug]) }}" class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg hover:bg-blue-200 hover:shadow-md hover:text-blue-900 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                        </svg>
                        <span class="text-sm sm:text-base font-medium">Beranda</span>
                    </a>
                </div>

            </div>

            <form method="POST" action="{{ route('check-in', ['slug' => $organization->slug]) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Primary Guest Information -->
                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Tamu Utama</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="name">
                                <span class="material-icons text-blue-600 mr-2">person</span>
                                Nama
                            </label>
                            <input type="text" id="name" name="name"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Nama Lengkap" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="email">
                                <span class="material-icons text-blue-600 mr-2">email</span>
                                Email
                            </label>
                            <input type="email" id="email" name="email"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Email" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="phone">
                                <span class="material-icons text-blue-600 mr-2">phone</span>
                                Telepon
                            </label>
                            <input type="tel" id="phone" name="phone"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nomor Telepon" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="address">
                                <span class="material-icons text-blue-600 mr-2">location_on</span>
                                Alamat
                            </label>
                            <input type="text" id="address" name="address"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Alamat" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="identity_file">
                                <span class="material-icons text-blue-600 mr-2">file_upload</span>
                                Upload KTP (Jika Ada)
                            </label>
                            <input type="file" id="identity_file" name="identity_file" accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full px-3 py-1.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="identity_id">
                                <span class="material-icons text-blue-600 mr-2">badge</span>
                                NIK
                            </label>
                            <input type="number" id="identity_id" name="identity_id"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Masukkan NIK" min="0" oninput="this.value = this.value.slice(0, 16)">
                        </div>
                    </div>
                </div>

                <div id="guest-container" class="-space-y-5"></div>
                <div class="flex justify-end pt-4">
                    <button type="button" id="add-guest"
                        class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors duration-200">
                        <span class="material-icons mr-2">person_add</span>
                        Tambah Tamu
                    </button>
                </div>

                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg space-y-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Detail Kunjungan</h3>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="organization">
                                <span class="material-icons text-blue-600 mr-2">business</span>
                                Organisasi
                            </label>
                            <input type="text" id="organization" name="organization"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Organisasi" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="check_in">
                                <span class="material-icons text-blue-600 mr-2">calendar_today</span>
                                Tanggal Check-in
                            </label>
                            <input type="datetime-local" id="check_in" name="check_in"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="duration">
                                <span class="material-icons text-blue-600 mr-2">access_time</span>
                                Durasi
                            </label>
                            <select id="duration" name="duration"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">Pilih Durasi</option>
                                <option value="15">15 menit</option>
                                <option value="30">30 menit</option>
                                <option value="45">45 menit</option>
                                <option value="60">60 menit</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="host_id">
                                <span class="material-icons text-blue-600 mr-2">people</span>
                                Bertemu Dengan
                            </label>
                            <select id="host_id" name="host_id"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">Pilih Pihak Yang Dituju</option>
                                @foreach($users->where('organization_id', $organization->id) as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-gray-700 font-medium flex items-center" for="needs">
                            <span class="material-icons text-blue-600 mr-2">notifications</span>
                            Keperluan
                        </label>
                        <textarea id="needs" name="needs" rows="4"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Keperluan" required></textarea>
                    </div>
                </div>

                <div class="text-center pt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-6 sm:px-8 py-2 sm:py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

    <script>
        let guestCount = 1;

        document.getElementById('add-guest').addEventListener('click', function() {
            guestCount++;
            const guestHtml = `
                <div class="guest-form bg-gray-50 p-4 sm:p-6 rounded-lg" id="guest-${guestCount}">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Tamu ${guestCount}</h3>
                        <button type="button" onclick="removeGuest(${guestCount})"
                            class="text-red-500 hover:text-red-700 flex items-center transition-colors duration-200">
                            <span class="material-icons mr-1">delete</span>
                            Hapus
                        </button>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center">
                                <span class="material-icons text-blue-600 mr-2">person</span>
                                Nama
                            </label>
                            <input type="text" name="guests[${guestCount}][name]"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Nama Lengkap" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center">
                                <span class="material-icons text-blue-600 mr-2">email</span>
                                Email
                            </label>
                            <input type="email" name="guests[${guestCount}][email]"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Email" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center">
                                <span class="material-icons text-blue-600 mr-2">phone</span>
                                Telepon
                            </label>
                            <input type="tel" name="guests[${guestCount}][phone]"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Nomor Telepon" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center">
                                <span class="material-icons text-blue-600 mr-2">location_on</span>
                                Alamat
                            </label>
                            <input type="text" name="guests[${guestCount}][address]"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Alamat" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center">
                                <span class="material-icons text-blue-600 mr-2">file_upload</span>
                                Upload KTP
                            </label>
                            <input type="file" name="guests[${guestCount}][identity_file]" accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center">
                                <span class="material-icons text-blue-600 mr-2">badge</span>
                                NIK
                            </label>
                            <input type="number" name="guests[${guestCount}][identity_id]"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="NIK" min="0" oninput="this.value = this.value.slice(0, 16)">
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('guest-container').insertAdjacentHTML('beforeend', guestHtml);
        });

        // Fungsi untuk menghapus form tamu
        function removeGuest(index) {
            const guestElement = document.getElementById(`guest-${index}`);
            if (guestElement) {
                guestElement.remove();
            }
        }
    </script>


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
