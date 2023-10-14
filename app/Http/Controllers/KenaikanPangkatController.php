<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Golongan;
use Illuminate\Http\Request;
use App\Models\KenaikanPangkat;
use App\Http\Controllers\Controller;

class KenaikanPangkatController extends Controller
{
    public function index()
    {
        $kenaikanpangkat = KenaikanPangkat::orderBy('tanggal_sk', 'desc')->with('pegawai')->get();
        // return $kenaikanpangkat;
        $pegawai = Pegawai::where('status_tenaga', 'asn')->with(['kenaikanpangkat' => function ($q) {
            $q->orderBy('tanggal_sk', 'desc');
        }])->get();
        // return $pegawai[0]->kenaikanpangkat[0];
        return view(
            'pages.kenaikan_pangkat.index',
            [

                'pegawai' => $pegawai,
                'KenaikanPangkat' => $kenaikanpangkat,
                'i' => 0,
            ]
        );
    }


    public function create()
    {
        $pegawai = Pegawai::where('status_tenaga', 'asn')->get();
        return view('pages.kenaikan_pangkat.create', ['pegawai' => $pegawai,]);
    }


    public function store(Request $request)
    {

        // try {
        //code...
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            return 'pegawai tidak ada';
        }
        $pangkat_id = $request->pangkat_id;
        if ($request->pangkat_id == 'lainnya') {
            $request->validate([
                'nama_pangkat' => 'required|unique:pangkats,nama_pangkat'
            ],[
                'nama_pangkat.unique' => 'nama pangkat sudah ada' 
            ]);
            $pangkat = Pangkat::create([
                'nama_pangkat' => $request->nama_pangkat
            ]);
            $pangkat_id = $pangkat->id;
        }
        $golongan_id = $request->golongan_id;
        if ($request->golongan_id == 'lainnya') {
            $request->validate([
                'nama_golongan' => 'required|unique:golongans,nama_golongan'
            ],[
                'nama_golongan.unique' => 'nama golongan sudah ada' 
            ]);
            $golongan = Golongan::create([
                'nama_golongan' => $request->nama_golongan,
                'jenis' => $pegawai->status_tipe
            ]);
            $golongan_id = $golongan->id;
        }
        $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('d-m-y') >= Carbon::parse($pegawai->tmt_pangkat_terakhir)->format('d-m-y');
        if ($pegawai->status_tipe == 'pppk' && $tmt_pangkat) {
            $pegawai->update([
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                'golongan_id' => $golongan_id,
                'jabatan' => $request->jabatan
            ]);
        } elseif ($pegawai->status_tipe == 'pns' && $tmt_pangkat) {
            $pegawai->update([
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                'golongan_id' => $golongan_id,
                'pangkat_id' => $pangkat_id,
                'jabatan' => $request->jabatan
            ]);
        }
        // return $pegawai->jabatan;

        $validatedData = $request->validate(
            [
                'pegawai_id' => '',
                'jabatan' => 'required',
                'tmt_pangkat_dari' => 'required|date',
                'tmt_pangkat_sampai' => 'required|date',
                'no_sk' => 'required',
                'tanggal_sk' => 'required',
                'penerbit_sk' => 'required'

            ]
        );
        $kenaikanpangkat = KenaikanPangkat::create(
            [
                'pegawai_id' => $request->pegawai_id,
                'pangkat_id' => $pangkat_id ?? null,
                'golongan_id' => $golongan_id,
                'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
                'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'penerbit_sk' => $request->penerbit_sk,
                'link_sk' => $request->link_sk
            ]
        );

        return redirect()->route('admin.kenaikan-pangkat.index')->with('success', 'data kenaikan pangkat pegawai berhasil ditambahkan');
        // } catch (\Throwable $th) {

        //     return $th->getMessage();
        //     //throw $th;
        // }
    }
    public function edit(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.edit', [
            'kenaikan_pangkat' => $kenaikan_pangkat,
            'pegawai' => Pegawai::all(),
        ]);
    }

    public function show(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.show', [
            'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }
    public function update(Request $request, KenaikanPangkat $kenaikan_pangkat)
    {
        try {
            // return request()->all();
            $validatedData = $request->validate([
                'pegawai_id' => '',
                'jabatan' => 'required',
                'tmt_pangkat_dari' => 'required',
                'tmt_pangkat_sampai' => 'required',
                'no_sk' => 'required',
                'tanggal_sk' => 'required',
                'penerbit_sk' => 'required',
                'link_sk' => 'required'
            ]);
            if ($kenaikan_pangkat->pegawai->status_tipe == 'pns') {
                $request->validate([
                    'pangkat_id' => 'required',
                    'golongan_id' => 'required'
                ], [
                    'pangkat_id.required' => 'pangkat id masih kosong',
                    'golongan_id.required' => 'golongan id masih kosong',
                ]);
            }elseif($kenaikan_pangkat->pegawai->status_tipe == 'pppk'){
                $request->validate([
                    'golongan_id' => 'required',
                ],[
                    'golongan_id.required' => 'golongan id masih kosong',
                ]);
            }
            $pangkat_id = $request->pangkat_id;
            if($request->pangkat_id == 'lainnya'){
                $request->validate([
                    'nama_pangkat' => 'required|unique:pangkats,nama_pangkat'
                ],[
                    'nama_pangkat.unique' => 'nama pangkat sudah ada' 
                ]);
                $pangkat = Pangkat::create([
                    'nama_pangkat' => strtolower($request->nama_pangkat),
                ]);
                $pangkat_id = $pangkat->id;
            }
            $golongan_id = $request->golongan_id;
            if($request->golongan_id == 'lainnya'){
                $request->validate([
                    'nama_golongan' => 'required|unique:golongans,nama_golongan'
                ], [
                    'nama_golongan.unique' => 'nama golongan sudah ada'
                ]);
                $golongan = Golongan::create([
                    'nama_golongan' => strtolower($request->nama_golongan),
                    'jenis' => $kenaikan_pangkat->pegawai->status_tipe
                ]);
                $golongan_id = $golongan->id;
            }
            $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('d-m-y') >= Carbon::parse($kenaikan_pangkat->pegawai->tmt_pangkat_terakhir)->format('d-m-y');
            if ($kenaikan_pangkat->pegawai->status_tipe == 'pppk' && $tmt_pangkat) {
                $kenaikan_pangkat->pegawai->update([
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                    'golongan_id' => $golongan_id,
                    'jabatan' => $request->jabatan
                ]);
            } elseif ($kenaikan_pangkat->pegawai->status_tipe == 'pns' && $tmt_pangkat) {
                $kenaikan_pangkat->pegawai->update([
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                    'golongan_id' => $golongan_id,
                    'pangkat_id' => $pangkat_id,
                    'jabatan' => $request->jabatan
                ]);
            }
            $kenaikan_pangkat->update([
                'pegawai' => $request->pegawai_id,
                'pangkat_id' => $pangkat_id ?? null,
                'golongan_id' => $golongan_id,
                'jabatan' => $request->jabatan,
                'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
                'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'penerbit_sk' => $request->penerbit_sk,
                'link_sk' => $request->link_sk
            ]);
            return redirect()->route('admin.kenaikan-pangkat.index')->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }


    public function riwayat(Pegawai $pegawai, KenaikanPangkat $kenaikan_pangkat)
    {
        $kenaikan_pangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.kenaikan_pangkat.riwayat', [
            'pegawai' => $pegawai,
            'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }
    //
}
