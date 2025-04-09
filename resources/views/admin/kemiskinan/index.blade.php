@extends('admin.layouts.master')

@section('title', 'Data Program Kemiskinan')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <!-- Data Table -->
            <div class="card mb-4">
                <div class="card-header">
                    Data Program Kemiskinan
                    <a href="{{ route('kemiskinan.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Nama Program</th>
                                    <th>Jumlah Penerima</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kemiskinanList as $item)
                                    <tr>
                                        <td>{{ $item->desa->kecamatan->nmkec }}</td>
                                        <td>{{ $item->desa->nmdesa }}</td>
                                        <td>{{ $item->nama_program }}</td>
                                        <td>{{ number_format($item->jumlah_penerima) }}</td>
                                        <td>
                                            <a href="{{ route('kemiskinan.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('kemiskinan.destroy', $item->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new simpleDatatables.DataTable("#datatablesSimple");
        });
    </script>
@endsection

