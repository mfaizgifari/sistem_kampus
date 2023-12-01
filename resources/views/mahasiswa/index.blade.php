@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mahasiswa</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="table-responsive col-lg-8">
    <a href="/mahasiswa/create" class="btn btn-primary mb-3">Create New Data</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">NIM</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Tanggal Lahir</th>
                <th class="text-center" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)
            <tr>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jk }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ $item->tgl_lahir }}</td>
                <td class="text-center">
                    <a href="/mahasiswa/{{ $item->nim }}/edit" class="btn btn-warning rounded-4"><span
                            data-feather="edit">Edit</span></a>
                    <form method="post" action="/mahasiswa/{{ $item->nim }}" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger rounded-4" onclick="return confirm('Are you sure?')"><span
                                data-feather="trash">Delete</span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection