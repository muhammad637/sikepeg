<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Demosiindex()
    {
        return view('pages.jabatan.demosi.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Demosicreate()
    {

        $pegawai = Pegawai::all();
        return view('pages.jabatan.demosi.create', ['pegawai'=> $pegawai]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate(
            [
                'pegawai_id',
                'jabatan_sebelumnya' => 'required',
                'jabatan_selanjutnya' => 'required',
                'tanggal_berlaku' => 'required',
                'no_sk' => 'required',
                'tanggal_sk' => 'required|date',
                'link_sk' => 'required',
                'type' => 'required'
            ]
            );
            $jabatan = Jabatan::create([
                'pegawai' => $request->pegawai_id,
                'jabatan_sebelumnya' => $request->jabatan_sebelumnya,
                'jabatan_selanjutnya' => $request->jabatan_selanjutnya,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'link_sk' => $request->link_sk
            ]);
            $pegawai = Pegawai::find($request->pegawai_id);
            $pegawai->update(['jabatan' => $request->jabatan_selanjutnya]);
            $validatedData = $request->validate(
                [
                    'pegawai_id' => '',
                    'jabatan_sebelumnya' => 'required',
                    'jabatan_selanjutnya' => 'required',
                    'tanggal_sk' => 'required|date',
                    'link_sk' => 'required',
                    'type' => 'required'
                ]
                );
                $jabatan = Jabatan::create(request()->all());
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('pages.jabatan.demosi.edit');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }
}
