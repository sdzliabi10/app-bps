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
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="desa" class="form-label">Desa</label>
                        <input type="text" class="form-control" name="desa" id="desa" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="tahun" required>
                    </div>
                    <div class="mb-3">
                        <label for="visi_misi" class="form-label">Visi & Misi</label>
                        <textarea class="form-control" name="visi_misi" id="visi_misi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="program_unggulan" class="form-label">Program Unggulan</label>
                        <textarea class="form-control" name="program_unggulan" id="program_unggulan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="batas_wilayah" class="form-label">Batas Wilayah</label>
                        <textarea class="form-control" name="batas_wilayah" id="batas_wilayah" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="telepon" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
