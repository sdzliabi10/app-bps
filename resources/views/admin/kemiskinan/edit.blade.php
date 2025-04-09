@extends('admin.layouts.master')

@section('title', 'Edit Data Program Kemiskinan')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Edit Data Program Kemiskinan</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kemiskinan.update', $kemiskinan->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="iddesa" class="form-label">Desa</label>
                            <select class="form-control" name="iddesa" id="desa" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}" 
                                        data-kecamatan="{{ $desa->kdkec }}"
                                        {{ old('iddesa', $kemiskinan->iddesa) == $desa->iddesa ? 'selected' : '' }}>
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                            @error('iddesa')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_program" class="form-label">Nama Program</label>
                            <input type="text" class="form-control" name="nama_program" id="nama_program"
                                value="{{ old('nama_program', $kemiskinan->nama_program) }}" required>
                            @error('nama_program')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_penerima" class="form-label">Jumlah Penerima</label>
                            <input type="number" class="form-control" name="jumlah_penerima" id="jumlah_penerima"
                                value="{{ old('jumlah_penerima', $kemiskinan->jumlah_penerima) }}" required min="0">
                            @error('jumlah_penerima')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update Data</button>
                            <a href="{{ route('kemiskinan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        function filterDesa() {
            var kecamatan = document.getElementById('kecamatan').value;
            var desaOptions = document.querySelectorAll('#desa option');

            desaOptions.forEach(function(option) {
                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }
                if (option.getAttribute('data-kecamatan') === kecamatan || kecamatan === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            filterDesa();
        });
    </script>
@endsection

