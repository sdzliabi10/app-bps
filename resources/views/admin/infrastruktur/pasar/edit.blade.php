

@extends('admin.layouts.master')

@section('title', 'Edit Data Pasar')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Edit Data Pasar</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pasar.update', $pasar->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="filterDesaEdit()" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->kdkec }}"
                                        {{ $pasar->desa->kdkec == $kecamatan->kdkec ? 'selected' : '' }}>
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
                                        {{ old('iddesa', $pasar->iddesa) == $desa->iddesa ? 'selected' : '' }}>
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_pasar" class="form-label">Nama Pasar</label>
                            <input type="text" class="form-control" name="nama_pasar" id="nama_pasar" 
                                value="{{ old('nama_pasar', $pasar->nama_pasar) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="panjang" class="form-label">Panjang (meter)</label>
                            <input type="text" class="form-control decimal-input" name="panjang" id="panjang" 
                                value="{{ old('panjang', str_replace('.', ',', $pasar->panjang)) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="lebar" class="form-label">Lebar (meter)</label>
                            <input type="text" class="form-control decimal-input" name="lebar" id="lebar" 
                                value="{{ old('lebar', str_replace('.', ',', $pasar->lebar)) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-control" name="kondisi" id="kondisi" required>
                                <option value="">Pilih Kondisi</option>
                                <option value="Baik" {{ old('kondisi', $pasar->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('kondisi', $pasar->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ old('kondisi', $pasar->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <textarea class="form-control" name="lokasi" id="lokasi" required>{{ old('lokasi', $pasar->lokasi) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
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

        window.onload = function() {
            filterDesaEdit();
        };
    </script>
@endsection
