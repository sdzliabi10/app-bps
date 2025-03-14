@extends('layouts.app')

@section('title', 'Profil Desa')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold text-gray-800">Profil Desa</h1>
    <p class="mt-4 text-gray-600">Informasi mengenai desa dan kelurahan...</p>

    <form id="filterForm" class="mt-6 flex flex-wrap items-end gap-4">
        <div class="w-full md:w-auto">
            <label for="kecamatan" class="block text-gray-700 font-semibold">Kecamatan</label>
            <select id="kecamatan" name="kecamatan" class="w-full md:w-40 p-2 border rounded-md">
                <option value="" {{ request('kecamatan') == '' ? 'selected' : '' }}>Pilih Kecamatan</option>
                <option value="kecamatan1" {{ request('kecamatan') == 'kecamatan1' ? 'selected' : '' }}>Kecamatan 1</option>
                <option value="kecamatan2" {{ request('kecamatan') == 'kecamatan2' ? 'selected' : '' }}>Kecamatan 2</option>
                <option value="kecamatan3" {{ request('kecamatan') == 'kecamatan3' ? 'selected' : '' }}>Kecamatan 3</option>
            </select>
        </div>

        <div class="w-full md:w-auto">
            <label for="desa" class="block text-gray-700 font-semibold">Desa</label>
            <select id="desa" name="desa" class="w-full md:w-40 p-2 border rounded-md">
                <option value="" {{ request('desa') == '' ? 'selected' : '' }}>Pilih Desa</option>
                <option value="desa1" {{ request('desa') == 'desa1' ? 'selected' : '' }}>Desa 1</option>
                <option value="desa2" {{ request('desa') == 'desa2' ? 'selected' : '' }}>Desa 2</option>
                <option value="desa3" {{ request('desa') == 'desa3' ? 'selected' : '' }}>Desa 3</option>
            </select>
        </div>

        <div class="w-full md:w-auto">
            <label for="tahun" class="block text-gray-700 font-semibold">Tahun</label>
            <select id="tahun" name="tahun" class="w-full md:w-32 p-2 border rounded-md">
                <option value="" {{ request('tahun') == '' ? 'selected' : '' }}>Pilih Tahun</option>
                @for ($i = date('Y'); $i >= 2000; $i--)
                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="w-full md:w-auto bg-green-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-700 transition duration-300">
            Tampilkan Data
        </button>
    </form>


    @if(!request()->has('kecamatan') && !request()->has('desa') && !request()->has('tahun'))
    <!-- Bagian Visi dan Misi Desa -->
    <div class="mt-12 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-green-800 text-center">Visi dan Misi Desa</h2>

        <div class="mt-6 flex flex-col md:flex-row items-center gap-6">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/kantorbbs.jpg') }}" alt="Visi dan Misi" class="w-full rounded-lg shadow-md">
            </div>

            <div class="w-full md:w-1/2 space-y-4">
                <div class="bg-gradient-to-r from-green-100 to-green-300 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-900">Visi</h3>
                    <p class="text-gray-800 mt-2 italic">
                        "Mewujudkan desa yang maju, mandiri, dan sejahtera berbasis kearifan lokal serta partisipasi masyarakat."
                    </p>
                </div>

                <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-900">Misi</h3>
                    <ul class="list-disc list-inside text-gray-800 mt-2 space-y-1">
                        <li>Meningkatkan kesejahteraan masyarakat melalui pembangunan ekonomi.</li>
                        <li>Memperkuat nilai budaya dan kearifan lokal.</li>
                        <li>Meningkatkan kualitas pendidikan dan kesehatan.</li>
                        <li>Membangun infrastruktur desa yang berkelanjutan.</li>
                        <li>Meningkatkan partisipasi aktif masyarakat dalam pembangunan desa.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Wilayah -->
    <div class="mt-8 p-4 bg-gray-100 shadow-lg rounded-lg border border-gray-200">
        <h2 class="text-xl font-bold text-green-800 text-center">Informasi Wilayah</h2>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="flex justify-center">
                <img src="{{ asset('images/petabbs.png') }}" alt="Peta Wilayah" class="max-w-[250px] max-h-[250px] w-full h-auto rounded-lg shadow-md object-cover">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/map.png') }}" alt="Luas Wilayah" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Luas Wilayah</h3>
                    <p class="text-sm text-gray-600">150 km²</p>
                </div>

                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/kec.png') }}" alt="Jumlah Kecamatan" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Jumlah Kecamatan</h3>
                    <p class="text-sm text-gray-600">10 Kecamatan</p>
                </div>

                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/residential.png') }}" alt="Jumlah Desa" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Jumlah Desa</h3>
                    <p class="text-sm text-gray-600">50 Desa</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Konten Data Profil Desa -->
    <div id="dataContainer" class="mt-6">
        @if(request()->has('kecamatan') || request()->has('desa') || request()->has('tahun'))
        <p class="text-lg text-gray-700">Menampilkan data untuk:</p>
        <ul class="list-disc pl-5">
            @if(request('kecamatan'))
            <li><strong>Kecamatan:</strong> {{ request('kecamatan') }}</li>
            @endif
            @if(request('desa'))
            <li><strong>Desa:</strong> {{ request('desa') }}</li>
            @endif
            @if(request('tahun'))
            <li><strong>Tahun:</strong> {{ request('tahun') }}</li>
            @endif
        </ul>

        <!-- Contoh Data -->
        <div class="mt-4 p-4 border rounded-md bg-gray-100">
            <p class="text-gray-700">Data terkait akan ditampilkan di sini...</p>
        </div>
        @endif
    </div>
</div>
<script>
    document.getElementById("filterForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah form mengirim request ke server langsung

        // Ambil nilai dari dropdown
        const kecamatan = document.getElementById("kecamatan").value;
        const desa = document.getElementById("desa").value;
        const tahun = document.getElementById("tahun").value;

        // Bangun query parameter
        let params = new URLSearchParams();
        if (kecamatan) params.append("kecamatan", kecamatan);
        if (desa) params.append("desa", desa);
        if (tahun) params.append("tahun", tahun);

        // Redirect ke URL dengan query parameter tanpa berpindah route
        window.location.href = "/profil-desa?" + params.toString();
    });
</script>
@endsection