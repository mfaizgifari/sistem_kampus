<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "
            SELECT d.NIP, d.Nama, d.Gelar, GROUP_CONCAT(m.nama SEPARATOR ', ') AS matakuliah_names
            FROM dosen d
            LEFT JOIN dosen_matakuliah dm ON d.NIP = dm.dosen_id
            LEFT JOIN matakuliah m ON dm.matakuliah_id = m.kode
            GROUP BY d.NIP, d.Nama, d.Gelar
        ";

        $dosenData = DB::select($query);
        $dosen = [];
        foreach ($dosenData as $data) {
            $item = new \stdClass();
            $item->NIP = $data->NIP;
            $item->Nama = $data->Nama;
            $item->Gelar = $data->Gelar;
            $item->matakuliah = explode(', ', $data->matakuliah_names);
            $dosen[] = $item;
        }

        return view('dosen.index', [
            'title' => 'Dosen',
            'dosen' => $dosen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.create', [
            'title' => 'Dosen',
            'matakuliah' => Matakuliah::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $dosen = Dosen::create($data);
        $dosen->matakuliah()->sync($data['matakuliah_id']);

        return redirect('/dosen')->with('success', 'Data has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        $kode = array();
        foreach ($dosen->matakuliah as $item) {
            $kode[] = $item->kode;
        }
        return view('dosen.edit', [
            'title' => 'Dosen',
            'dosen' => $dosen,
            'matakuliah' => Matakuliah::whereNotIn('kode', $kode)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $dataDosen = $request->except(['_token', '_method', 'matakuliah_id']);
        $dataPivot = $request->all('NIP', 'matakuliah_id');
        Dosen::where('NIP', $dosen['NIP'])->update($dataDosen);
        $dosen->matakuliah()->attach($dataPivot['matakuliah_id']);
        return redirect('/dosen')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        Dosen::destroy($dosen['NIP']);
        return redirect('/dosen')->with('success', 'Data has been deleted');
    }
}
