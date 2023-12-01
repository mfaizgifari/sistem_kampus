@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data</h1>
</div>
<div class="col-lg-8">
    <form method="POST" action="{{route('matakuliah.update', $matakuliah->kode) }}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" name="kode" class="form-control" id="kode" value="{{ $matakuliah->kode }}">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ $matakuliah->nama }}">
        </div>
        <div class="mb-3">
            <label for="jumlah_sks" class="form-label">Jumlah SKS</label>
            <input type="text" name="jumlah_sks" class="form-control" id="jumlah_sks"
                value="{{ $matakuliah->jumlah_sks }}">
        </div>
        <div class="mb-3">
            <label for="dosen" class="form-label">Dosen</label>
            <select class="js-example-basic-multiple form-control" name="dosen_id[]" multiple="multiple" id="dosen">
                @foreach ($dosen as $item)
                <option value="{{ $item->NIP }}">{{ $item->NIP }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
@endsection