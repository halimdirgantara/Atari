<div>
    <!-- Header -->
    <header class="bg-blue-900 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center px-4 sm:px-6 lg:px-11">
            <img src="{{ asset('images/logo_skd.png') }}" alt="Logo" class="h-10 mr-4">
            <h1 class="text-lg font-semibold">BUKU TAMU DARING</h1>
        </div>
    </header>


    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-xl shadow-2xl p-4 sm:p-6 md:p-8 relative">
                <!-- Form Header -->
                <div class="mb-8 border-b pb-4">
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">Formulir Buku Tamu</h2>
                    <p class="text-sm sm:text-base text-gray-600 mt-2">Silakan isi formulir di bawah untuk membuat janji
                    </p>
                    <div
                        class="mt-4 sm:mt-0 sm:absolute sm:top-9 sm:right-10 flex items-center gap-2 text-blue-800 justify-center sm:justify-end">
                        <a href="{{ $organizationData->slug === null || $organizationData->slug === 'default' ? route('home') : route('home', ['slug' => $organizationData->slug]) }}"
                            class="flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-lg transition duration-300 ease-in-out transform hover:bg-blue-200 hover:shadow-md hover:text-blue-900 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-house-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                            </svg>
                            <span class="text-sm sm:text-base font-medium">Home</span>
                        </a>
                    </div>

                </div>

                <!-- Form -->
                <form wire:submit.prevent="submit" class="space-y-6">
                    <!-- Data Tamu Utama -->
                    <div class="bg-gray-50 p-4 sm:p-6 rounded-lg">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Tamu Utama</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="name" class="text-gray-700 font-medium flex items-center">
                                    <span class="material-icons text-blue-600 mr-2">person</span> Nama
                                </label>
                                <input type="text" id="name" wire:model="name" placeholder="Nama Lengkap"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-gray-700 font-medium flex items-center">
                                    <span class="material-icons text-blue-600 mr-2">email</span> Email
                                </label>
                                <input type="email" id="email" wire:model="email" placeholder="Email"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="phone" class="text-gray-700 font-medium flex items-center">
                                    <span class="material-icons text-blue-600 mr-2">phone</span> Telepon
                                </label>
                                <input type="tel" id="phone" wire:model="phone" placeholder="Nomor Telepon"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="address" class="text-gray-700 font-medium flex items-center">
                                    <span class="material-icons text-blue-600 mr-2">location_on</span> Alamat
                                </label>
                                <input type="text" id="address" wire:model="address" placeholder="Alamat"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="name" class="text-gray-700 font-medium flex items-center">
                                    <span class="material-icons text-blue-600 mr-2">person</span> NIK
                                </label>
                                <input type="number" id="identity_id" wire:model="identity_id" placeholder="NIK Tamu"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('identity_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="name" class="text-gray-700 font-medium flex items-center">
                                    <span class="material-icons text-blue-600 mr-2">person</span> KTP
                                </label>
                                <input type="file" id="identity_file" wire:model="identity_file" placeholder="KTP Tamu"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('identity_file') <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
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
                            <button type="button" wire:click="addGuest" class="mt-1 bg-green-500 text-white px-4 py-2 rounded-lg transition duration-300 ease-in-out transform hover:bg-green-900 hover:scale-105 hover:shadow-lg
                                sm:px-6 sm:py-3 md:px-4 md:py-2">
                                <span>
                                    <i class="fas fa-user-plus mr-2"></i> Tambah Tamu
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 sm:p-6 rounded-lg space-y-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Detail Kunjungan</h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="organization" class="text-gray-700 font-medium flex items-center">
                                    <span class="material-icons text-blue-600 mr-2">business</span> Nama Organisasi Tamu
                                </label>
                                <input type="text" id="organization" wire:model="organization"
                                    placeholder="Nama Organisasi Tamu"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('organization') <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="space-y-2">
                                <label class="text-gray-700 font-medium flex items-center" for="check_in">
                                    <span class="material-icons text-blue-600 mr-2">calendar_today</span>
                                    Tanggal Check-in
                                </label>
                                <input type="datetime-local" id="check_in" wire:model="check_in"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('check_in') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-gray-700 font-medium flex items-center" for="duration">
                                    <span class="material-icons text-blue-600 mr-2">access_time</span>
                                    Durasi
                                </label>
                                <select id="duration" wire:model="duration"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih Durasi</option>
                                    <option value="15">15 menit</option>
                                    <option value="30">30 menit</option>
                                    <option value="45">45 menit</option>
                                    <option value="60">60 menit</option>
                                </select>
                                @error('duration') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-gray-700 font-medium flex items-center" for="host_id">
                                    <span class="material-icons text-blue-600 mr-2">people</span>
                                    Bertemu Dengan
                                </label>
                                <select id="host_id" wire:model="host_id"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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

                        <div class="space-y-2">
                            <label class="text-gray-700 font-medium flex items-center" for="needs">
                                <span class="material-icons text-blue-600 mr-2">notifications</span>
                                Keperluan
                            </label>
                            <textarea id="needs" wire:model="needs" rows="4"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Keperluan"></textarea>
                            @error('needs') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <div class="text-center pt-6">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold px-6 sm:px-8 py-2 sm:py-3 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg"
                        >
                            <span wire:loading.remove>Kirim</span>
                            <span wire:loading>
                                <i class="fas fa-circle-notch fa-spin mr-2"></i> Memproses...
                            </span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </main>
    @push('scripts')
        <script>
            function copyToClipboard(token) {
                navigator.clipboard.writeText(token)
                    .then(() => {
                        // Using Livewire dispatch instead of emit
                        Livewire.dispatch('copied');
                    })
                    .catch(() => {
                        // Using Livewire dispatch for error alert
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
