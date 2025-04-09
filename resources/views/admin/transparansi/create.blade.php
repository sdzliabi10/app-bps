@extends('admin.layouts.master')

@section('title', 'Tambah Data Transparansi')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah Data Transparansi</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('transparansi.store') }}" enctype="multipart/form-data">
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
                                        style="display: none;">
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Data</label>
                            <select class="form-control @error('jenis') is-invalid @enderror" name="jenis" id="jenis"
                                required>
                                <option value="">Pilih Jenis Data</option>
                                <option value="peraturan" {{ old('jenis') == 'peraturan' ? 'selected' : '' }}>Peraturan Desa
                                </option>
                                <option value="edaran" {{ old('jenis') == 'edaran' ? 'selected' : '' }}>Edaran Kepala Desa
                                </option>
                                <option value="program" {{ old('jenis') == 'program' ? 'selected' : '' }}>Program</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fields for Peraturan & Edaran -->
                        <div id="peraturanEdaranFields" style="display: none;">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" id="judul" value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nomor" class="form-label">Nomor</label>
                                <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                    name="nomor" id="nomor" value="{{ old('nomor') }}">
                                @error('nomor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Fields for Program -->
                        <div id="programFields" style="display: none;">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Program</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sumber" class="form-label">Sumber Dana</label>
                                <select class="form-control @error('sumber') is-invalid @enderror" name="sumber"
                                    id="sumber">
                                    <option value="">Pilih Sumber Dana</option>
                                    <option value="pusat" {{ old('sumber') == 'pusat' ? 'selected' : '' }}>Pemerintah
                                        Pusat</option>
                                    <option value="provinsi" {{ old('sumber') == 'provinsi' ? 'selected' : '' }}>Pemerintah
                                        Provinsi</option>
                                    <option value="kabupaten" {{ old('sumber') == 'kabupaten' ? 'selected' : '' }}>
                                        Pemerintah Kabupaten</option>
                                </select>
                                @error('sumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="anggaran" class="form-label">Anggaran</label>
                                <input type="number" class="form-control @error('anggaran') is-invalid @enderror"
                                    name="anggaran" id="anggaran" value="{{ old('anggaran') }}">
                                @error('anggaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File Dokumen</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                                id="file" required>
                            <small class="text-muted">Upload file PDF atau Word (Maksimal 10MB)</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('transparansi.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        function toggleFields() {
            const jenis = document.getElementById('jenis').value;
            const peraturanEdaranFields = document.getElementById('peraturanEdaranFields');
            const programFields = document.getElementById('programFields');

            if (jenis === 'peraturan' || jenis === 'edaran') {
                peraturanEdaranFields.style.display = 'block';
                programFields.style.display = 'none';

                // Set required attributes
                document.getElementById('judul').required = true;
                document.getElementById('nomor').required = true;
                document.getElementById('tanggal').required = true;
                document.getElementById('nama').required = false;
                document.getElementById('sumber').required = false;
                document.getElementById('anggaran').required = false;
            } else if (jenis === 'program') {
                peraturanEdaranFields.style.display = 'none';
                programFields.style.display = 'block';

                // Set required attributes
                document.getElementById('judul').required = false;
                document.getElementById('nomor').required = false;
                document.getElementById('tanggal').required = false;
                document.getElementById('nama').required = true;
                document.getElementById('sumber').required = true;
                document.getElementById('anggaran').required = true;
            } else {
                peraturanEdaranFields.style.display = 'none';
                programFields.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize fields based on old input if exists
            toggleFields();

            // Add event listener for jenis change
            document.getElementById('jenis').addEventListener('change', toggleFields);
        });
    </script>
@endsection

@push('scripts')
@endpush
