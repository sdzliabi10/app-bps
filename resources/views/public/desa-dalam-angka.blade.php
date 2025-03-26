{{-- resources/views/public/desa-dalam-angka.blade.php --}}
@extends('public.layouts.app')

@section('title', 'Desa Dalam Angka')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Desa Dalam Angka</h2>
    <!-- Form Filter -->
    <form id="filterForm" class="mt-6 flex flex-wrap items-end gap-4" action="{{ route('desa-dalam-angka') }}" method="GET">
        <!-- Tahun -->
        <div class="w-full md:w-auto">
            <label for="tahun" class="block text-gray-700 font-semibold">Tahun</label>
            <select id="tahun" name="tahun" class="w-full md:w-40 p-2 border rounded-md">
                <option value="">Pilih Tahun</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
        </div>

        <!-- Kategori -->
        <div class="w-full md:w-auto">
            <label for="kategori" class="block text-gray-700 font-semibold">Kategori</label>
            <select id="kategori" name="kategori" class="w-full md:w-40 p-2 border rounded-md" onchange="filterData()">
                <option value="">Pilih Kategori</option>
                @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori->kd_Kategori }}" {{ request('kategori') == $kategori->kd_Kategori ? 'selected' : '' }}>
                    {{ $kategori->nama_Kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Data -->
        <div class="w-full md:w-auto">
            <label for="data" class="block text-gray-700 font-semibold">Data</label>
            <select id="data" name="data" class="w-full md:w-40 p-2 border rounded-md" disabled>
                <option value="">Pilih Data</option>
                @foreach ($dataKategoriList as $data)
                <option value="{{ $data->id }}" data-kategori="{{ $data->kd_Kategori }}" {{ request('data') == $data->id ? 'selected' : '' }}>
                    {{ $data->nama_data }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Kecamatan -->
        <div class="w-full md:w-auto">
            <label for="kecamatan" class="block text-gray-700 font-semibold">Kecamatan</label>
            <select id="kecamatan" name="kecamatan" class="w-full md:w-40 p-2 border rounded-md" onchange="filterDesa()">
                <option value="">Pilih Kecamatan</option>
                @foreach ($kecamatanList as $kecamatan)
                <option value="{{ $kecamatan->kdkec }}" {{ request('kecamatan') == $kecamatan->kdkec ? 'selected' : '' }}>
                    {{ $kecamatan->nmkec }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Desa -->
        <div class="w-full md:w-auto">
            <label for="desa" class="block text-gray-700 font-semibold">Desa</label>
            <select id="desa" name="desa" class="w-full md:w-40 p-2 border rounded-md" disabled>
                <option value="">Pilih Desa</option>
                @foreach ($desaList as $desa)
                <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}" style="display: none;">
                    {{ $desa->nmdesa }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Button Tampilkan Data -->
        <button type="submit" class="w-full md:w-auto bg-green-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-700 transition duration-300">
            Tampilkan Data
        </button>
    </form>

    <!-- Tabel Hasil -->
    @if (request('tahun') && request('kecamatan') && request('kategori') && request('data'))
    @if (request('desa'))
    <div id="tabelHasil" class="mt-6">
        @include('public.desa angka.desa.Rumah-Warga')
        @include('public.desa angka.desa.sarana-prasarana')
        @include('public.desa angka.desa.sarana-pendukung')
        @include('public.desa angka.desa.sarana-disabilitas')
    </div>
    @else
    <div id="tabelHasil" class="mt-6">
        @include('public.desa angka.kecamatan.tempat-tinggal')
        @include('public.desa angka.kecamatan.sarana-ibadah')
    </div>
    @endif
    @endif
</div>
@endsection