@extends('admin.layouts.master')

@section('title', 'Tambah Profil Desa')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah Profil Desa</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profil-desa.store') }}">
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
                            <select class="form-control" name="kddesa" id="desa" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}" style="display: none;">
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="visi_misi" class="form-label">Visi</label>
                            <textarea class="form-control" name="visi" id="visi_misi" required>{{ old('visi') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea class="form-control" name="misi" id="visi_misi" required>{{ old('misi') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="program_unggulan" class="form-label">Program Unggulan</label>
                            <textarea class="form-control" name="program_unggulan" id="program_unggulan" required>{{ old('program_unggulan') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="batas_wilayah" class="form-label">Batas Wilayah</label>
                            <textarea class="form-control" name="batas_wilayah" id="batas_wilayah" required>{{ old('batas_wilayah') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="kontak" id="telepon" value="{{ old('kontak') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    {{-- <script>
        // JavaScript for filtering desa based on kecamatan
        function filterDesa() {
            var kecamatan = document.getElementById('kecamatan').value;
            var desaOptions = document.querySelectorAll('#desa option');

            // Show only the desa that belongs to the selected kecamatan
            desaOptions.forEach(function(option) {
                if (option.getAttribute('data-kecamatan') === kecamatan || kecamatan === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }
    </script> --}}

@endsection
