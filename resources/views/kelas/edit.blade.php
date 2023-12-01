@extends('layouts.main')

@section('container')
<div
     class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data</h1>
</div>
<div class="col-lg-4">
    <form method="POST" action="/kelas/{{ $kelas->id }}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="kode_kelas" class="form-label">Kode Kelas</label>
            <input type="text" name="kode_kelas" class="form-control" id="kode_kelas"
                   value="{{ $kelas->kode_kelas }}">
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="number" name="nim" class="form-control" id="nim"
                   value="{{ $kelas->nim }}">
        </div>
        <div class="mb-3">
            <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" class="form-control" id="kode_mk"
                   value="{{ $kelas->kode_mk }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
@endsection
