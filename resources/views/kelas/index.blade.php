@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelas</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-2" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="table-responsive col-lg-6">
    <a href="/kelas/create" class="btn btn-primary mb-3">Create New Data</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Kode Kelas</th>
                <th scope="col">Kode Mata Kuliah</th>
                <th class="text-center" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $item)
            <tr>
                <td>{{ $item->kode_kelas }}</td>
                <td>{{ $item->kode_mk }}</td>
                <td class="text-center">
                    <a href="/kelas/{{ $item->id }}/edit" class="btn btn-warning rounded-4"><span
                            data-feather="edit">Edit</span></a>
                    <form method="post" action="/kelas/{{ $item->id }}" class="d-inline">
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