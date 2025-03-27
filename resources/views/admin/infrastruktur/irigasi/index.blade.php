

@extends('admin.layouts.master')

@section('title', 'Data Irigasi')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Data Irigasi
                            </h1>
                            <div class="page-header-subtitle">Tabel data irigasi beserta informasi terkait</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Data Irigasi
                    <a href="{{ route('irigasi.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Nama Irigasi</th>
                                    <th>Panjang (m)</th>
                                    <th>Lebar (m)</th>
                                    <th>Kondisi</th>
                                    <th>Lokasi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($irigasis as $irigasi)
                                    <tr>
                                        <td>{{ $irigasi->desa->kecamatan->nmkec }}</td>
                                        <td>{{ $irigasi->desa->nmdesa }}</td>
                                        <td>{{ $irigasi->nama_irigasi }}</td>
                                        <td>{{ $irigasi->panjang }}</td>
                                        <td>{{ $irigasi->lebar }}</td>
                                        <td>{{ $irigasi->kondisi }}</td>
                                        <td>{{ Str::limit($irigasi->lokasi, 50) }}</td>
                                        <td>
                                            <a href="{{ route('irigasi.edit', $irigasi->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('irigasi.destroy', $irigasi->id) }}" method="POST"
                                                class="d-inline">
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



