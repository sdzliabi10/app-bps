@extends('admin.layouts.master')

@section('title', 'Edit Data Transparansi')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Edit Data Transparansi</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('transparansi.update', $transparansi->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="filterDesa()" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->kdkec }}"
                                        {{ $transparansi->desa->kdkec == $kecamatan->kdkec ? 'selected' : '' }}>
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
                                        {{ $transparansi->iddesa == $desa->iddesa ? 'selected' : '' }}>
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Data</label>
                            <select class="form-control" name="jenis" id="jenis" required onchange="toggleFields()">
                                <option value="">Pilih Jenis Data</option>
                                <option value="peraturan" {{ $transparansi->jenis == 'peraturan' ? 'selected' : '' }}>Peraturan Desa</option>
                                <option value="edaran" {{ $transparansi->jenis == 'edaran' ? 'selected' : '' }}>Edaran Kepala Desa</option>
                                <option value="program" {{ $transparansi->jenis == 'program' ? 'selected' : '' }}>Program</option>
                            </select>
                        </div>

                        <!-- Fields for Peraturan & Edaran -->
                        <div id="peraturanEdaranFields" style="display: none;">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" id="judul" value="{{ $transparansi->judul }}">
                            </div>

                            <div class="mb-3">
                                <label for="nomor" class="form-label">Nomor</label>
                                <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $transparansi->nomor }}">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" 
                                    value="{{ $transparansi->tanggal ? $transparansi->tanggal->format('Y-m-d') : '' }}">
                            </div>
                        </div>

                        <!-- Fields for Program -->
                        <div id="programFields" style="display: none;">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Program</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="{{ $transparansi->nama }}">
                            </div>

                            <div class="mb-3">
                                <label for="sumber" class="form-label">Sumber Dana</label>
                                <select class="form-control" name="sumber" id="sumber">
                                    <option value="">Pilih Sumber Dana</option>
                                    <option value="pusat" {{ $transparansi->sumber == 'pusat' ? 'selected' : '' }}>Pemerintah Pusat</option>
                                    <option value="provinsi" {{ $transparansi->sumber == 'provinsi' ? 'selected' : '' }}>Pemerintah Provinsi</option>
                                    <option value="kabupaten" {{ $transparansi->sumber == 'kabupaten' ? 'selected' : '' }}>Pemerintah Kabupaten</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        function filterDesa() {
            const kecamatan = document.getElementById('kecamatan').value;
            const desaOptions = document.querySelectorAll('#desa option');

            desaOptions.forEach(option => {
                if (option.value === '') return; // Skip placeholder option
                const desaKecamatan = option.getAttribute('data-kecamatan');
                option.style.display = desaKecamatan === kecamatan ? '' : 'none';
            });

            // Reset desa selection
            document.getElementById('desa').value = '';
        }

        function toggleFields() {
            const jenis = document.getElementById('jenis').value;
            const peraturanEdaranFields = document.getElementById('peraturanEdaranFields');
            const programFields = document.getElementById('programFields');

            if (jenis === 'peraturan' || jenis === 'edaran') {
                peraturanEdaranFields.style.display = 'block';
                programFields.style.display = 'none';
            } else if (jenis === 'program') {
                peraturanEdaranFields.style.display = 'none';
                programFields.style.display = 'block';
            } else {
                peraturanEdaranFields.style.display = 'none';
                programFields.style.display = 'none';
            }
        }

        // Initialize fields on page load
        document.addEventListener('DOMContentLoaded', function() {
            filterDesa();
            toggleFields();
        });
    </script>
@endsection