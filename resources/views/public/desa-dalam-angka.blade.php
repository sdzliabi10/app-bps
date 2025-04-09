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
    @php
    // Data umum yang akan digunakan di semua view
    $dataView = [
    'desaName' => ucfirst(strtolower($selectedDesa->nmdesa ?? '')),
    'kecamatanName' => ucfirst(strtolower($selectedKecamatan->nmkec ?? '')),
    'tahun' => request('tahun')
];

    // Pemetaan view untuk data desa
    $petaViewDesa = [
    '1' => 'public.desa angka.desa.Rumah-Warga',
    '2' => 'public.desa angka.desa.kesehatan.sarana-prasarana',
    '3' => 'public.desa angka.desa.kesehatan.sarana-pendukung-kesehatan',
    '4' => 'public.desa angka.desa.kesehatan.sarana-disabilitas',
    '5' => 'public.desa angka.desa.pendidikan.sarana-pendidikan',
    '6' => 'public.desa angka.desa.ibadah.sarana-ibadah',
    '7' => 'public.desa angka.desa.Olahraga.sarana-olahraga',
    '8' => 'public.desa angka.desa.Sarana.sarana-lainnya',
    '9' => 'public.desa angka.desa.Kelembagaan.sarana-kelembagaan',
    '10' => 'public.desa angka.desa.Lingkungan.sarana-pendukung-lingkungan',
    '11' => 'public.desa angka.desa.Lingkungan.Energi.sarana-energi',
    '12' => 'public.desa angka.desa.Lingkungan.sarana-kondisi-keluarga',
    '13' => 'public.desa angka.desa.Lingkungan.sarana-Industri-penghasil-limbah',
    '14' => 'public.desa angka.desa.Lingkungan.SDA.sarana-sda',
    '15' => 'public.desa angka.desa.Kebudayaan.sarana-senibudaya',
    '17' => 'public.desa angka.desa.Kebudayaan.sarana-produk-unggulan',
    '18' => 'public.desa angka.desa.Ekonomi.sarana-ekonomi',
    '19' => 'public.desa angka.desa.Ekonomi.sarana-usaha',
    '20' => 'public.desa angka.desa.Transportasi.sarana-transportasi',
    '21' => 'public.desa angka.desa.KerawananSosial.sarana-kerawanan-sosial'
    ];

    // Pemetaan view untuk data kecamatan
    $petaViewKecamatan = [
    '1' => 'public.desa angka.kecamatan.tempat-tinggal',
    '2' => 'public.desa angka.kecamatan.sarana-prasarana',
    '3' => 'public.desa angka.kecamatan.sarana-pendukung-kesehatan',
    '4' => 'public.desa angka.kecamatan.disabilitas',
    '5' => 'public.desa angka.kecamatan.pendidikan',
    '6' => 'public.desa angka.kecamatan.sarana-ibadah',
    '7' => 'public.desa angka.kecamatan.olahraga',
    '8' => 'public.desa angka.kecamatan.Saranadll',
    '9' => 'public.desa angka.kecamatan.Kelembagaan',
    '10' => 'public.desa angka.kecamatan.SaranaPendukungdll',
    '11' => 'public.desa angka.kecamatan.Energi',
    '12' => 'public.desa angka.kecamatan.KondisiLingKeluarga',
    '13' => 'public.desa angka.kecamatan.IndustriLimbah',
    '14' => 'public.desa angka.kecamatan.Sda',
    '15' => 'public.desa angka.kecamatan.SeniBudaya',
    '17' => 'public.desa angka.kecamatan.ProdukUnggulan',
    '18' => 'public.desa angka.kecamatan.Ekonomi',
    '19' => 'public.desa angka.kecamatan.Usaha',
    '20' => 'public.desa angka.kecamatan.Transportasi',
    '21' => 'public.desa angka.kecamatan.KerawananSosial'
    ];
    @endphp

    <div id="tabelHasil" class="mt-6">
        @if(request('desa'))
        {{-- Tampilkan view desa jika ada di pemetaan --}}
        @if(isset($petaViewDesa[request('data')]))
        @include($petaViewDesa[request('data')], $dataView)
        @endif
        @else
        {{-- Tampilkan view kecamatan jika ada di pemetaan --}}
        @if(isset($petaViewKecamatan[request('data')]))
        @include($petaViewKecamatan[request('data')], [
        'kecamatanName' => ucfirst(strtolower($selectedKecamatan->nmkec ?? '')),
        'tahun' => request('tahun')
        ])
        @endif
        @endif
    </div>
    @endif

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk filter data berdasarkan kategori
        function filterData() {
            const kategoriSelect = document.getElementById('kategori');
            const dataSelect = document.getElementById('data');

            // Reset dan disable data select jika kategori kosong
            if (!kategoriSelect.value) {
                dataSelect.innerHTML = '<option value="">Pilih Data</option>';
                dataSelect.disabled = true;
                return;
            }

            // Aktifkan data select
            dataSelect.disabled = false;

            // Sembunyikan semua opsi data terlebih dahulu
            const dataOptions = dataSelect.querySelectorAll('option');
            dataOptions.forEach(option => {
                option.style.display = 'none';
            });

            // Tampilkan hanya data yang sesuai dengan kategori yang dipilih
            const selectedKategori = kategoriSelect.value;
            dataOptions.forEach(option => {
                if (option.value === '' || option.getAttribute('data-kategori') === selectedKategori) {
                    option.style.display = 'block';
                }
            });

            // Reset value data select
            dataSelect.value = '';
        }

        // Fungsi untuk filter desa berdasarkan kecamatan
        function filterDesa() {
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa');

            // Reset dan disable desa select jika kecamatan kosong
            if (!kecamatanSelect.value) {
                desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                desaSelect.disabled = true;
                return;
            }

            // Aktifkan desa select
            desaSelect.disabled = false;

            // Sembunyikan semua opsi desa terlebih dahulu
            const desaOptions = desaSelect.querySelectorAll('option');
            desaOptions.forEach(option => {
                option.style.display = 'none';
            });

            // Tampilkan hanya desa yang sesuai dengan kecamatan yang dipilih
            const selectedKecamatan = kecamatanSelect.value;
            desaOptions.forEach(option => {
                if (option.value === '' || option.getAttribute('data-kecamatan') === selectedKecamatan) {
                    option.style.display = 'block';
                }
            });

            // Reset value desa select
            desaSelect.value = '';
        }

        // Panggil fungsi filter saat halaman dimuat jika ada parameter di URL
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('kategori')) {
            filterData();
        }

        if (urlParams.has('kecamatan')) {
            filterDesa();
        }

        // Jika ada parameter data di URL, pastikan select data diaktifkan
        if (urlParams.has('data')) {
            document.getElementById('data').disabled = false;
        }

        // Jika ada parameter desa di URL, pastikan select desa diaktifkan
        if (urlParams.has('desa')) {
            document.getElementById('desa').disabled = false;
        }

        // Event listener untuk perubahan kategori
        document.getElementById('kategori').addEventListener('change', filterData);

        // Event listener untuk perubahan kecamatan
        document.getElementById('kecamatan').addEventListener('change', filterDesa);
    });
</script>
@endsection