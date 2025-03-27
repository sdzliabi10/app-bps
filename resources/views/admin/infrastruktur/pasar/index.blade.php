@extends('admin.layouts.master')

@section('title', 'Data Pasar')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="shopping-cart"></i></div>
                                Data Pasar
                            </h1>
                            <div class="page-header-subtitle">Tabel data pasar beserta informasi terkait</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Data Pasar
                    <a href="{{ route('pasar.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Nama Pasar</th>
                                    <th>Panjang (m)</th>
                                    <th>Lebar (m)</th>
                                    <th>Kondisi</th>
                                    <th>Lokasi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasars as $pasar)
                                    <tr>
                                        <td>{{ $pasar->desa->kecamatan->nmkec }}</td>
                                        <td>{{ $pasar->desa->nmdesa }}</td>
                                        <td>{{ $pasar->nama_pasar }}</td>
                                        <td>{{ $pasar->panjang }}</td>
                                        <td>{{ $pasar->lebar }}</td>
                                        <td>{{ $pasar->kondisi }}</td>
                                        <td>{{ Str::limit($pasar->lokasi, 50) }}</td>
                                        <td>
                                            <a href="{{ route('pasar.edit', $pasar->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('pasar.destroy', $pasar->id) }}" method="POST"
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


