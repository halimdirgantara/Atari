<div>
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-5 sm:px-11">
            <div class="flex items-center">
                <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-8 sm:h-10 mr-4">
                <h1 class="text-base sm:text-lg font-semibold">{{ $organizationData->name }}</h1>
            </div>
            <!-- Home Button for Mobile dengan Desain Modern -->
            <div class="flex sm:hidden">
                <a href="{{ $organizationData->slug === null || $organizationData->slug === 'default' ? route('home') : route('home', ['slug' => $organizationData->slug]) }}"
                    class="flex items-center gap-2 px-4 py-1.5 bg-blue-100 text-blue-900 rounded-lg transition-all duration-300 ease-in-out transform hover:bg-amber-500 hover:shadow-md hover:scale-105 border-2 border-amber-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-8xl mx-auto">
            <div class="bg-white rounded-xl shadow-2xl p-4 sm:p-6 md:p-8 relative">
                <!-- Navigation Tabs -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 border-b pb-4 space-y-4 sm:space-y-0">
                    <!-- Buttons Group -->
                    <div class="flex flex-col sm:flex-row items-center p-2 bg-white rounded-lg shadow-sm space-y-4 sm:space-y-0 sm:space-x-6 w-full sm:w-auto">
                        <!-- Formulir Tamu Button -->
                        <button
                            wire:click="$set('showForm', true)"
                            class="w-full sm:w-auto px-4 py-2 sm:px-6 sm:py-3 rounded-lg transition-all duration-300 ease-in-out font-medium text-sm sm:text-base border-2
                            {{ $showForm
                                ? 'bg-blue-600 text-white shadow-lg transform scale-110 border-amber-500'
                                : 'border-gray-300 text-gray-600 hover:bg-gray-200 hover:border-gray-400'
                            }}"
                        >
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Check-in di Tempat</span>
                            </div>
                        </button>

                        <!-- Token Check-In Button -->
                        <button
                            wire:click="$set('showForm', false)"
                            class="w-full sm:w-auto px-4 py-2 sm:px-6 sm:py-3 rounded-lg transition-all duration-300 ease-in-out font-medium text-sm sm:text-base border-2
                            {{ !$showForm
                                ? 'bg-blue-600 text-white shadow-lg transform scale-110 border-amber-500'
                                : 'border-gray-300 text-gray-600 hover:bg-gray-200 hover:border-gray-400'
                            }}"
                        >
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                <span>Verifikasi Janji</span>
                            </div>
                        </button>
                    </div>

                    <!-- Home Button for Desktop -->
                    <div class="mt-4 sm:mt-0 flex-shrink-0 flex items-center justify-center sm:justify-start gap-2 text-blue-800 hidden sm:flex">
                        <a href="{{ $organizationData->slug === null || $organizationData->slug === 'default' ? route('home') : route('home', ['slug' => $organizationData->slug]) }}"
                            class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg transition duration-300 ease-in-out transform hover:bg-blue-200 hover:shadow-md hover:text-blue-900 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-house-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                            </svg>
                            <span class="hidden sm:inline text-sm sm:text-base font-medium">Home</span>
                        </a>
                    </div>
                </div>






                @if($showForm)
                    <!-- Check-In Form -->
                    <!-- Form -->
                    <form wire:submit.prevent="submit" class="space-y-6">
                        <!-- Data Tamu Utama -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 bg-gradient-to-r from-black to-red-600 bg-clip-text text-transparent">
                                    Formulir Tamu
                                </h2>
                            </div>

                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm sm:text-base text-gray-600">
                                    Silakan isi formulir di bawah ini untuk melakukan check-in Secara langsung di Tempat
                                </p>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Tamu Utama</h3>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 p-6 bg-gray-50 rounded-lg shadow-lg">
                                <div class="space-y-4">
                                    <label for="name" class="text-gray-700 font-semibold flex items-center">
                                        <span class="material-icons text-blue-600 mr-2">person</span> Nama
                                    </label>
                                    <input type="text" id="name" wire:model="name" placeholder="Nama Lengkap"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label for="email" class="text-gray-700 font-semibold flex items-center">
                                        <span class="material-icons text-blue-600 mr-2">email</span> Email
                                    </label>
                                    <input type="email" id="email" wire:model="email" placeholder="Email"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label for="phone" class="text-gray-700 font-semibold flex items-center">
                                        <span class="material-icons text-blue-600 mr-2">phone</span> Telepon
                                    </label>
                                    <input type="tel" id="phone" wire:model="phone" placeholder="Nomor Telepon"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label for="address" class="text-gray-700 font-semibold flex items-center">
                                        <span class="material-icons text-blue-600 mr-2">location_on</span> Alamat
                                    </label>
                                    <input type="text" id="address" wire:model="address" placeholder="Alamat"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label for="identity_id" class="text-gray-700 font-semibold flex items-center">
                                        <span class="material-icons text-blue-600 mr-2">person</span> NIK
                                    </label>
                                    <input type="number" id="identity_id" wire:model="identity_id" placeholder="NIK Tamu"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('identity_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label for="identity_file" class="text-gray-700 font-semibold flex items-center">
                                        <span class="material-icons text-blue-600 mr-2">person</span> KTP
                                    </label>
                                    <input type="file" id="identity_file" wire:model="identity_file" placeholder="KTP Tamu"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('identity_file') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tamu Tambahan -->
                        <div>

                            @foreach ($guests as $index => $guest)
                                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg mb-4">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-lg font-semibold">Tamu {{ $index + 2 }}</h4>
                                        <button type="button" wire:click="removeGuest({{ $index }})"
                                            class="text-red-500 hover:text-red-700 flex items-center">
                                            <span class="material-icons mr-1">delete</span> Hapus
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div class="space-y-2">
                                            <label for="name" class="text-gray-700 font-medium flex items-center">
                                                <span class="material-icons text-blue-600 mr-2">person</span> Nama
                                            </label>
                                            <input type="text" wire:model="guests.{{ $index }}.name" placeholder="Nama Lengkap"
                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error("guests.{$index}.name") <span
                                            class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="email" class="text-gray-700 font-medium flex items-center">
                                                <span class="material-icons text-blue-600 mr-2">email</span> Email
                                            </label>
                                            <input type="email" wire:model="guests.{{ $index }}.email" placeholder="Email"
                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error("guests.{$index}.email") <span
                                            class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="address" class="text-gray-700 font-medium flex items-center">
                                                <span class="material-icons text-blue-600 mr-2">location_on</span> Telepon
                                            </label>
                                            <input type="tel" wire:model="guests.{{ $index }}.phone" placeholder="Nomor Telepon"
                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error("guests.{$index}.phone") <span
                                            class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="address" class="text-gray-700 font-medium flex items-center">
                                                <span class="material-icons text-blue-600 mr-2">location_on</span> Alamat
                                            </label>
                                            <input type="text" wire:model="guests.{{ $index }}.address" placeholder="Alamat"
                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error("guests.{$index}.address") <span
                                            class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="name" class="text-gray-700 font-medium flex items-center">
                                                <span class="material-icons text-blue-600 mr-2">person</span> NIK
                                            </label>
                                            <input type="number" wire:model="guests.{{ $index }}.identity_id" placeholder="NIK"
                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error("guests.{$index}.identity_id") <span
                                            class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="name" class="text-gray-700 font-medium flex items-center">
                                                <span class="material-icons text-blue-600 mr-2">person</span> KTP
                                            </label>
                                            <input type="file" wire:model="guests.{{ $index }}.identity_file"
                                                accept=".jpg,.jpeg,.png,.pdf"
                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error("guests.{$index}.identity_file") <span
                                            class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex justify-center">
                                <button type="button" wire:click="addGuest" class="mt-1 bg-amber-600 text-white px-4 py-2 rounded-lg transition duration-300 ease-in-out transform hover:bg-amber hover:scale-105 hover:shadow-lg
                                    sm:px-6 sm:py-3 md:px-4 md:py-2">
                                    <span>
                                        <i class="fas fa-user-plus mr-2"></i> Tambah Tamu
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg shadow-md space-y-6">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Detail Kunjungan</h3>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="space-y-4">
                                    <label for="organization" class="text-gray-700 font-semibold flex items-center">
                                        <span class="material-icons text-blue-600 mr-2">business</span> Nama Organisasi Tamu
                                    </label>
                                    <input type="text" id="organization" wire:model="organization"
                                        placeholder="Nama Organisasi Tamu"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('organization') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label class="text-gray-700 font-semibold flex items-center" for="check_in">
                                        <span class="material-icons text-blue-600 mr-2">calendar_today</span>
                                        Tanggal dan Waktu Check-in
                                    </label>
                                    <input type="datetime-local" id="check_in" wire:model="check_in"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                    @error('check_in') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label class="text-gray-700 font-semibold flex items-center" for="duration">
                                        <span class="material-icons text-blue-600 mr-2">access_time</span>
                                        Durasi
                                    </label>
                                    <select id="duration" wire:model="duration"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                        <option value="">Pilih Durasi</option>
                                        <option value="15">15 menit</option>
                                        <option value="30">30 menit</option>
                                        <option value="45">45 menit</option>
                                        <option value="60">60 menit</option>
                                    </select>
                                    @error('duration') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-4">
                                    <label class="text-gray-700 font-semibold flex items-center" for="host_id">
                                        <span class="material-icons text-blue-600 mr-2">people</span>
                                        Bertemu Dengan
                                    </label>
                                    <select id="host_id" wire:model="host_id"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md">
                                        <option value="">Pilih Pihak Yang Dituju</option>
                                        @if(!empty($users) && count($users) > 0)
                                            @foreach($users as $user)
                                                <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Tidak ada pihak yang tersedia</option>
                                        @endif
                                    </select>
                                    @error('host_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="text-gray-700 font-semibold flex items-center" for="needs">
                                    <span class="material-icons text-blue-600 mr-2">notifications</span>
                                    Keperluan
                                </label>
                                <textarea id="needs" wire:model="needs" rows="4"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out hover:shadow-md"
                                    placeholder="Keperluan"></textarea>
                                @error('needs') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>



                        <!-- Submit Button -->
                        <div class="text-center pt-6">
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-transform duration-200 hover:scale-105"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span wire:loading.remove>Check-in</span>
                                <span wire:loading>
                                    <i class="fas fa-circle-notch fa-spin mr-2"></i> Memproses...
                                </span>
                            </button>
                        </div>

                    </form>
                @else
                    <!-- Token Search -->
                    <div class="space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 bg-gradient-to-r from-black to-red-600 bg-clip-text text-transparent">
                                    Verifikasi Tamu
                                </h2>
                            </div>

                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm sm:text-base text-gray-600">
                                    Masukkan token yang telah diberikan untuk mengkonfirmasi janji kunjungan Anda
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 mb-8">
                            <input
                                type="text"
                                wire:model="guest_token"
                                placeholder="Masukkan Token Tamu"
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            >
                            <button
                                wire:click="searchAppointment"
                                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition duration-300"
                            >
                                Cari
                            </button>
                        </div>

                        @if($appointment)
                            <!-- Appointment Details -->
                            <div class="bg-white rounded-xl sm:p-6 shadow-lg p-8 max-w-8xl mx-auto">
                                <!-- Header -->
                                <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
                                    <h3 class="text-2xl font-bold text-gray-800">Detail Janji</h3>

                                </div>

                                <!-- Guest Information -->
                                <div class="grid gap-6 mb-8">
                                    @foreach($appointment->guests as $index => $guest)
                                        <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                            <div class="bg-gray-50 rounded-lg p-4 sm:p-6 border-l-4 {{ $index === 0 ? 'border-blue-500' : 'border-gray-300' }}">
                                                <!-- Header dengan Avatar dan Nama -->
                                                <div class="flex flex-wrap items-center mb-4">
                                                    <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-{{ $index === 0 ? 'blue' : 'gray' }}-100 flex items-center justify-center">
                                                        <span class="text-{{ $index === 0 ? 'blue' : 'gray' }}-600 font-semibold text-sm sm:text-base">
                                                            {{ substr($guest->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <h4 class="ml-3 sm:ml-4 text-base sm:text-lg font-semibold text-gray-800">
                                                        {{ $index === 0 ? 'Tamu Utama' : 'Tamu ' . ($index + 1) }}
                                                    </h4>
                                                </div>

                                                <!-- Info Grid -->
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-sm">
                                                    <!-- Kolom Kiri -->
                                                    <div class="space-y-3">
                                                        <!-- Nama -->
                                                        <p class="flex items-center text-gray-600 break-words">
                                                            <svg class="flex-shrink-0 w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                            <span class="flex-1 min-w-0">{{ $guest->name }}</span>
                                                        </p>
                                                        <!-- hidden -->
                                                        @php
                                                            $email_parts = explode('@', $guest->email);
                                                            $email_name = $email_parts[0];
                                                            $email_domain = $email_parts[1];
                                                            $hidden_email = substr($email_name, 0, 1) . str_repeat('*', max(strlen($email_name) - 2, 0)) . substr($email_name, -1) . '@' . $email_domain;
                                                            $hidden_identity_id = substr($guest->identity_id, 0, 1) . str_repeat('*', max(strlen($guest->identity_id) - 2, 0)) . substr($guest->identity_id, -1);
                                                        @endphp
                                                        <!-- Email -->
                                                        <p class="flex items-center text-gray-600 break-all">
                                                            <svg class="flex-shrink-0 w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                            </svg>
                                                            <span class="flex-1 min-w-0">{{ $hidden_email }}</span>
                                                        </p>

                                                    </div>
                                                    <!-- Kolom Kanan -->
                                                    <div class="space-y-3">
                                                        <!-- Telepon -->
                                                        <p class="flex items-center text-gray-600">
                                                            <svg class="flex-shrink-0 w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                            </svg>
                                                            <span class="flex-1 min-w-0">{{ $guest->phone }}</span>
                                                        </p>
                                                        <!-- ID -->
                                                        <p class="flex items-center text-gray-600">
                                                            <svg class="flex-shrink-0 w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                                            </svg>
                                                            <span class="flex-1 min-w-0">{{ $hidden_identity_id }}</span>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Visit Information -->
                                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Informasi Kunjungan
                                    </h4>
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="space-y-4">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-gray-500">Organisasi Tamu</p>
                                                    <p class="font-medium text-gray-800">{{ $guest->organization ?? 'Tidak Diketahui' }}</p>
                                                </div>
                                            </div>
                                            {{-- <div class="flex items-center">
                                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-gray-500">Check-In</p>
                                                    <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($appointment->check_in)->format('d M Y H:i') }}</p>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="space-y-4">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-gray-500">Bertemu Dengan</p>
                                                    <p class="font-medium text-gray-800">{{ $appointment->host->name ?? 'Tidak Diketahui' }}</p>
                                                </div>
                                            </div>
                                            {{-- <div class="flex items-center">
                                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-gray-500">Check-Out</p>
                                                    <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($appointment->check_out)->format('d M Y H:i') }}</p>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-gray-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Keperluan</p>
                                                <p class="font-medium text-gray-800">{{ $appointment->needs }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Check-In Button -->
                                <div class="text-center">
                                    <button
                                        wire:click="confirmCheckIn"
                                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-transform duration-200 hover:scale-105"
                                    >
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Check-In
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            function copyToClipboard(token) {
                navigator.clipboard.writeText(token)
                    .then(() => {
                        Livewire.dispatch('copied');
                    })
                    .catch(() => {
                        Livewire.dispatch('alert', {
                            data: {
                                type: 'error',
                                title: 'Gagal menyalin token',
                                text: 'Silakan coba lagi'
                            }
                        });
                    });
            }
        </script>
    @endpush
</div>
