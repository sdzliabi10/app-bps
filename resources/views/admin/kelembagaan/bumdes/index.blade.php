@extends('admin.layouts.master')

@section('title', 'bumdes')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="shield"></i></div>
                                BUMDES
                            </h1>
                            <div class="page-header-subtitle">Tabel data bumdes berdasarkan desa</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Daftar bumdes
                    <a href="{{ route('bumdes.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>                                    
                                    <th>Desa</th>
                                    <th>Nama Bumdes</th>
                                    <th>Deskripsi</th>                                    
                                    <th>Actions</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bumdes as $item)
                                    <tr>
                                        <td>{{ $item->desa->kecamatan->nmkec }}</td>                                    
                                        <td>{{ $item->desa->nmdesa }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->deskripsi }}</td>                                    
                                        <td>
                                            <a href="{{ route('bumdes.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('bumdes.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
