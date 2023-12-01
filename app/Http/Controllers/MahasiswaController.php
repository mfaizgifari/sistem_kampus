<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $mahasiswa = DB::select("
        SELECT * from mahasiswa WHERE is_deleted = 0
    ");

        return view('mahasiswa.index')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = DB::select('SELECT * FROM mahasiswa');
        return view('mahasiswa.create')->with('mahasiswa', $mahasiswa);
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
            'nim' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
        ]);
        $nim = $request->nim;
        $nama = $request->nama;
        $jk = $request->jk;
        $tempat_lahir = $request->tempat_lahir;
        $tgl_lahir = $request->tgl_lahir;


        DB::insert(
            'INSERT INTO mahasiswa (nim, nama, jk,tempat_lahir,tgl_lahir,id_user,is_deleted) VALUES (?,?,?,?, ?, NULL,0)',
            [$nim, $nama, $jk, $tempat_lahir, $tgl_lahir]
        );

        return redirect('/mahasiswa')->with('success', 'Data has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data = DB::select('
        SELECT nim, nama, jk,tempat_lahir,tgl_lahir
        FROM mahasiswa
        WHERE kode = ?
    ', [$id]);

        if (!empty($data)) {
            $data = $data[0]; // Retrieve only the first row from the query result
        } else {
            return redirect()->route('mahasiswa.index')->with('error', 'Data not found');
        }

        return view('mahasiswa.edit')->with('data', $data); // Render the edit view with the fetched data
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */


    public function update($nim, Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',

        ]);

        DB::beginTransaction();

        try {

            DB::update(
                'UPDATE mahasiswa SET nim = :nim, nama = :nama, jk = :jk , tempat_lahir = :tempat_lahir, tgl_lahir = :tgl_lahir WHERE nim = :nim',
                [
                    'nim' => $request->kode,
                    'nama' => $request->nama,
                    'jk' => $request->jk,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                ]
            );


            DB::commit(); // Commit the transaction if both updates succeed
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa data has been updated');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback if an error occurs
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */

    public function destroy($nim)
    {
        $sql = "UPDATE mahasiswa SET is_deleted = 1 WHERE nim = ?";
        DB::update($sql, [$nim]);
        return redirect()->route('mahasiswa.index')->with('success', 'Data has been deleted');
    }

    public function restore($nim)
    {
        $sql = "UPDATE mahasiswa SET is_deleted = 0 WHERE nim = ?";
        DB::update($sql, [$nim]);
        return redirect()->route('mahasiswa.trash')->with('success', 'Data has been restored');
        // return redirect('/trash')->with('success', 'Data has been restored');
    }

    public function showTrash()
    {
        $trashedMatakuliah = DB::select('SELECT * FROM matakuliah WHERE is_deleted = 1');
        $trashedMahasiswa = DB::select('SELECT * FROM mahasiswa WHERE is_deleted = 1');

        return view('/trash')->with('trashedMatakuliah', $trashedMatakuliah)
            ->with('trashedMahasiswa', $trashedMahasiswa);
    }
    public function hardDelete($nim)
    {
        DB::delete("DELETE FROM mahasiswa WHERE nim = :nim AND is_deleted = 1", ['nim' => $nim]);
        return redirect()->route('matakuliah.trash')->with('success', 'Data berhasil dihapus');
    }
}
