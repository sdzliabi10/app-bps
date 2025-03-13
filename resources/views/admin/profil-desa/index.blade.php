@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')

<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                            Kecamatan dan Desa
                        </h1>
                        <div class="page-header-subtitle">Tabel data Kecamatan dan Desa beserta informasi terkait</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">Informasi Kecamatan dan Desa</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kecamatan</th>
                                <th>Desa</th>
                                <th>Tahun</th>
                                <th>Visi & Misi</th>
                                <th>Program Unggulan</th>
                                <th>Batas Wilayah</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kecamatan A</td>
                                <td>Desa A1</td>
                                <td>2023</td>
                                <td>Visi: Mewujudkan desa sejahtera. Misi: Peningkatan kualitas hidup.</td>
                                <td>Program Pemberdayaan Masyarakat, Pendidikan, Kesehatan</td>
                                <td>Utara: Desa B1, Timur: Desa C1, Selatan: Desa D1, Barat: Desa E1</td>
                                <td>Jl. Raya No.1, Desa A1</td>
                                <td>(021) 12345678</td>
                                <td>
                                    <button class="btn btn-primary btn-icon" type="button">
                                        <i class="fas fa-eye"></i> <!-- Show Icon -->
                                    </button>
                                    <button class="btn btn-warning btn-icon" type="button">
                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                    </button>
                                    <button class="btn btn-danger btn-icon" type="button">
                                        <i class="fas fa-trash"></i> <!-- Delete Icon -->
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Kecamatan B</td>
                                <td>Desa B2</td>
                                <td>2023</td>
                                <td>Visi: Menjadi desa ramah lingkungan. Misi: Menjaga kelestarian alam.</td>
                                <td>Program Pengelolaan Sampah, Konservasi Alam</td>
                                <td>Utara: Desa F2, Timur: Desa G2, Selatan: Desa H2, Barat: Desa I2</td>
                                <td>Jl. Merdeka No.2, Desa B2</td>
                                <td>(022) 23456789</td>
                                <td>
                                    <button class="btn btn-primary btn-icon" type="button">
                                        <i class="fas fa-eye"></i> <!-- Show Icon -->
                                    </button>
                                    <button class="btn btn-warning btn-icon" type="button">
                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                    </button>
                                    <button class="btn btn-danger btn-icon" type="button">
                                        <i class="fas fa-trash"></i> <!-- Delete Icon -->
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Kecamatan C</td>
                                <td>Desa C3</td>
                                <td>2023</td>
                                <td>Visi: Pembangunan Infrastruktur Desa. Misi: Meningkatkan sarana dan prasarana.</td>
                                <td>Program Infrastruktur Desa, Peningkatan Transportasi</td>
                                <td>Utara: Desa J3, Timur: Desa K3, Selatan: Desa L3, Barat: Desa M3</td>
                                <td>Jl. Sejahtera No.3, Desa C3</td>
                                <td>(023) 34567890</td>
                                <td>
                                    <button class="btn btn-primary btn-icon" type="button">
                                        <i class="fas fa-eye"></i> <!-- Show Icon -->
                                    </button>
                                    <button class="btn btn-warning btn-icon" type="button">
                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                    </button>
                                    <button class="btn btn-danger btn-icon" type="button">
                                        <i class="fas fa-trash"></i> <!-- Delete Icon -->
                                    </button>
                                </td>
                            </tr>
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
@endsection
