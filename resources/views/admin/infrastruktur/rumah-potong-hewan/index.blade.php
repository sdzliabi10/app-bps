

@extends('admin.layouts.master')

@section('title', 'Data Rumah Potong Hewan')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Data Rumah Potong Hewan
                            </h1>
                            <div class="page-header-subtitle">Tabel data rumah potong hewan beserta informasi terkait</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Data Rumah Potong Hewan
                    <a href="{{ route('rumah-potong-hewan.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Nama RPH</th>
                                    <th>Luas (m²)</th>
                                    <th>Kondisi</th>
                                    <th>Lokasi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rumahPotongHewans as $rph)
                                    <tr>
                                        <td>{{ $rph->desa->kecamatan->nmkec }}</td>
                                        <td>{{ $rph->desa->nmdesa }}</td>
                                        <td>{{ $rph->nama_rph }}</td>
                                        <td>{{ $rph->luas }}</td>
                                        <td>{{ $rph->kondisi }}</td>
                                        <td>{{ Str::limit($rph->lokasi, 50) }}</td>
                                        <td>
                                            <a href="{{ route('rumah-potong-hewan.edit', $rph->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('rumah-potong-hewan.destroy', $rph->id) }}" method="POST"
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




