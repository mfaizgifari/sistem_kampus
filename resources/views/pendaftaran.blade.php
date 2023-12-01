@extends('layouts.main')
@section('container')
<div
     class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pendaftaran</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session()->has('failed'))
<div class="alert alert-danger alert-dismissible fade show col-lg-8" role="alert">
    {{ session('failed') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif

<div class="table-responsive col-lg-8">
    <form action="/pendaftaran" method="POST" class="d-flex flex-column align-items-end">
        @csrf
        @can(!'admin')
        <input type="hidden" name="mhs" id="id_user" value="{{ Auth::user()->id }}">
        @endcan
        @can('admin')
        <select class="form-select" name="mhs" id="mhs" value>
            <option selected hidden>Pilih Mahasiswa</option>
            @foreach ($mahasiswa as $item)
            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
            @endforeach
        </select>
        @endcan
        <select class="form-select my-3" name="kelas" id="kelas" value>
            <option selected hidden>Pilih Kelas</option>
            @foreach ($kelas as $item)
            <option value="{{ $item->nama_kelas }}">{{ $item->nama_kelas }}</option>
            @endforeach
        </select>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nama Dosen</th>
                    <th class="text-center" scope="col">Jumlah SKS</th>
                    <th class="text-center" scope="col">Pilih</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matakuliah as $item)
                <tr>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <ul style="list-style-type: none;padding-left: 0px;">
                            @foreach ($item->dosen as $d)
                            <li>{{ $d->Nama }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">{{ $item->jumlah_sks }}</td>
                    <td class="text-center">
                        <input class="form-check-input mt-0" type="checkbox" name="kode_mk[]" value="{{ $item->kode }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary mb-5">Daftar</button>
    </form>
</div>
@endsection
