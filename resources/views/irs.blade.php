@extends('layouts.main')
@section('container')
<div
     class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
    <h1 class="h2">IRS</h1>
</div>
<div class="pt-3 pb-2 mb-3">
    <p>Nama: {{ $nama }}</p>
    <p>NIM: {{ $nim }}</p>
    <p>Kelas: {{ $kelas}}</p>
</div>
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama Dosen</th>
                <th class="text-center" scope="col">Jumlah SKS</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
