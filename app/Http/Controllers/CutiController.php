<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $pegawai = Pegawai::with(['cuti' => function ($q) {
        //     $q->where('status', 'aktif');
        // }])->whereHas('cuti')->get();
        $cuti = Cuti::where('status', 'aktif')->get();
        return view('pages.cuti.index', [
            // 'pegawai' => $pegawai,
            'cuti' => $cuti,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            //code...
            $validatedData = $request->validate([
                'jenis_cuti' => 'required',
                'alasan_cuti' => 'required',
                'mulai_cuti' => 'required',
                'selesai_cuti' => 'required',
                'jumlah_hari' => 'required',
                'link_cuti' => 'required',
            ]);
            $cuti = Cuti::where('pegawai_id', $request->pegawai_id)->orderBy('selesai_cuti', 'desc')->first();
            if ($cuti) {
                if ($cuti->selesai_cuti >= $request->selesai_cuti) {
                    return redirect()->back()->with('error', 'periode cuti masuh berlaku');
                }
            }
            if ($request->jenis_cuti == 'cuti tahunan') {
                if ($cuti->pegawai->sisa_cuti_tahunan >= $request->jumlah_hari) {
                    $cuti->pegawai->update(
                        [
                            'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan - $request->jumlah_hari
                        ]
                    );
                } else {
                    return redirect()->back()->with('error', 'cuti tahunan pegawai' . $cuti->pegawai->nama_lengkap ?? $cuti->pegawai->nama_depan . 'telah habis pada tahun ini');
                }
            }
            if ($request->jenis_cuti == 'cuti besar') {
                if ($cuti->pegawai->sisa_cuti_tahunan  == 0) {
                    return redirect()->back()->with('error', 'cuti tahunan pegawai' . $cuti->pegawai->nama_lengkap ?? $cuti->pegawai->nama_depan . 'telah habis pada tahun ini');
                } else {
                    $cuti->pegawai->update(
                        [
                            'sisa_cuti_tahunan' => 0
                        ]
                    );
                }
            }
            $create = Cuti::create(array_merge(['status' => 'aktif'], $request->all()));
            return redirect(route('data-cuti-aktif.index'))->with('success', 'data cuti berhasi ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti)
    {
        //
        return view('pages.cuti.show', [
            'cuti' => $cuti
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        //
        // return $cuti;
        return view('pages.cuti.edit', [
            'pegawai' => Pegawai::all(),
            'cuti' => $cuti
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        //
        $validatedData = $request->validate([
            'jenis_cuti' => 'required',
            'alasan_cuti' => 'required',
            'mulai_cuti' => 'required',
            'selesai_cuti' => 'required',
            'jumlah_hari' => 'required',
            'link_cuti' => 'required',
        ]);
        $cuti->pegawai->update([
            'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan + $cuti->jumlah_hari
        ]);
        // if($cuti->pegawai_id != $request->pegawai_id){
        // }
        if ($request->jenis_cuti == 'cuti tahunan') {
            if ($cuti->pegawai->sisa_cuti_tahunan >= $request->jumlah_hari) {
                $cuti->pegawai->update(
                    [
                        'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan - $request->jumlah_hari
                    ]
                );
            } else {
                return redirect()->back()->with('error', 'cuti tahunan pegawai' . $cuti->pegawai->nama_lengkap ?? $cuti->pegawai->nama_depan . 'telah habis pada tahun ini');
            }
        }
        if ($request->jenis_cuti == 'cuti besar') {
            if ($cuti->pegawai->sisa_cuti_tahunan  == 0) {
                return redirect()->back()->with('error', 'cuti tahunan pegawai' . $cuti->pegawai->nama_lengkap ?? $cuti->pegawai->nama_depan . 'telah habis pada tahun ini');
            } else {
                $cuti->pegawai->update(
                    [
                        'sisa_cuti_tahunan' => 0
                    ]
                );
            }
        }
        $cuti->update($request->all());
        return redirect(route('data-cuti-aktif.index'))->with('success', 'data cuti berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        //
    }
}
