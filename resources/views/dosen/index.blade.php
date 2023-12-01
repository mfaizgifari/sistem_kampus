{{-- {{ dd($dosen->pendidikan) }} --}}
@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dosen</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="table-responsive col-lg-8">
    <a href="/dosen/create" class="btn btn-primary mb-3">Create New Data</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">NIP</th>
                <th scope="col">Nama</th>
                <th scope="col">Gelar</th>
                <th scope="col">Mata Kuliah</th>
                {{-- <th class="text-center" scope="col">Riwayat Pendidikan</th> --}}
                <th class="text-center" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $item)
            <tr>
                <td>{{ $item->NIP }}</td>
                <td>{{ $item->Nama }}</td>
                <td>{{ $item->Gelar }}</td>
                <td>
                    <ul style="list-style-type: none;padding-left: 0px;">
                        @foreach ($item->matakuliah as $mk)
                        <li>{{ $mk}}</li>
                        @endforeach
                    </ul>
                </td>
                {{-- <td class=" text-center"><a href="/pendidikan/{{ $item->NIP}}" class="badge bg-primary"><span
                            data-feather="eye"></span></a>
                </td> --}}
                <td class="text-center">
                    <a href="/dosen/{{ $item->NIP }}/edit" class="btn btn-warning rouded-4"><span
                            data-feather="edit">Edit</span></a>
                    <form method="post" action="/dosen/{{ $item->NIP }}" class="d-inline">
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