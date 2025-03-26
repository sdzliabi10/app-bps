@extends('admin.layouts.master')

@section('title', 'pkk_desas')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="shield"></i></div>
                            pkk_desas
                        </h1>
                        <div class="page-header-subtitle">Tabel data pkk_desas berdasarkan desa</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">Filter Data</div>
            <div class="card-body">
                <form method="GET" action="{{ route('pkk_desas.index') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-select" id="desa" name="desa">
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}" {{ request('desa') == $desa->iddesa ? 'selected' : '' }}>
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Tampilkan Data</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Daftar pkk_desas
                <a href="{{ route('pkk_desas.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kecamatan</th>                                
                                <th>Desa</th>
                                <th>Jumlah Pengurus</th>                                
                                <th>Jumlah Anggota</th>                                
                                <th>Jumlah Buku Administrasi</th>
                                <th>Jumlah Dana</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pkk_desas as $item)
                                <tr>
                                    <td>{{ $item->desa->kecamatan->nmkec }}</td>                                    
                                    <td>{{ $item->desa->nmdesa }}</td>
                                    <td>{{ $item->jumlah_pengurus }}</td>
                                    <td>{{ $item->jumlah_anggota }}</td>
                                    <td>{{ $item->jumlah_buku_administrasi }}</td>                                    
                                    <td>{{ number_format($item->jumlah_dana) }}</td>
                                    <td>
                                        <a href="{{ route('pkk_desas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('pkk_desas.destroy', $item->id) }}" method="POST" style="display:inline;">
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
