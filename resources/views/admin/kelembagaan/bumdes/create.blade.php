@extends('admin.layouts.master')

@section('title', 'Tambah BUMDES')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah BUMDES</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bumdes.store') }}">
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
                                    <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}" style="display: none;">
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama BUMDES</label>
                            <input type="text" class="form-control" name="nama" id="nama" 
                                value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" 
                                rows="3" required>{{ old('deskripsi') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function filterDesa() {
                var kecamatanId = document.getElementById('kecamatan').value;
                var desaDropdown = document.getElementById('desa');
                var desaOptions = desaDropdown.getElementsByTagName('option');

                for (var i = 0; i < desaOptions.length; i++) {
                    var option = desaOptions[i];
                    if (option.value === "") {
                        option.style.display = "block"; // Selalu tampilkan opsi "Pilih Desa"
                        continue;
                    }
                    if (option.getAttribute('data-kecamatan') === kecamatanId) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    }
                }
                // Reset pilihan desa
                desaDropdown.value = "";
            }

            // Panggil filterDesa saat halaman dimuat jika ada kecamatan yang sudah dipilih
            window.onload = function() {
                var selectedKecamatan = document.getElementById('kecamatan').value;
                if (selectedKecamatan) {
                    filterDesa();
                }
            }
        </script>
    </main>
@endsection
