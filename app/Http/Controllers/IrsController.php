<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;

class IrsController extends Controller
{
    public function index()
    {
        $nim = Mahasiswa::where('id_user', Auth::user()->id)->first('nim')->nim;
        $nama = Mahasiswa::where('id_user', Auth::user()->id)->first('nama')->nama;
        $kelas = Kelas::where('nim', $nim)->first('kode_kelas')->kode_kelas;
        $kode_mk = Kelas::where('nim', $nim)->get('kode_mk');
        $matakuliah = Matakuliah::whereIn('kode', $kode_mk)->get();
        return view('irs', [
            'title' => 'IRS',
            'nim' => $nim,
            'nama' => $nama,
            'kelas' => $kelas,
            'matakuliah' => $matakuliah
        ]);
    }
}
