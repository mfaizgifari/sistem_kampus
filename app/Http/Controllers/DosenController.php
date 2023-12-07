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
        $dosen = DB::select('SELECT * FROM dosen');
        return view('dosen.create')->with('dosen', $dosen);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     $dosen = Dosen::create($data);
    //     $dosen->matakuliah()->sync($data['matakuliah_id']);

    //     return redirect('/dosen')->with('success', 'Data has been created');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'gelar' => 'required',
        ]);
        $nip = $request->kode;
        $nama = $request->nama;
        $gelar = $request->jumlah_sks;


        DB::insert(
            'INSERT INTO dosen (nip, nama, gelar) VALUES (?, ?, ?)',
            [$nip, $nama, $gelar]
        );

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
    // public function edit(Dosen $dosen)
    // {
    //     $kode = array();
    //     foreach ($dosen->matakuliah as $item) {
    //         $kode[] = $item->kode;
    //     }
    //     return view('dosen.edit', [
    //         'title' => 'Dosen',
    //         'dosen' => $dosen,
    //         'matakuliah' => Matakuliah::whereNotIn('kode', $kode)->get()
    //     ]);
    // }

    public function edit($nip)
    {
        $data = DB::select('
            SELECT nip, nama, gelar
            FROM dosen
            WHERE nip = ?
        ', [$nip]);

        if (!empty($data)) {
            $data = $data[0]; // Retrieve only the first row from the query result

            $matakuliah = DB::select('SELECT kode FROM matakuliah');
        } else {
            return redirect()->route('dosen.index')->with('error', 'Data not found');
        }

        return view('dosen.edit', compact('data', 'matakuliah')); // Pass both data and matakuliah to the view
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Dosen $dosen)
    // {
    //     $dataDosen = $request->except(['_token', '_method', 'matakuliah_id']);
    //     $dataPivot = $request->all('NIP', 'matakuliah_id');
    //     Dosen::where('NIP', $dosen['NIP'])->update($dataDosen);
    //     $dosen->matakuliah()->attach($dataPivot['matakuliah_id']);
    //     return redirect('/dosen')->with('success', 'Data has been updated');
    // }

    // public function update($nip, Request $request)
    // {
    //     $request->validate([
    //         'nip' => 'required',
    //         'nama' => 'required',
    //         'gelar' => 'required',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $dosen = Dosen::where('nip', $nip)->firstOrFail();
    //         DB::update(
    //             'UPDATE dosen SET nip = :nip, nama = :nama, gelar = :gelar WHERE nip = :id',
    //             [
    //                 'nip' => $request->nip,
    //                 'nama' => $request->nama,
    //                 'gelar' => $request->gelar,
    //                 'id' => $nip,

    //             ]
    //         );
    //         $dosen = Dosen::where('nip', $request->nip)->firstOrFail();
    //         $matakuliah_id = $request->input('matakuliah_id', []);
    //         $dosen->matakuliah()->sync($matakuliah_id);

    //         DB::commit(); // Commit the transaction if both updates succeed
    //         return redirect()->route('dosen.index')->with('success', 'Data Dosen has been updated');
    //     } catch (\Exception $e) {
    //         DB::rollback(); // Rollback if an error occurs
    //         return redirect()->back()->with('error', 'Failed to update data');
    //     }
    // }
    public function update($nip, Request $request)
    {

        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'gelar' => 'required',
            'matakuliah_id' => 'array',
        ]);

        DB::beginTransaction();

        try {
            DB::update(
                'UPDATE dosen SET nip = :nip, nama = :nama, gelar = :gelar, matakuliah_id = matakuliah_id WHERE nip = :id',
                [
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                    'gelar' => $request->gelar,
                    'matakuliah_id' => $request->matakuliah_id,
                    'id' => $nip,
                ]
            );

            DB::table('dosen_matakuliah')->where('dosen_id', $nip)->delete(); // Remove existing relationships

            $matakuliah_ids = $request->input('matakuliah_id', []);
            foreach ($matakuliah_ids as $matakuliah) {
                DB::table('dosen_matakuliah')->insert([
                    'dosen_id' => $nip,
                    'matakuliah_id' => $matakuliah,
                ]);
            }

            DB::commit();
            return redirect()->route('dosen.index')->with('success', 'Data Dosen has been updated');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update data');
        }
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
