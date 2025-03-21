@extends('admin.layouts.master')

@section('title', 'Tambah Pendapatan dan Pembelanjaan')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah Pendapatan atau Pembelanjaan</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('keuangan.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-select" name="iddesa" id="desa" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}"
                                        {{ old('iddesa') == $desa->iddesa ? 'selected' : '' }}>
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <select class="form-select" name="tipe" id="tipe" required>
                                <option value="">Pilih Tipe</option>
                                <option value="pendapatan" {{ old('tipe') == 'pendapatan' ? 'selected' : '' }}>Pendapatan
                                </option>
                                <option value="pengeluaran" {{ old('tipe') == 'pengeluaran' ? 'selected' : '' }} >
                                    Pembelanjaan</option>
                            </select>
                        </div>

                        <!-- Field Sumber Pendapatan, Tampil jika tipe = Pendapatan -->
                        <div class="mb-3" id="sumber_pendapatan_group" style="display: none;">
                            <label for="sumber_pendapatan" class="form-label">Sumber Pendapatan</label>
                            <input type="text" class="form-control" name="sumber_pendapatan" id="sumber_pendapatan"
                                value="{{ old('sumber_pendapatan') }}">
                        </div>

                        <!-- Field Jenis Pengeluaran, Tampil jika tipe = Pembelanjaan -->
                        <div class="mb-3" id="jenis_pengeluaran_group" style="display: none;">
                            <label for="jenis_pengeluaran" class="form-label">Jenis Pengeluaran</label>
                            <input type="text" class="form-control" name="jenis_pengeluaran" id="jenis_pengeluaran"
                                value="{{ old('jenis_pengeluaran') }}">
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah"
                                value="{{ old('jumlah') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
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
        
            // Event listener untuk mengformat jumlah
            document.getElementById('jumlah').addEventListener('input', function (e) {
                var jumlahInput = e.target;
                var formattedValue = formatRupiah(jumlahInput.value);
                jumlahInput.value = formattedValue;
            });
        
            // Menghapus format Rupiah sebelum mengirimkan data ke server
            document.querySelector('form').addEventListener('submit', function (e) {
                var jumlahInput = document.getElementById('jumlah');
                var rawValue = jumlahInput.value.replace(/[^0-9]/g, '');  // Menghapus non-numeric characters
                jumlahInput.value = rawValue;  // Update value before form submission
            });
        
            // Menambahkan event listener untuk perubahan tipe
            document.getElementById('tipe').addEventListener('change', function () {
                let tipe = this.value;
                let sumberPendapatanGroup = document.getElementById('sumber_pendapatan_group');
                let jenisPengeluaranGroup = document.getElementById('jenis_pengeluaran_group');
        
                // Menyembunyikan kedua field pada awalnya
                sumberPendapatanGroup.style.display = 'none';
                jenisPengeluaranGroup.style.display = 'none';
        
                // Menampilkan field berdasarkan pilihan tipe
                if (tipe === 'pendapatan') {
                    sumberPendapatanGroup.style.display = 'block'; // Menampilkan sumber pendapatan
                } else if (tipe === 'pengeluaran') {
                    jenisPengeluaranGroup.style.display = 'block'; // Menampilkan jenis pengeluaran
                }
            });
        
            // Memastikan state field saat halaman pertama kali dimuat
            document.addEventListener('DOMContentLoaded', function () {
                let tipe = document.getElementById('tipe').value;
                if (tipe === 'pendapatan') {
                    document.getElementById('sumber_pendapatan_group').style.display = 'block';
                } else if (tipe === 'pengeluaran') {
                    document.getElementById('jenis_pengeluaran_group').style.display = 'block';
                }
            });
        </script>        
    </main>

@endsection
