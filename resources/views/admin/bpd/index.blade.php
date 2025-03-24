@extends('admin.layouts.master')

@section('title', 'BPD')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                BPD
                            </h1>
                            <div class="page-header-subtitle">Tabel data BPD beserta informasi terkait</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <!-- Filter Form -->
            <div class="card mb-4">
                <div class="card-header">
                    Filter Data
                </div>
                <div class="card-body">
                    <form id="filterform" method="GET" action="{{ route('bpd.index') }}">
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
                                            style="display: none;" {{ request('desa') == $desa->iddesa ? 'selected' : '' }}>
                                            {{ $desa->nmdesa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="col-md-4">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <option value="">Pilih Tahun</option>
                                @for ($i = date('Y'); $i >= 2024; $i--)
                                    <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div> --}}
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Tampilkan Data</button>
                    </form>
                </div>
            </div>

            <!-- Data Table -->
            <div class="card mb-4">
                <div class="card-header">
                    Informasi BPD
                    <a href="{{ route('bpd.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Desa</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bpds as $bpd)
                                    <tr>
                                        <td>{{ $bpd->nama }}</td>
                                        <td>{{ $bpd->jabatan }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $bpd->foto) }}" alt="Foto"
                                                class="img-thumbnail" width="50">
                                        </td>
                                        <td>{{ $bpd->desa->nmdesa }}</td>
                                        <td>
                                            <a href="{{ route('bpd.edit', $bpd->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('bpd.destroy', $bpd->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
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
