@extends('admin.layouts.master')

@section('title', 'Tambah BPD')

@section('content')
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card mb-4">
                <div class="card-header">Tambah BPD</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bpd.store') }}" enctype="multipart/form-data">
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

                        <div class="mb-3">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-control" name="iddesa" id="desa" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desaList as $desa)
                                    <option value="{{ $desa->iddesa }}" data-kecamatan="{{ $desa->kdkec }}"
                                        style="display: none;">
                                        {{ $desa->nmdesa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan"
                                value="{{ old('jabatan') }}" required>
                        </div>                        

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>    
@endsection
