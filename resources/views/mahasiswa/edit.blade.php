@extends('layouts.main')

@section('container')
<div
     class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data</h1>
</div>
<div class="col-lg-8">
    <form method="POST" action="/mahasiswa/{{ $mahasiswa->nim }}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" id="nim"
                   value="{{ $mahasiswa->nim }}">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama"
                   value="{{ $mahasiswa->nama }}">
        </div>
        <div class="mb-3">
            <label for="jk" class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jk" id="jk" value>
                <option value="Laki-laki" @if ($mahasiswa->jk == 'Laki-laki') selected
                    @endif>Laki-laki</option>
                <option value="Perempuan" @if ($mahasiswa->jk == 'Perempuan') selected
                    @endif>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                   value="{{ $mahasiswa->tempat_lahir }}">
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                   value="{{ $mahasiswa->tgl_lahir }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
@endsection
