@extends('public.layouts.app')

@section('title', 'Profil Desa')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold text-gray-800">Profil Desa</h1>
    <p class="mt-4 text-gray-600">Informasi mengenai desa dan kelurahan...</p>

    <form action="{{ route('profil-desa') }}" method="GET">
        <div class="mt-6 flex flex-wrap items-end gap-2 md:gap-4">
            <div class="w-full md:w-auto">
                <label for="kecamatan" class="block text-gray-700 font-semibold">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" class="w-full md:w-40 p-2 border rounded-md">
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($profilDesas->unique('kecamatan') as $profil)
                        <option value="{{ $profil->kecamatan }}" {{ request('kecamatan') == $profil->kecamatan ? 'selected' : '' }}>
                            {{ $profil->kecamatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-auto">
                <label for="desa" class="block text-gray-700 font-semibold">Desa</label>
                <select id="desa" name="desa" class="w-full md:w-40 p-2 border rounded-md">
                    <option value="">Pilih Desa</option>
                    @foreach ($profilDesas->unique('desa') as $profil)
                        <option value="{{ $profil->desa }}" {{ request('desa') == $profil->desa ? 'selected' : '' }}>
                            {{ $profil->desa }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-auto">
                <label for="tahun" class="block text-gray-700 font-semibold">Tahun</label>
                <select id="tahun" name="tahun" class="w-full md:w-32 p-2 border rounded-md">
                    <option value="">Pilih Tahun</option>
                    @for ($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <button class="w-full md:w-auto bg-green-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-700 transition duration-300">
                Tampilkan Data
            </button>
        </div>
    </form>

    <div class="mt-12 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-green-800 text-center">Visi dan Misi Desa</h2>
    
        @if($profilDesas && $profilDesas->isNotEmpty())
            @foreach ($profilDesas as $profilDesa)
            <div class="mt-6 flex flex-col md:flex-row items-center gap-6">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/kantorbbs.jpg') }}" alt="Visi dan Misi" class="w-full rounded-lg shadow-md">
                </div>
    
                {{-- <div class="w-full md:w-1/2 space-y-4">
                    <div class="bg-gradient-to-r from-green-100 to-green-300 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-green-900">Visi</h3>
                        <p class="text-gray-800 mt-2 italic">
                            {{ $profilDesa->visi_misi }}
                        </p>
                    </div>
    
                    <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-green-900">Misi</h3>
                        <ul class="list-disc list-inside text-gray-800 mt-2 space-y-1">
                            @foreach ($profilDesa->misi as $misi)
                            <li>{{ $misi }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}
            </div>
            @endforeach
        @else
            <p>No data available</p>
        @endif
    </div>

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
                    <p class="text-sm text-gray-600">{{ $profilDesa->luas_wilayah ?? 'Data tidak tersedia' }}</p>
                </div>

                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/kec.png') }}" alt="Jumlah Kecamatan" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Jumlah Kecamatan</h3>
                    <p class="text-sm text-gray-600">{{ $profilDesa->jumlah_kecamatan ?? 'Data tidak tersedia' }}</p>
                </div>

                <div class="bg-white p-3 rounded-lg shadow-md text-center flex flex-col items-center">
                    <img src="{{ asset('icons/residential.png') }}" alt="Jumlah Desa" class="w-8 h-8 mb-1">
                    <h3 class="text-base font-semibold text-gray-700">Jumlah Desa</h3>
                    <p class="text-sm text-gray-600">{{ $profilDesa->jumlah_desa ?? 'Data tidak tersedia' }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
