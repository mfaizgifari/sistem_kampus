@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mata Kuliah</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="input-group col-lg-8 mb-3">
    <form action="{{ route('matakuliah.search') }}" method="GET" class="w-100">
        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </form>
</div>

<div class="table-responsive col-lg-8">
    <a href="/matakuliah/create" class="btn btn-primary mb-3">Create New Data</a>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>

                <th class="text-center" scope="col">Jumlah SKS</th>
                <th class="text-center" scope="col">Action</th>
            </tr </thead>
        <tbody>
            @foreach ($matakuliah as $item)
            <tr>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td class="text-center">{{ $item->jumlah_sks }}</td>
                <td class="text-center">
                    <a href="/matakuliah/{{ $item->kode }}/edit" class="btn btn-warning rounded-4"><span
                            data-feather="edit">Edit</span></a>
                    <form method="post" action="/matakuliah/{{ $item->kode }}" class="d-inline">
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