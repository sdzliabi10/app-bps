<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amongrasa - Aplikasi Monografi Desa</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Hero Section dengan Menu Section -->
    <div class="relative w-full min-h-screen bg-cover bg-center" style="background-image: url('/storage/bg-image.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 flex flex-col items-center justify-start h-full text-center text-white pt-10">
        <img src="/storage/logo.png" alt="Logo" class="w-20 h-20 mb-4">
        <h1 class="text-4xl font-bold">AMONGRASA</h1>
        <p class="text-lg">Aplikasi Monografi Kelurahan dan Desa</p>
        
        <div class="mt-6 flex items-center">
            <input type="text" placeholder="Mau Cari Data Apa ?" class="px-4 py-2 rounded-l-lg text-black">
            <button class="bg-blue-600 px-4 py-2 rounded-r-lg">Cari</button>
        </div>

        <!-- Menu Section -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center mt-20">
            <div class="bg-white p-6 rounded-lg shadow-md text-black">
                <img src="/storage/icon-profile.svg" class="mx-auto mb-2" width="50">
                <a href="{{ route('profil-desa') }}" class="font-semibold">Profil Desa</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-black">
                <img src="/storage/icon-data.svg" class="mx-auto mb-2" width="50">
                <p class="font-semibold">Desa Dalam Angka</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-black">
                <img src="/storage/icon-map.svg" class="mx-auto mb-2" width="50">
                <p class="font-semibold">Desa Dalam Peta</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-black">
                <img src="/storage/icon-graph.svg" class="mx-auto mb-2" width="50">
                <p class="font-semibold">Desa Dalam Grafik</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-black">
                <img src="/storage/icon-book.svg" class="mx-auto mb-2" width="50">
                <p class="font-semibold">Buku Monografi Desa</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-black">
                <img src="/storage/icon-metadata.svg" class="mx-auto mb-2" width="50">
                <p class="font-semibold">Metadata</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-black">
                <img src="/storage/icon-instrument.svg" class="mx-auto mb-2" width="50">
                <p class="font-semibold">Instrumen</p>
            </div>
        </div>
    </div>
</div>


</body>
</html>
