@extends('admin.layouts.master')

@section('title', 'Pendapatan dan Pembelanjaan')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="dollar-sign"></i></div>
                                Pendapatan dan Pembelanjaan
                            </h1>
                            <div class="page-header-subtitle">Tabel data Pendapatan dan Pembelanjaan beserta informasi
                                terkait</div>
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
                    <form id="filterform" method="GET" action="{{ route('keuangan.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="desa" class="form-label">Desa</label>
                                <select class="form-select" id="desa" name="desa">
                                    <option value="">Pilih Desa</option>
                                    @foreach ($desaList as $desa)
                                        <option value="{{ $desa->iddesa }}"
                                            {{ request('desa') == $desa->iddesa ? 'selected' : '' }}>
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

            <!-- Pendapatan and Pembelanjaan Tables -->
            <div class="card mb-4">
                <div class="card-header">
                    Daftar Pendapatan dan Pembelanjaan
                    <a href="{{ route('keuangan.create') }}" class="btn btn-primary btn-sm float-end">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th>Desa</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendapatan as $item)
                                    <tr>
                                        <td>Pendapatan</td>
                                        <td>{{ $item->desa->nmdesa }}</td>
                                        <td>{{ $item->sumber_pendapatan }}</td>
                                        <td class="jumlah" data-jumlah="{{ $item->jumlah }}">
                                            {{ number_format($item->jumlah, 2) }}</td>
                                        <td>
                                            <a href="{{ route('keuangan.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('keuangan.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($pengeluaran as $item)
                                    <tr>
                                        <td>Pembelanjaan</td>
                                        <td>{{ $item->desa->nmdesa }}</td>
                                        <td>{{ $item->jenis_pengeluaran }}</td>
                                        <td class="jumlah" data-jumlah="{{ $item->jumlah }}">
                                            {{ number_format($item->jumlah, 2) }}</td>
                                        <td>
                                            <a href="{{ route('keuangan.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('keuangan.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i> Hapus</button>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new simpleDatatables.DataTable("#datatablesSimple");

            // Format Rupiah for all 'jumlah' cells
            var jumlahCells = document.querySelectorAll('.jumlah');
            jumlahCells.forEach(function(cell) {
                var jumlah = parseFloat(cell.dataset.jumlah);
                cell.innerHTML = formatRupiah(jumlah.toString());
            });
        });

        // Fungsi untuk format Rupiah
        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString();
            var split = number_string.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp. ' + rupiah;
        }
    </script>   
@endsection
