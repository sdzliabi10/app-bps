@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                            Kecamatan dan Desa
                        </h1>
                        <div class="page-header-subtitle">Tabel data Kecamatan dan Desa beserta informasi terkait</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                Informasi Kecamatan dan Desa
                <a href="{{ route('admin-profil-desa.create') }}" class="btn btn-primary btn-sm float-end">Tambah Desa</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kecamatan</th>
                                <th>Desa</th>
                                <th>Tahun</th>
                                <th>Visi & Misi</th>
                                <th>Program Unggulan</th>
                                <th>Batas Wilayah</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profilDesas as $profilDesa)
                                <tr>
                                    <td>{{ $profilDesa->kecamatan }}</td>
                                    <td>{{ $profilDesa->desa }}</td>
                                    <td>{{ $profilDesa->tahun }}</td>
                                    <td>{{ $profilDesa->visi_misi }}</td>
                                    <td>{{ $profilDesa->program_unggulan }}</td>
                                    <td>{{ $profilDesa->batas_wilayah }}</td>
                                    <td>{{ $profilDesa->alamat }}</td>
                                    <td>{{ $profilDesa->telepon }}</td>
                                    <td>
                                        <a href="{{ route('admin-profil-desa.edit', $profilDesa->id) }}" class="btn btn-warning btn-icon">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin-profil-desa.destroy', $profilDesa->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
@endsection
