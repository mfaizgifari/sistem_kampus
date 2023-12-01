<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matakuliah = DB::select("
        SELECT * from matakuliah WHERE is_deleted = 0
    ");

        return view('matakuliah.index')->with('matakuliah', $matakuliah);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matakuliah = DB::select('SELECT * FROM matakuliah');
        return view('matakuliah.create')->with('matakuliah', $matakuliah);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'jumlah_sks' => 'required',
        ]);
        $kode = $request->kode;
        $nama = $request->nama;
        $jumlah_sks = $request->jumlah_sks;


        DB::insert(
            'INSERT INTO matakuliah (kode, nama, jumlah_sks,is_deleted) VALUES (?, ?, ?,0)',
            [$kode, $nama, $jumlah_sks]
        );

        return redirect('/matakuliah')->with('success', 'Data has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function show(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        $data = DB::select('
        SELECT kode, nama, jumlah_sks
        FROM matakuliah
        WHERE kode = ?
    ', [$kode]);

        if (!empty($data)) {
            $data = $data[0]; // Retrieve only the first row from the query result
        } else {
            return redirect()->route('matakuliah.index')->with('error', 'Data not found');
        }

        return view('matakuliah.edit')->with('data', $data); // Render the edit view with the fetched data
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */


    public function update($id, Request $request)
    {
        $request->validate([

            'nama' => 'required',
            'jumlah_sks' => 'required',

        ]);

        DB::update(
            'UPDATE matakuliah SET nama = :nama, jumlah_sks = :jumlah_sks WHERE kode = :id',
            [

                'nama' => $request->nama,
                'jumlah_sks' => $request->jumlah_sks,
                'id' => $id,
            ]
        );

        return redirect()->route('matakuliah.index')->with('success', 'Data Admin berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        $sql = "UPDATE matakuliah SET is_deleted = 1 WHERE kode = ?";
        DB::update($sql, [$kode]);
        return redirect()->route('matakuliah.index')->with('success', 'Data has been deleted');
    }

    public function restore($kode)
    {
        $sql = "UPDATE matakuliah SET is_deleted = 0 WHERE kode = ?";
        DB::update($sql, [$kode]);
        return redirect()->route('matakuliah.trash')->with('success', 'Data has been restored');
        // retu  rn redirect('/trash')->with('success', 'Data has been restored');
    }

    public function showTrash()
    {
        $trashedMatakuliah = DB::select('SELECT * FROM matakuliah WHERE is_deleted = 1');
        $trashedMahasiswa = DB::select('SELECT * FROM mahasiswa WHERE is_deleted = 1');

        return view('/trash')->with('trashedMatakuliah', $trashedMatakuliah)
            ->with('trashedMahasiswa', $trashedMahasiswa);
    }


    public function hardDelete($kode)
    {

        DB::delete("DELETE FROM matakuliah WHERE kode = :kode AND is_deleted = 1", ['kode' => $kode]);
        return redirect()->route('matakuliah.trash')->with('success', 'Data berhasil dihapus');
    }

    public function matakuliahsearch(Request $request)
    {
        $search = $request->input('search');

        $matakuliah = DB::select("
            SELECT * FROM matakuliah 
            WHERE nama LIKE '%$search%' 
        ");

        return view('matakuliah.index')->with('matakuliah', $matakuliah);
    }




}
