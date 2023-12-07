@extends('layouts.main')

@section('container')
<h1>Trash Matakuliah</h1>

@if (empty($trashedMatakuliah))
<p>No trashed records found.</p>
@else
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th class="text-center" scope="col">Jumlah SKS</th>
                <th class="text-center" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trashedMatakuliah as $matakuliah)
            <tr>
                <td>{{ $matakuliah->kode }}</td>
                <td>{{ $matakuliah->nama }}</td>
                <td class="text-center">{{ $matakuliah->jumlah_sks }}</td>
                <td class="text-center">
                    <form method="post" action="{{ url('/matakuliah/restore', $matakuliah->kode) }}">
                        @csrf
                        <button type="submit" class="btn btn-warning rounded-4">Restore</button>
                    </form>
                    <form method="post" action="{{ route('matakuliah.hardDelete',$matakuliah -> kode) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-4"
                            onclick="return confirm('Are you sure?')">Hard Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<div class="mt-5">
    <h2>Trash Mahasiswa</h2>
    @if (empty($trashedMahasiswa))
    <p>No trashed records found for Mahasiswa.</p>
    @else
    <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashedMahasiswa as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->jk}}</td>
                    <td>{{ $mahasiswa->tempat_lahir }}</td>
                    <td>{{ $mahasiswa->tgl_lahir }}</td>
                    <td class="text-center">
                        <form method="post" action="{{ url('/mahasiswa/restore', $mahasiswa->nim) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning rounded-4">Restore</button>
                        </form>
                        <form method="post" action="{{ route('mahasiswa.hardDelete', $mahasiswa->nim) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-4"
                                onclick="return confirm('Are you sure?')">Hard Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection