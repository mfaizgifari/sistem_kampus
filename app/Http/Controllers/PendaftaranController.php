<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran', [
            'title' => 'Pendaftaran',
            'mahasiswa' => Mahasiswa::get(),
            'matakuliah' => Matakuliah::get(),
            'kelas' => DB::table('kelas_data')->get()
        ]);
    }

    public function store(Request $request)
    {
        $kode_mk = $request->get('kode_mk');
        $id_user = $request->get('id_user');
        $kelas = $request->get('kelas');
        $nim = Mahasiswa::where('id_user', $id_user)->first('nim')->nim;
        $sks = Matakuliah::whereIn('kode', $kode_mk)->get('jumlah_sks');
        $jumlah_sks = 0;
        foreach ($sks as $item) {
            $jumlah_sks += $item->jumlah_sks;
        };

        // dd($jumlah_sks);

        if ($jumlah_sks > 24) {
            return redirect('/pendaftaran')->with("failed", "Anda mengambil $jumlah_sks SKS. Jumlah SKS tidak boleh lebih dari 24!");
        } else {
            'App\Models\Mahasiswa'::where('nim', $nim)->first()->matakuliah()->attach($kode_mk, ['nama_kelas' => $kelas]);
            
            return redirect('/pendaftaran')->with("success", "Anda mengambil $jumlah_sks SKS. Pendaftaran Berhasil Dilakukan!");
        }
    }
}
