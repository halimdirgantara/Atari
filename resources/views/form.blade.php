<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Janji</title>
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

    <!-- Formulir Buat Janji -->
    <section class="container mx-auto mt-8 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold mb-2">Formulir Buku Tamu</h2>
            <p class="text-gray-600 mb-6">Silakan isi formulir di bawah untuk membuat janji</p>

            <form method="POST" action="{{ route('form') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label class="text-gray-700 font-semibold mb-2 flex items-center" for="name">
                            <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">person</span>
                            Nama
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-md px-3 py-2">
                            <input type="text" id="name" name="name" class="w-full ml-2 border-none focus:ring-0" placeholder="Nama Lengkap" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-gray-700 font-semibold mb-2 flex items-center" for="email">
                            <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">email</span>
                            Email
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-md px-3 py-2">
                            <input type="email" id="email" name="email" class="w-full ml-2 border-none focus:ring-0" placeholder="Email" required>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label class="text-gray-700 font-semibold mb-2 flex items-center" for="phone">
                            <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">phone</span>
                            Telepon
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-md px-3 py-2">
                            <input type="tel" id="phone" name="phone" class="w-full ml-2 border-none focus:ring-0" placeholder="Nomor Telepon" required>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="text-gray-700 font-semibold mb-2 flex items-center" for="address">
                            <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">location_on</span>
                            Alamat
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-md px-3 py-2">
                            <input type="text" id="address" name="address" class="w-full ml-2 border-none focus:ring-0" placeholder="Alamat" required>
                        </div>
                    </div>

                    <!-- Organisasi -->
                    <div>
                        <label class="text-gray-700 font-semibold mb-2 flex items-center" for="organization">
                            <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">business</span>
                            Organisasi
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-md px-3 py-2">
                            <input type="text" id="organization" name="organization" class="w-full ml-2 border-none focus:ring-0" placeholder="Organisasi" required>
                        </div>
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="text-gray-700 font-semibold mb-2 flex items-center" for="identity_id">
                            <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">badge</span>
                            NIK
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-md px-3 py-2">
                            <input type="text" id="identity_id" name="identity_id" class="w-full ml-2 border-none focus:ring-0" placeholder="NIK" required>
                        </div>
                    </div>

                    <!-- Upload KTP -->
                    <div>
                        <label class="text-gray-700 font-semibold mb-2 flex items-center" for="identity_file">
                            <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">file_upload</span>
                            Upload KTP
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-md px-3 py-2">
                            <input type="file" id="identity_file" name="identity_file" accept=".jpg,.jpeg,.png,.pdf" class="w-full ml-2 border-none focus:ring-0" required>
                        </div>
                    </div>

                    {{-- check in dan durasi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 scroll-mt-1.5">
                        <!-- Tanggal Check-in -->
                        <div>
                            <label class="text-gray-700 font-semibold mb-2 flex items-center" for="check_in">
                                <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">calendar_today</span>
                                Tanggal Check-in
                            </label>
                            <div class="flex items-center border border-gray-300 rounded-md px-3 py-2.5">
                                <input type="datetime-local" id="check_in" name="check_in" class="w-full ml-2 border-none focus:ring-0" required>
                            </div>
                        </div>

                        <!-- Durasi -->
                        <div>
                            <label class="text-gray-700 font-semibold mb-2 flex items-center" for="duration">
                                <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">access_time</span>
                                Durasi (menit)
                            </label>
                            <div class="flex items-center border border-gray-300 rounded-md px-3 py-2.5">
                                <select id="duration" name="duration" class="w-full ml-2 border-none focus:ring-0" required>
                                    <option value="">Pilih Durasi</option>
                                    @for ($i = 30; $i <= 120; $i += 10)
                                        <option value="{{ $i }}">{{ $i }} menit</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>


                </div>



                {{-- bertemu dengan --}}
                <div class="mt-6">
                    <label class="text-gray-700 font-semibold mb-2 flex items-center" for="host_id">
                        <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">people</span>
                        Bertemu Dengan
                    </label>
                    <div class="relative">
                        <select
                            id="host_id"
                            name="host_id"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none"
                            required
                        >
                            <option value="">Pilih Pihak Yang Dituju</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    @if(old('host_id') == $user->id) selected @endif>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Keperluan -->
                <div class="mt-6">
                    <label class="text-gray-700 font-semibold mb-2 flex items-center" for="needs">
                        <span class="material-icons text-gray-500 mr-3" style="font-size: 20px">notifications</span>
                        Keperluan
                    </label>
                    <textarea id="needs" name="needs" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Keperluan" required></textarea>
                </div>

                <!-- Tombol kirim -->
                <div class="mt-8 text-center">
                    <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
