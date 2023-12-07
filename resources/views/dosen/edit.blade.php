@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data</h1>
</div>
<div class="col-lg-8">
    <form method="POST" action="{{route('dosen.update', $data->nip) }}">
        @csrf
        <div class=" mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" id="nip" value="{{ $data->nip }}">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ $data->nama }}">
        </div>
        <div class="mb-3">
            <label for="Gelar" class="form-label">Gelar</label>
            <input type="text" name="gelar" class="form-control" id="gelar" value="{{ $data->gelar }}">
        </div>
        <div class="mb-3">
            <label for="matakuliah" class="form-label">Mata Kuliah</label>
            <select class="js-example-basic-multiple form-control" name="matakuliah_id[]" multiple="multiple"
                id="matakuliah">
                @foreach ($matakuliah as $item)
                <option value="{{ $item->kode }}">{{ $item->kode }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
@endsection