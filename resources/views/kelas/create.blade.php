@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Data</h1>
</div>
<div class="col-lg-4">
    <form method="POST" action="{{ route('kelas.store') }}">
        @csrf
        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Kode Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas">
        </div>
        <div class=" mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="number" name="nim" class="form-control" id="nim">
        </div>
        <!-- <div class=" mb-3">
            <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" class="form-control" id="kode_mk">
        </div> -->
        <div class="mb-3">
            <label for="matakuliah" class="form-label">Kode Mata Kuliah</label>
            <select class="js-example-basic-multiple form-control" name="matakuliah_id[]" multiple="multiple"
                id="matakuliah">
                @foreach ($matakuliah as $item)
                <option value="{{ $item->kode }}">{{ $item->kode }}</option>
                @endforeach
            </select>
        </div>
        <button type=" submit" class="btn btn-primary">Create Data</button>
    </form>
</div>
@endsection