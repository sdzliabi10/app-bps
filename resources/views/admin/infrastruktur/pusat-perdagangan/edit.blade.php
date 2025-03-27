@extends('admin.layouts.master')

@section('title', 'Edit Data Pusat Perdagangan')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Edit Data Pusat Perdagangan</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pusat-perdagangan.update', $pusatPerdagangan->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="filterDesaEdit()" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->kdkec }}"
                                        {{ $pusatPerdagangan->desa->kdkec == $kecamatan->kdkec ? 'selected' : '' }}>
                                        {{ $kecamatan->nmkec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="iddesa" class="form-label">Desa</label>
                            <select class="form-control" name="iddesa" id="iddesa" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}"
                                        {{ $pusatPerdagangan->iddesa == $desa->iddesa ? 'selected' : '' }}>
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_pusat_perdagangan" class="form-label">Nama Pusat Perdagangan</label>
                            <input type="text" class="form-control" name="nama_pusat_perdagangan" id="nama_pusat_perdagangan"
                                value="{{ old('nama_pusat_perdagangan', $pusatPerdagangan->nama_pusat_perdagangan) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="panjang" class="form-label">Panjang (meter)</label>
                            <input type="number" class="form-control decimal-input" name="panjang" id="panjang"
                                value="{{ old('panjang', $pusatPerdagangan->panjang) }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="lebar" class="form-label">Lebar (meter)</label>
                            <input type="number" class="form-control decimal-input" name="lebar" id="lebar"
                                value="{{ old('lebar', $pusatPerdagangan->lebar) }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-control" name="kondisi" id="kondisi" required>
                                <option value="">Pilih Kondisi</option>
                                <option value="Baik" {{ $pusatPerdagangan->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ $pusatPerdagangan->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ $pusatPerdagangan->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <textarea class="form-control" name="lokasi" id="lokasi" required>{{ old('lokasi', $jembatan->lokasi) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function filterDesaEdit() {
            var kecamatan = document.getElementById('kecamatan').value;
            var desaOptions = document.querySelectorAll('#desa option');

            desaOptions.forEach(function(option) {
                if (option.getAttribute('data-kecamatan') === kecamatan || option.value === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        // Trigger the filterDesaEdit function when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            filterDesaEdit();
        });
    </script>
@endsection


