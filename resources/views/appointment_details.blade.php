<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Janji Temu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <section class="container mx-auto mt-8 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold mb-4">Detail Janji Temu</h2>
            <p class="text-gray-600 mb-6">Berikut adalah detail dari janji temu yang Anda pilih.</p>

            <!-- Detail Janji Temu -->
            <div class="space-y-4">
                <p class="font-semibold">Nama: {{ $appointment->guest->name }}</p>
                <p class="text-sm text-gray-500">Organisasi: {{ $appointment->guest->organization }}</p>
                <p class="text-sm text-gray-500">Tanggal: {{ \Carbon\Carbon::parse($appointment->check_in)->format('d M Y') }}</p>
                <p class="text-sm text-gray-500">Waktu: {{ \Carbon\Carbon::parse($appointment->check_in)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->check_out)->format('H:i') }}</p>
                <p class="font-semibold">Status: {{ $appointment->status }}</p>
            </div>
        </div>
    </section>

</body>
</html>
