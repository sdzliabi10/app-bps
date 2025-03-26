@extends('admin.layouts.master')

@section('title', 'Edit Profil Desa')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Edit Profil Desa</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profil-desa.update', $profilDesa->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Include the PUT method for update -->

                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="filterDesaEdit()"
                                required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->kdkec }}"
                                        {{ $kecamatan->kdkec == $profilDesa->desa->kdkec ? 'selected' : '' }}>
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
                                    <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}"
                                        {{ old('kddesa', $profilDesa->kddesa) == $desa->iddesa ? 'selected' : '' }}>
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                            @if ($profilDesa->foto)
                                <img src="{{ Storage::url($profilDesa->foto) }}" alt="Profil Desa" class="mt-2"
                                    width="150">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea class="form-control" name="visi" id="visi" required>{{ old('visi', $profilDesa->visi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea class="form-control" name="misi" id="misi" required>{{ old('misi', $profilDesa->misi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="program_unggulan" class="form-label">Program Unggulan</label>
                            <textarea class="form-control" name="program_unggulan" id="program_unggulan" required>{{ old('program_unggulan', $profilDesa->program_unggulan) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="batas_wilayah" class="form-label">Batas Wilayah</label>
                            <textarea class="form-control" name="batas_wilayah" id="batas_wilayah" required>{{ old('batas_wilayah', $profilDesa->batas_wilayah) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat"
                                value="{{ old('alamat', $profilDesa->alamat) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="kontak" id="telepon"
                                value="{{ old('kontak', $profilDesa->kontak) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        // JavaScript for filtering desa based on kecamatan
        function filterDesaEdit() {
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

            // Make sure to reset the "selected" property for Desa dropdown on filter
            var desaSelect = document.getElementById('desa');
            if (!Array.from(desaSelect.options).some(option => option.selected)) {
                desaSelect.selectedIndex = 0; // Default to the first option if nothing is selected
            }
        }

        // Trigger the filterDesaEdit function on page load to pre-populate the desa dropdown
        window.onload = function() {
            filterDesaEdit(); // Make sure the filtering happens when the page loads
        };

        // Trigger the filterDesaEdit function when the kecamatan dropdown is changed
        document.getElementById('kecamatan').addEventListener('change', function() {
            filterDesaEdit(); // Reapply the filtering whenever the kecamatan changes
        });
    </script>


@endsection
