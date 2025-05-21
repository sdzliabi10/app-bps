@extends('public.layouts.app')

@section('title', 'Desa Dalam Peta')


@section('content')
<div class="bg-white rounded-2xl shadow-xl p-6 mt-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A2 2 0 013 15.382V6a2 2 0 012-2h1m10 0h1a2 2 0 012 2v9.382a2 2 0 01-1.553 1.894L15 20m-6 0v-4a2 2 0 012-2h2a2 2 0 012 2v4" />
        </svg>
        Desa Dalam Peta
    </h2>

    <form id="filterForm" class="mt-6 flex flex-wrap items-end gap-4" action="{{ route('desa-dalam-peta') }}" method="GET">
        <!-- Kecamatan -->
        <select id="kecamatan" name="kecamatan" class="border border-gray-300 rounded-xl px-4 py-2 text-sm text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
            <option value="" disabled {{ request('kecamatan') ? '' : 'selected' }}>
                Pilih Kecamatan
            </option>
            @foreach ($kecamatanList as $kecamatan)
            <option value="{{ $kecamatan->kdkec }}" {{ request('kecamatan') == $kecamatan->kdkec ? 'selected' : '' }}>
                {{ $kecamatan->nmkec }}
            </option>
            @endforeach
        </select>

        <!-- Dari Desa -->
        <select id="desa" name="desa" class="border border-gray-300 rounded-xl px-4 py-2 text-sm text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm" disabled>
            <option value="">Pilih Desa</option>
            @foreach ($desaList as $desa)
            <option value="{{ $desa->iddesa }}"
                data-kecamatan="{{ $desa->kdkec }}"
                {{ request('desa') == $desa->iddesa ? 'selected' : '' }}>
                {{ $desa->nmdesa }}
            </option>
            @endforeach
        </select>




        <!-- Kategori -->
        <select id="kategori" name="kategori" class="border border-gray-300 rounded-xl px-4 py-2 text-sm text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
            <option value="" selected disabled>Pilih Kategori</option>
            @foreach ($kategoriPetaList as $kategori)
            <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama }}
            </option>
            @endforeach
        </select>

        <!-- Tombol -->
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl shadow font-semibold text-sm transition-all duration-200">
            Tampilkan Data
        </button>
    </form>

    <!-- Peta -->
    @if(request('kecamatan') && request('kategori'))
    <div class="relative w-full h-[600px] rounded-xl overflow-hidden border border-gray-200 shadow-inner mt-5">
        @if($viewPeta)
        @include($viewPeta)
        @endif
    </div>
    @else
    <div class="mt-6 text-gray-500 text-sm italic">
        Silakan pilih Kecamatan, Desa dan Kategori terlebih dahulu untuk menampilkan peta.
    </div>
    @endif



    <!-- Hapus load Leaflet disini karena sudah diload di masing-masing view -->
    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa');
            const kategoriSelect = document.getElementById('kategori');
            const allDesaOptions = Array.from(desaSelect.options);

            function filterDesaOptions(kdkec, keepSelected = true) {
                const currentSelectedDesa = desaSelect.value; 

                desaSelect.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Pilih Desa';
                desaSelect.appendChild(defaultOption);

                allDesaOptions.forEach(option => {
                    if (option.dataset.kecamatan === kdkec) {
                        const clonedOption = option.cloneNode(true);
                        if (keepSelected && clonedOption.value === currentSelectedDesa) {
                            clonedOption.selected = true;
                        }
                        desaSelect.appendChild(clonedOption);
                    }
                });

                desaSelect.disabled = false;
            }

            function toggleDesaSelectVisibility(kategori) {
                if (["1", "2", "3", "4", "5", "7"].includes(kategori)) {
                    desaSelect.style.display = 'none';
                    desaSelect.disabled = true;
                } else {
                    desaSelect.style.display = 'inline-block';
                    desaSelect.disabled = false;
                }
            }

            // Event kategori
            kategoriSelect.addEventListener('change', function() {
                const kdkec = kecamatanSelect.value;
                toggleDesaSelectVisibility(this.value);

                if (kdkec && !["1", "2", "3", "4", "5", "7"].includes(this.value)) {
                    filterDesaOptions(kdkec, true); 
                } else {
                    desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                }
            });

            // Event kecamatan
            kecamatanSelect.addEventListener('change', function() {
                const kdkec = this.value;
                const kategori = kategoriSelect.value;

                if (kdkec && !["1", "2", "3", "4", "5", "7"].includes(kategori)) {
                    filterDesaOptions(kdkec, false); 
                } else {
                    desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                    desaSelect.disabled = true;
                    desaSelect.style.display = 'none';
                }
            });

            // INIT
            const selectedKecamatan = kecamatanSelect.value;
            const selectedKategori = kategoriSelect.value;

            if (selectedKecamatan) {
                if (!["1", "2", "3", "4", "5", "7"].includes(selectedKategori)) {
                    filterDesaOptions(selectedKecamatan, true);
                }
            }
            toggleDesaSelectVisibility(selectedKategori);
        });
    </script>