@extends('admin.layouts.master')

@section('title', 'Tambah Data Pusat Perdagangan')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah Data Pusat Perdagangan</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pusat-perdagangan.store') }}" enctype="multipart/form-data">
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
                            <label for="nama_pusat_perdagangan" class="form-label">Nama Pusat Perdagangan</label>
                            <input type="text" class="form-control" name="nama_pusat_perdagangan" id="nama_pusat_perdagangan"
                                value="{{ old('nama_pusat_perdagangan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="panjang" class="form-label">Panjang (meter)</label>
                            <input type="number" class="form-control decimal-input" name="panjang" id="panjang"
                                value="{{ old('panjang') }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="lebar" class="form-label">Lebar (meter)</label>
                            <input type="number" class="form-control decimal-input" name="lebar" id="lebar"
                                value="{{ old('lebar') }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-control" name="kondisi" id="kondisi" required>
                                <option value="">Pilih Kondisi</option>
                                <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Sedang" {{ old('kondisi') == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
                                <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
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
        document.querySelectorAll('.decimal-input').forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\./g, '$1').replace(/,/g, '.');
            });
        });
    </script>
@endsection
