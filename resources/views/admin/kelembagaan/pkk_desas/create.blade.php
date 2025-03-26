@extends('admin.layouts.master')

@section('title', 'Tambah pkk_desas')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah pkk_desas</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pkk_desas.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="filterDesa()" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->kdkec }}"
                                        {{ old('kecamatan') == $kecamatan->kdkec ? 'selected' : '' }}>
                                        {{ $kecamatan->nmkec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Desa Selection -->
                        <div class="mb-3">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-control" name="iddesa" id="desa" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}" style="display: none;">
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>                        

                        <!-- Jumlah Pengurus -->
                        <div class="mb-3">
                            <label for="jumlah_pengurus" class="form-label">Jumlah Pengurus</label>
                            <input type="number" class="form-control" name="jumlah_pengurus" id="jumlah_pengurus" required
                                value="{{ old('jumlah_pengurus') }}">
                        </div>

                        <!-- Jumlah Anggota -->
                        <div class="mb-3">
                            <label for="jumlah_anggota" class="form-label">Jumlah Anggota</label>
                            <input type="number" class="form-control" name="jumlah_anggota" id="jumlah_anggota"
                                value="{{ old('jumlah_anggota') }}">
                        </div>

                        <!-- Jumlah Kegiatan -->
                        <div class="mb-3">
                            <label for="jumlah_kegiatan" class="form-label">Jumlah Kegiatan</label>
                            <input type="number" class="form-control" name="jumlah_kegiatan" id="jumlah_kegiatan"
                                value="{{ old('jumlah_kegiatan') }}">
                        </div>

                        <!-- Jumlah Buku Administrasi -->
                        <div class="mb-3">
                            <label for="jumlah_buku_administrasi" class="form-label">Jumlah Buku Administrasi</label>
                            <input type="number" class="form-control" name="jumlah_buku_administrasi"
                                id="jumlah_buku_administrasi" value="{{ old('jumlah_buku_administrasi') }}">
                        </div>

                        <!-- Jumlah Dana -->
                        <div class="mb-3">
                            <label for="jumlah_dana" class="form-label">Jumlah Dana</label>
                            <input type="text" class="form-control" name="jumlah_dana" id="jumlah_dana"
                                value="{{ old('jumlah_dana') }}">
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
            document.getElementById('jumlah_dana').addEventListener('input', function(e) {
                var jumlahInput = e.target;
                var formattedValue = formatRupiah(jumlahInput.value);
                jumlahInput.value = formattedValue;
            });

            // Menghapus format Rupiah sebelum mengirimkan data ke server
            document.querySelector('form').addEventListener('submit', function(e) {
                var jumlahInput = document.getElementById('jumlah_dana');
                var rawValue = jumlahInput.value.replace(/[^0-9]/g, ''); // Menghapus non-numeric characters
                jumlahInput.value = rawValue; // Update value before form submission
            });
        </script>
    </main>
@endsection
