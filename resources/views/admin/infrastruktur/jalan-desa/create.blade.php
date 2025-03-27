

@extends('admin.layouts.master')

@section('title', 'Tambah Data Jalan Desa')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah Data Jalan Desa</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('jalan-desa.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="filterDesa()" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->kdkec }}"
                                        {{ old('kecamatan') == $kecamatan->kdkec ? 'selected' : '' }}>
                                        {{ $kecamatan->nmkec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-control" name="iddesa" id="desa" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}"
                                        {{ old('iddesa') == $desa->iddesa ? 'selected' : '' }} style="display: none;">
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_jalan" class="form-label">Nama Jalan</label>
                            <input type="text" class="form-control" name="nama_jalan" id="nama_jalan" 
                                value="{{ old('nama_jalan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="panjang" class="form-label">Panjang (km)</label>
                            <input type="text" class="form-control decimal-input" name="panjang" id="panjang" 
                                value="{{ old('panjang') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="lebar" class="form-label">Lebar (m)</label>
                            <input type="text" class="form-control decimal-input" name="lebar" id="lebar" 
                                value="{{ old('lebar') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-control" name="kondisi" id="kondisi" required>
                                <option value="">Pilih Kondisi</option>
                                <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Jalan</label>
                            <select class="form-control" name="jenis" id="jenis" required>
                                <option value="">Pilih Jenis Jalan</option>
                                <option value="Aspal" {{ old('jenis') == 'Aspal' ? 'selected' : '' }}>Aspal</option>
                                <option value="Beton" {{ old('jenis') == 'Beton' ? 'selected' : '' }}>Beton</option>
                                <option value="Makadam" {{ old('jenis') == 'Makadam' ? 'selected' : '' }}>Makadam</option>
                                <option value="Tanah" {{ old('jenis') == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <textarea class="form-control" name="lokasi" id="lokasi" required>{{ old('lokasi') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        function filterDesa() {
            var kecamatan = document.getElementById('kecamatan').value;
            var desaOptions = document.querySelectorAll('#desa option');

            desaOptions.forEach(function(option) {
                if (option.getAttribute('data-kecamatan') === kecamatan || option.value === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });

            document.getElementById('desa').value = '';
        }

        function formatDecimal(input) {
            let value = input.value.replace(/[^\d,]/g, '');
            let parts = value.split(',');
            if (parts.length > 2) {
                parts = [parts[0], parts.slice(1).join('')];
                value = parts.join(',');
            }
            if (parts.length === 2 && parts[1].length > 2) {
                value = parts[0] + ',' + parts[1].substring(0, 2);
            }
            input.value = value;
        }

        document.querySelectorAll('.decimal-input').forEach(function(input) {
            input.addEventListener('input', function() {
                formatDecimal(this);
            });
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            document.querySelectorAll('.decimal-input').forEach(function(input) {
                input.value = input.value.replace(',', '.');
            });
        });
    </script>
@endsection


