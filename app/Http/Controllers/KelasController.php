<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $kelas = DB::select('SELECT * FROM kelas');

        return view('kelas.index', [
            'title' => 'Kelas',
            'kelas' => $kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $matakuliah = Matakuliah::all(); // Fetch all data from the Matakuliah table

        return view('kelas.create', compact('matakuliah'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request) {
    //     $data = $request->all();
    //     DB::insert('INSERT INTO kelas (id,nim,kode_mk, kode_kelas) VALUES (?,NULL,?, ?)', [$data['kode_mk'], $data['kode_kelas']]);
    //     return redirect('/kelas')->with('success', 'Data has been created');
    // }

    public function store(Request $request) {
        $data = $request->validate([
            'kode_mk' => 'required',
            'kode_kelas' => 'required',
        ]);

        // Assuming you have an 'id' field set as auto-increment in your table
        $kodeMk = $data['kode_mk'];
        $kodeKelas = $data['kode_kelas'];

        DB::table('kelas')->insert([
            'nim' => NULL,
            'kode_mk' => $kodeMk,
            'kode_kelas' => $kodeKelas
        ]);

        return redirect('/kelas')->with('success', 'Data has been created');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $kelas = DB::select('SELECT * FROM kelas WHERE id = ?', [$id]);

        if(!empty($kelas)) {
            $kelas = $kelas[0]; // Fetch the first result
        } else {
            return redirect()->route('kelas.index')->with('error', 'Data not found');
        }

        return view('kelas.edit', [
            'title' => 'Kelas',
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        DB::update('UPDATE kelas SET kode_mk = ?, kode_kelas = ? WHERE id = ?', [$data['kode_mk'], $data['kode_kelas'], $id]);
        return redirect('/kelas')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete('DELETE FROM kelas WHERE id = ?', [$id]);
        return redirect('/kelas')->with('success', 'Data has been deleted');
    }
}
