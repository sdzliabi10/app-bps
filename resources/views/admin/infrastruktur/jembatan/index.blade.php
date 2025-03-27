@extends('admin.layouts.master')

@section('title', 'Data Jembatan')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="git-merge"></i></div>
                                Data Jembatan
                            </h1>
                            <div class="page-header-subtitle">Tabel data jembatan beserta informasi terkait</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Data Jembatan
                    <a href="{{ route('jembatan.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Nama Jembatan</th>
                                    <th>Panjang (m)</th>
                                    <th>Lebar (m)</th>
                                    <th>Kondisi</th>
                                    <th>Lokasi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jembatans as $jembatan)
                                    <tr>
                                        <td>{{ $jembatan->desa->kecamatan->nmkec }}</td>
                                        <td>{{ $jembatan->desa->nmdesa }}</td>
                                        <td>{{ $jembatan->nama_jembatan }}</td>
                                        <td>{{ $jembatan->panjang }}</td>
                                        <td>{{ $jembatan->lebar }}</td>
                                        <td>{{ $jembatan->kondisi }}</td>
                                        <td>{{ Str::limit($jembatan->lokasi, 50) }}</td>
                                        <td>
                                            <a href="{{ route('jembatan.edit', $jembatan->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('jembatan.destroy', $jembatan->id) }}"
                                                method="POST" style="display:inline;">
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

