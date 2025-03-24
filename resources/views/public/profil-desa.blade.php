@extends('public.layouts.app')

@section('title', 'Profil Desa')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800">Profil Desa</h1>
    <p class="mt-4 text-gray-600">Informasi mengenai desa dan kelurahan...</p>

    <!-- Form Filter -->
    <form id="filterForm" class="mt-6 flex flex-wrap items-end gap-4" action="" {{ route('profil-desa') }}" method="GET">
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

        <button type="submit" class="w-full md:w-auto bg-green-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-green-700 transition duration-300">
            Tampilkan Data
        </button>
    </form>

    @if (!request()->has('kecamatan') && !request()->has('desa'))
    <!-- Bagian Visi dan Misi Desa -->
    <div class="mt-12 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-green-800 text-center">Visi dan Misi Kabupaten</h2>
        <div class="mt-6 flex flex-col md:flex-row items-center gap-6">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/kantorbbs.jpg') }}" alt="Visi dan Misi" class="w-full rounded-lg shadow-md">
            </div>
            <div class="w-full md:w-1/2 space-y-4">
                <div class="bg-gradient-to-r from-green-100 to-green-300 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-900">Visi</h3>
                    <p class="text-gray-800 mt-2 italic">
                        "Mewujudkan desa yang maju, mandiri, dan sejahtera berbasis kearifan lokal serta partisipasi
                        masyarakat."
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

    <!-- Navbar dan Konten Desa (Awalnya Disembunyikan) -->
    <div id="desa-content" class="{{ request('kecamatan') || request('desa') ? '' : 'hidden' }}">
        <!-- Navbar -->
        <nav class="mt-6 bg-white shadow-md rounded-lg p-4 border border-gray-200">
            <ul class="flex flex-wrap justify-center gap-4 border-b">
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="profil-desa">Profil Desa</button></li>
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="perangkat-desa">Perangkat Desa</button></li>
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="keuangan">Keuangan</button></li>
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="bpd">BPD</button></li>
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="kelembagaan">Kelembagaan</button></li>
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="infrastruktur">Infrastruktur</button></li>
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="transparansi">Transparansi</button></li>
                <li><button class="nav-button cursor-pointer px-4 py-2 text-gray-700 font-semibold relative transition duration-300 border-b-2 border-transparent hover:text-blue-700 hover:border-orange-500" data-target="program-tidak-mampu">Program Tidak Mampu</button></li>
            </ul>
        </nav>

        <!-- Konten Desa -->
        <div id="profil-desa" class="content-section flex flex-col md:flex-row items-center bg-white shadow-md rounded-lg p-6 border border-gray-200 mt-6">
            <!-- Gambar Desa -->
            <div class="md:w-1/3 w-full">
                @foreach ($profilDesas as $profilDesa)
                <img src="{{ asset('storage/' . $profilDesa->foto) }}" alt="Profil Desa" class="w-full h-auto rounded-lg shadow-md">
                @endforeach
            </div>

            <!-- Informasi Profil Desa -->
            <div class="md:w-2/3 w-full md:pl-6 mt-4 md:mt-0">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Profil Desa</h2>

                @foreach ($profilDesas as $profilDesa)
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Visi</h3>
                    <p class="text-gray-600">{{ $profilDesa->visi }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Misi</h3>
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach (explode("\n", $profilDesa->misi) as $misi)
                        <li>{{ $misi }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Program Unggulan</h3>
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach (explode("\n", $profilDesa->program_unggulan) as $program)
                        <li>{{ $program }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Batas Wilayah</h3>
                    <p class="text-gray-600">{{ $profilDesa->batas_wilayah }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Kontak</h3>
                    <p class="text-gray-600"><strong>Alamat:</strong> {{ $profilDesa->alamat }}</p>
                    <p class="text-gray-600"><strong>Telepon:</strong> {{ $profilDesa->kontak }}</p>
                </div>
                @endforeach

            </div>
        </div>

        {{-- PERANGKAT DESA --}}
        <div id="perangkat-desa" class="content-section hidden mt-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Perangkat Desa</h1>

            <div class="relative bg-gray-100 p-6 rounded-lg shadow-md">
                <!-- Wrapper untuk Scroll Horizontal di Mobile -->
                <div class="overflow-x-auto scroll-smooth scrollbar-hide p-2">
                    <div class="flex space-x-4 md:grid md:grid-cols-3 lg:grid-cols-4 md:gap-6">
                        @if (empty($perangkat))
                        <!-- Template Kosong dengan Style Tetap -->
                        <div class="min-w-[250px] md:w-full bg-white shadow-md rounded-xl overflow-hidden p-4">
                            <div class="bg-gray-200 rounded-lg flex items-center justify-center h-56">
                                <span class="text-gray-500">Foto</span>
                            </div>
                            <div class="p-4 text-center space-y-1">
                                <h3 class="text-lg font-bold text-gray-400 leading-tight">nama
                                </h3>
                                <p class="text-gray-400 text-sm leading-tight">jabatan</p>
                            </div>
                        </div>
                        <p class="text-gray-500 mt-4 text-center w-full">Belum ada data perangkat desa. Silakan
                            tambahkan melalui panel admin.</p>
                        @else
                        @foreach ($perangkat as $p)
                        <div class="min-w-[250px] md:w-full bg-white shadow-md rounded-xl overflow-hidden p-4">
                            <div class="bg-gray-100 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $p['foto']) }}" alt="{{ $p['nama'] }}" class="w-full h-56 object-cover">
                            </div>
                            <div class="p-4 text-center space-y-1">
                                <h3 class="text-lg font-bold text-gray-800 leading-tight">{{ $p['nama'] }}
                                </h3>
                                <p class="text-gray-600 text-sm leading-tight">{{ $p['jabatan'] }}</p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div id="keuangan" class="content-section hidden mt-6">
            <!-- Ringkasan Pendapatan dan Belanja -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Ringkasan Keuangan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pendapatan -->
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-800">Pendapatan</h3>
                        <p class="text-2xl font-bold text-green-800 mt-2">
                            Rp {{ number_format(array_sum(array_column($keuangan, 'pendapatan')), 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-600">Total pendapatan desa.</p>
                    </div>
                    <!-- Belanja -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-800">Belanja</h3>
                        <p class="text-2xl font-bold text-blue-800 mt-2">
                            Rp {{ number_format(array_sum(array_column($keuangan, 'belanja')), 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-600">Total belanja desa.</p>
                    </div>
                </div>
            </div>

            <!-- Rincian Pendapatan -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Rincian Pendapatan</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-left">Sumber Pendapatan</th>
                                <th class="py-2 px-4 border-b text-left">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($keuangan as $item)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $item['sumber_pendapatan'] ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b">
                                    {{ number_format($item['pendapatan'] ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-2 px-4 border-b text-center text-gray-500">Belum ada
                                    data pendapatan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rincian Pembelanjaan -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Rincian Pembelanjaan</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-left">Jenis Belanja</th>
                                <th class="py-2 px-4 border-b text-left">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($keuangan as $item)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $item['jenis_belanja'] ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b">
                                    {{ number_format($item['belanja'] ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-2 px-4 border-b text-center text-gray-500">Belum ada
                                    data belanja.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- BPD --}}
        <div id="bpd" class="content-section hidden mt-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Badan Permusyawaratan Desa (BPD)</h1>

            <div class="relative p-6 rounded-lg shadow-md border">
                <!-- Wrapper untuk Scroll Horizontal di Mobile -->
                <div class="overflow-x-auto scroll-smooth scrollbar-hide p-2">
                    <div class="flex space-x-4 md:grid md:grid-cols-3 lg:grid-cols-4 md:gap-6">
                        @if (empty($bpd))
                        <!-- Template Kosong dengan Style Tetap -->
                        <div class="min-w-[250px] md:w-full bg-white shadow-lg rounded-xl overflow-hidden p-4 border">
                            <div class="rounded-lg flex items-center justify-center h-56 border">
                                <span class="text-gray-500">Foto</span>
                            </div>
                            <div class="p-4 text-center space-y-1">
                                <h3 class="text-lg font-bold leading-tight">Nama</h3>
                                <p class="text-sm leading-tight">Jabatan</p>
                            </div>
                        </div>
                        <p class="mt-4 text-center w-full">Belum ada data BPD. Silakan tambahkan melalui panel
                            admin.</p>
                        @else
                        @foreach ($bpd as $b)
                        <div class="min-w-[250px] md:w-full bg-white shadow-lg rounded-xl overflow-hidden p-4 border">
                            <div class="rounded-lg overflow-hidden border">
                                <img src="{{ asset('images/' . $b['foto']) }}" alt="{{ $b['nama'] }}" class="w-full h-56 object-cover">
                            </div>
                            <div class="p-4 text-center space-y-1">
                                <h3 class="text-lg font-bold leading-tight">{{ $b['nama'] }}</h3>
                                <p class="text-sm leading-tight">{{ $b['jabatan'] }}</p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Kelembagaan Desa --}}
        <div id="kelembagaan" class="content-section hidden mt-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Kelembagaan Desa</h1>

            <!-- Tabel LPMD/LPMK -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">LPMD/LPMK</h2>
                <div class="overflow-x-auto">
                    @if(isset($lpmd) && count($lpmd) > 0)
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Data</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lpmd as $item)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $item['data'] }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $item['jumlah'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-600">Data LPMD/LPMK tidak tersedia.</p>
                    @endif
                </div>
            </div>

            <!-- Tabel TP PKK Desa -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">TP PKK Desa</h2>
                <div class="overflow-x-auto">
                    @if(isset($pkk) && count($pkk) > 0)
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Data</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pkk as $item)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $item['data'] }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $item['jumlah'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-600">Data TP PKK Desa tidak tersedia.</p>
                    @endif
                </div>
            </div>

            <!-- Tabel Bumdes -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Bumdes (Badan Usaha Milik Desa)</h2>
                <div class="overflow-x-auto">
                    @if(isset($bumdes) && count($bumdes) > 0)
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Data</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Jumlah</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bumdes as $item)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $item['data'] }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $item['jumlah'] }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <button class="open-modal bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition duration-300" data-modal-id="modal-kelembagaan">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-600">Data Bumdes tidak tersedia.</p>
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div id="modal-kelembagaan" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50 hidden">
                <div class="modal-content bg-white rounded-lg w-full max-w-md overflow-hidden shadow-xl transform transition-all">
                    <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                        <h3 class="text-xl font-semibold">Jumlah BumDes</h3>
                        <!-- Tombol untuk menutup modal -->
                        <button class="close-modal text-white hover:text-gray-200 text-2xl" data-modal-id="modal-kelembagaan">&times;</button>
                    </div>
                    <div class="p-6">
                        <!-- Konten modal -->
                        @if(isset($bumdesDetail) && count($bumdesDetail) > 0)
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Nama</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-600">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bumdesDetail as $item)
                                <tr>
                                    <td class="py-2 px-4 border border-gray-200 text-sm text-gray-700">{{ $item['nama'] }}</td>
                                    <td class="py-2 px-4 border border-gray-200 text-sm text-gray-700">{{ $item['deskripsi'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-600">Detail Bumdes tidak tersedia.</p>
                        @endif
                    </div>
                    <div class="bg-gray-50 px-6 py-4 flex justify-end">
                        <!-- Tombol untuk menutup modal -->
                        <button class="close-modal bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300" data-modal-id="modal-kelembagaan">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- INFRASTRUKTUR --}}
        <div id="infrastruktur" class="content-section hidden mt-6">
            <h1 class="text-3xl font-bold text-gray-800">Infrastruktur</h1>
            <p class="mt-4 text-gray-600">Informasi mengenai infrastruktur desa...</p>

            <!-- Tabel Infrastruktur -->
            <table class="mt-6 w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2 text-left">Kategori</th>
                        <th class="border border-gray-300 p-2 text-left">Nilai</th>
                        <th class="border border-gray-300 p-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($infrastruktur as $item)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $item['kategori'] }}</td>
                        <td class="border border-gray-300 p-2">
                            {{ empty($item['nilai']) ? 'Tidak ada data' : $item['nilai'] }}
                        </td>
                        <td class="border border-gray-300 p-2">
                            <button data-modal-id="modal-detail-{{ $item['id'] }}" class="open-modal bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Modal untuk Lihat Detail --}}
            @foreach($infrastruktur as $item)
            <div id="modal-detail-{{ $item['id'] }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50 hidden">
                <div class="modal-content bg-white rounded-lg w-full max-w-2xl overflow-hidden shadow-xl transform transition-all">
                    <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                        <h3 class="text-lg font-semibold">Detail {{ $item['kategori'] }}</h3>
                        <button data-modal-id="modal-detail-{{ $item['id'] }}" class="close-modal text-white hover:text-gray-200 text-2xl">&times;</button>
                    </div>
                    <div class="p-6">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    @foreach($item['columns'] as $column)
                                    <th class="border border-gray-300 p-2 text-left">{{ $column }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item['data'] as $data)
                                <tr>
                                    @foreach($data as $value)
                                    <td class="border border-gray-300 p-2">
                                        {{ $value ?? 'tidak ada data' }}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 flex justify-end">
                        <button data-modal-id="modal-detail-{{ $item['id'] }}" class="close-modal bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Tutup</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>



        {{-- transparansi --}}
        <div id="transparansi" class="content-section hidden p-6 bg-white rounded-lg shadow-md mt-6">
            Tabel Peraturan Desa
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Jumlah Peraturan Desa: {{ count($peraturanDesas) }}</h2>
                <table class="min-w-full bg-white border-2 border-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Judul Peraturan Desa</th>
                            <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Nomor Peraturan Desa</th>
                            <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peraturanDesas as $peraturan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 border-2 border-gray-200">{{ $peraturan->judul }}</td>
                            <td class="py-3 px-4 border-2 border-gray-200">{{ $peraturan->nomor }}</td>
                            <td class="py-3 px-4 border-2 border-gray-200">{{ $peraturan->tanggal->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-3 px-4 border-2 border-gray-200 text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Edaran Kepala Desa -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Jumlah Edaran Kepala Desa: {{ count($edaranKepalaDesas) }}</h2>
                <table class="min-w-full bg-white border-2 border-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Judul Edaran</th>
                            <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Nomor Edaran</th>
                            <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($edaranKepalaDesas as $edaran)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 border-2 border-gray-200">{{ $edaran->judul }}</td>
                            <td class="py-3 px-4 border-2 border-gray-200">{{ $edaran->nomor }}</td>
                            <td class="py-3 px-4 border-2 border-gray-200">{{ $edaran->tanggal->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-3 px-4 border-2 border-gray-200 text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Program yang Diterima -->
            <div>
                <h2 class="text-xl font-semibold mb-4">
                    Jumlah Program yang Diterima: {{ count($programPusat) + count($programProvinsi) + count($programKabupaten) }}
                </h2>

                <!-- Program Pusat -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Pemerintah Pusat: {{ $programPusat->count() }}</h3>
                    <table class="min-w-full bg-white border-2 border-gray-300 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Nama Program</th>
                                <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Anggaran (Ribu Rupiah)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($programPusat as $program)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 border-2 border-gray-200">{{ $program->nama }}</td>
                                <td class="py-3 px-4 border-2 border-gray-200">{{ number_format($program->anggaran, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-3 px-4 border-2 border-gray-200 text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Program Provinsi -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Pemerintah Provinsi: {{ $programProvinsi->count() }}</h3>
                    <table class="min-w-full bg-white border-2 border-gray-300 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Nama Program</th>
                                <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Anggaran (Ribu Rupiah)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($programProvinsi as $program)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 border-2 border-gray-200">{{ $program->nama }}</td>
                                <td class="py-3 px-4 border-2 border-gray-200">{{ number_format($program->anggaran, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-3 px-4 border-2 border-gray-200 text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Program Kabupaten -->
                <div>
                    <h3 class="text-lg font-semibold mb-2">Pemerintah Kabupaten: {{ $programKabupaten->count() }}</h3>
                    <table class="min-w-full bg-white border-2 border-gray-300 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Nama Program</th>
                                <th class="py-3 px-4 border-2 border-gray-300 text-left font-semibold text-gray-700">Anggaran (Ribu Rupiah)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($programKabupaten as $program)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 border-2 border-gray-200">{{ $program->nama }}</td>
                                <td class="py-3 px-4 border-2 border-gray-200">{{ number_format($program->anggaran, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-3 px-4 border-2 border-gray-200 text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- kemiskinan --}}
    <div id="program-tidak-mampu" class="content-section hidden">
        <p class="mt-4 text-gray-600">Informasi mengenai program untuk warga tidak mampu...</p>

        <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow-sm">
            <p class="text-lg text-gray-700">
                <span class="font-semibold">Jumlah Keluarga Penerima Program Penanggulangan Kemiskinan:</span>
                <span class="font-bold text-blue-600">{{ $totalPenerima }} keluarga</span>
            </p>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold text-gray-700">Detail Program Bantuan</h2>
            <table class="min-w-full mt-4 bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 border border-gray-300 text-left text-gray-700">Nama Program</th>
                        <th class="py-3 px-4 border border-gray-300 text-left text-gray-700">Jumlah Keluarga Penerima</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($programs) > 0)
                    <!-- Tampilkan data dari array jika ada -->
                    @foreach($programs as $program)
                    <tr>
                        <td class="py-3 px-4 border border-gray-300">{{ $program['nama_program'] }}</td>
                        <td class="py-3 px-4 border border-gray-300">{{ $program['jumlah_keluarga'] }}</td>
                    </tr>
                    @endforeach
                    @else
                    <!-- Tampilkan pesan jika tidak ada data -->
                    <tr>
                        <td colspan="2" class="py-3 px-4 border border-gray-300 text-center text-gray-500">
                            Tidak ada data program bantuan.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    // Fungsi untuk membuka modal
    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);

            // Tampilkan modal
            modal.classList.remove('hidden');

            // Atur posisi modal di tengah layar
            const modalContent = modal.querySelector('.modal-content');
            modalContent.style.position = 'fixed';
            modalContent.style.top = '50%';
            modalContent.style.left = '50%';
            modalContent.style.transform = 'translate(-50%, -50%)';
        });
    });

    // Fungsi untuk menutup modal
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            document.getElementById(modalId).classList.add('hidden');
        });
    });
    // function openModal(modalId, title, content) {
    //     const modal = document.getElementById(modalId);
    //     const modalContent = modal.querySelector('#modal-content');

    //     // Set judul dan konten modal
    //     // modal.querySelector('h3').textContent = title;
    //     // modalContent.innerHTML = <p class="text-gray-700">${content}</p>;

    //     // Tampilkan modal
    //     modal.classList.remove('hidden');
    //     modal.classList.add('flex');
    // }

    // function closeModal(modalId) {
    //     const modal = document.getElementById(modalId);
    //     modal.classList.remove('flex');
    //     modal.classList.add('hidden');
    // }


    document.addEventListener("DOMContentLoaded", function() {
        const scrollContainer = document.getElementById("scrollContainer");

        scrollContainer.addEventListener("wheel", function(event) {
            event.preventDefault();
            scrollContainer.scrollLeft += event.deltaY;
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".nav-button");
        const sections = document.querySelectorAll(".content-section");

        buttons.forEach(button => {
            button.addEventListener("click", function() {
                const target = this.getAttribute("data-target");

                sections.forEach(section => {
                    section.classList.add("hidden");
                });

                document.getElementById(target).classList.remove("hidden");
            });
        });

        // Tampilkan konten desa jika ada parameter di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('kecamatan') || urlParams.has('desa')) {
            document.getElementById('desa-content').classList.remove('hidden');
        }
    });

    document.getElementById("filterForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah form mengirim request ke server langsung

        // Ambil nilai dari dropdown
        const kecamatan = document.getElementById("kecamatan").value;
        const desa = document.getElementById("desa").value;

        // Bangun query parameter
        let params = new URLSearchParams();
        if (kecamatan) params.append("kecamatan", kecamatan);
        if (desa) params.append("desa", desa);

        // Redirect ke URL dengan query parameter tanpa berpindah route
        window.location.href = "/profil-desa?" + params.toString();
    });
</script>
@endsection