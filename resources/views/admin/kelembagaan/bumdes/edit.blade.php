@extends('admin.layouts.master')

@section('title', 'Edit BUMDES')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Edit BUMDES</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bumdes.update', $bumdes->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="filterDesa()" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->kdkec }}"
                                        {{ $bumdes->desa->kdkec == $kecamatan->kdkec ? 'selected' : '' }}>
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
                                    <option value="{{ $desa->iddesa }}" 
                                        data-kecamatan="{{ $desa->kdkec }}"
                                        {{ $bumdes->iddesa == $desa->iddesa ? 'selected' : '' }}
                                        style="display: none;">
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama BUMDES</label>
                            <input type="text" class="form-control" name="nama" id="nama" 
                                value="{{ old('nama', $bumdes->nama) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" 
                                rows="3" required>{{ old('deskripsi', $bumdes->deskripsi) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

                // Jika desa yang dipilih saat ini tidak termasuk dalam kecamatan yang baru dipilih
                var selectedOption = desaDropdown.options[desaDropdown.selectedIndex];
                if (selectedOption.style.display === "none") {
                    desaDropdown.value = ""; // Reset pilihan desa
                }
            }

            // Panggil filterDesa saat halaman dimuat untuk menampilkan desa yang sesuai
            window.onload = function() {
                var selectedKecamatan = document.getElementById('kecamatan').value;
                if (selectedKecamatan) {
                    filterDesa();
                }
            }
        </script>
    </main>
@endsection
