

@extends('admin.layouts.master')

@section('title', 'Data Jalan Desa')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="road"></i></div>
                                Data Jalan Desa
                            </h1>
                            <div class="page-header-subtitle">Tabel data jalan desa beserta informasi terkait</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Data Jalan Desa
                    <a href="{{ route('jalan-desa.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Nama Jalan</th>
                                    <th>Panjang (km)</th>
                                    <th>Lebar (m)</th>
                                    <th>Kondisi</th>
                                    <th>Jenis</th>
                                    <th>Lokasi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jalanDesas as $jalanDesa)
                                    <tr>
                                        <td>{{ $jalanDesa->desa->kecamatan->nmkec }}</td>
                                        <td>{{ $jalanDesa->desa->nmdesa }}</td>
                                        <td>{{ $jalanDesa->nama_jalan }}</td>
                                        <td>{{ $jalanDesa->panjang }}</td>
                                        <td>{{ $jalanDesa->lebar }}</td>
                                        <td>{{ $jalanDesa->kondisi }}</td>
                                        <td>{{ $jalanDesa->jenis }}</td>
                                        <td>{{ Str::limit($jalanDesa->lokasi, 50) }}</td>
                                        <td>
                                            <a href="{{ route('jalan-desa.edit', $jalanDesa->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('jalan-desa.destroy', $jalanDesa->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i> Delete
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


