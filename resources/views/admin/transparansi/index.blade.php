@extends('admin.layouts.master')

@section('title', 'Transparansi')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Transparansi
                            </h1>
                            <div class="page-header-subtitle">Tabel data Transparansi Desa beserta informasi terkait</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <!-- Filter Form -->
            <div class="card mb-4">
                <div class="card-header">Filter Data</div>
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ route('transparansi.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-select" id="kecamatan" name="kecamatan" onchange="filterDesa()">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatanList as $kecamatan)
                                        <option value="{{ $kecamatan->kdkec }}"
                                            {{ request('kecamatan') == $kecamatan->kdkec ? 'selected' : '' }}>
                                            {{ $kecamatan->nmkec }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="desa" class="form-label">Desa</label>
                                <select class="form-select" id="desa" name="desa">
                                    <option value="">Pilih Desa</option>
                                    @foreach ($desaList as $desa)
                                        <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}"
                                            {{ request('desa') == $desa->iddesa ? 'selected' : '' }}>
                                            {{ $desa->nmdesa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">Filter</button>
                                <a href="{{ route('transparansi.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Data Table -->
            <div class="card mb-4">
                <div class="card-header">
                    Data Transparansi
                    <a href="{{ route('transparansi.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Jenis</th>
                                    <th>Judul/Nama</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transparansiList as $data)
                                    <tr>
                                        <td>{{ $data->desa->kecamatan->nmkec }}</td>
                                        <td>{{ $data->desa->nmdesa }}</td>
                                        <td>{{ ucfirst($data->jenis) }}</td>
                                        <td>{{ $data->judul ?? $data->nama }}</td>
                                        <td>{{ $data->nomor ?? '-' }}</td>
                                        <td>{{ $data->tanggal ? $data->tanggal->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('transparansi.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('transparansi.destroy', $data->id) }}"
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
    <script>
        function filterDesa() {
            const kecamatan = document.getElementById('kecamatan').value;
            const desaSelect = document.getElementById('desa');
            const desaOptions = desaSelect.querySelectorAll('option');

            desaOptions.forEach(option => {
                if (option.value === '') return; // Skip placeholder option
                const desaKecamatan = option.getAttribute('data-kecamatan');
                option.style.display = desaKecamatan === kecamatan ? '' : 'none';
            });

            // Reset desa selection
            desaSelect.value = '';
        }

        // Initialize DataTables
        document.addEventListener('DOMContentLoaded', function() {
            new simpleDatatables.DataTable("#datatablesSimple");
        });
    </script>
@endsection



