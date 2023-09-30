<?php

namespace App\Http\Controllers;

use App\Models\KenaikanPangkat;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class KenaikanPangkatController extends Controller
{

    public function index(){

        $kenaikanpangkat = KenaikanPangkat::orderBy('tanggal_sk', 'desc')->with('pegawai')->get();
        // return $kenaikanpangkat;
        $pegawai = Pegawai::with(['KenaikanPangkat' => function ($q) {
            $q->orderBy('tanggal_sk', 'desc');
        }])->whereHas('KenaikanPangkat')->get();
        // return $pegawai;
        return view(
            'pages.kenaikan_pangkat.index',
            [
               
                'pegawai' => $pegawai,
                'KenaikanPangkat' => $kenaikanpangkat,
                'i' =>0,
            ]
            );
    }


    public function create(){
        $pegawai = Pegawai::where('status_tenaga','asn')->get();
        return view('pages.kenaikan_pangkat.create', ['pegawai' => $pegawai]);

    }


    public function store(Request $request){

        try {
            //code...
            $pegawai = Pegawai::find($request->pegawai_id);
            $pegawai->update([
                'pangkat_golongan' => $request->pangkat. ' ' . $request->golongan,
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_sampai
                
            ]);
            $validatedData = $request->validate(
                [
                    'pegawai_id' => '',
                    'jenis_pangkat' => 'required',
                    'pangkat' => 'required',
                    'golongan' => 'required',
                    'tmt_pangkat_dari' => 'required|date',
                    'tmt_pangkat_sampai' => 'required|date' ,
                    'no_sk' => 'required',
                    'tanggal_sk' => 'required'

                ]
                );

                $kenaikanpangkat = KenaikanPangkat::create(request()->all());
                return redirect(route('kenaikan_pangkat.index'))->with('success', 'data kenaikan pangkat pegawai berhasil ditambahkan');




        } catch (\Throwable $th) {

            return $th->getMessage();
            //throw $th;
        }
        





    }


    public function edit(KenaikanPangkat $kenaikan_pangkat){

        return view('pages.kenaikan_pangkat.edit', [
            'kenaikan_pangkat' => $kenaikan_pangkat,
            'pegawai' => Pegawai::all(),
        ]);
    }

    public function show(KenaikanPangkat $kenaikanpangkat){
        return view('pages.kenaikan_pangkat.show', [
            'kenaikan_pangkat' => $kenaikanpangkat
        ]);
    }
    // public function update(Request $request, KenaikanPangkat $kenaikanPangkat){

    //     try {
    //         //code...
    //         $pegawai = Pegawai::find($request->pegawai_id);
            
    //         $kenaikanpangkat = KenaikanPangkat::where('pegawai_id', $pegawai->status_tenaga == 'asn')->orderBy('tanggal_sk', 'desc')->get();

    //         $pegawai->update([
    //             'pangkat' => $request->pangkat,
    //             'golongan' => $request->golongan,
    //         ]);
    //         $validatedData = $request->validate(
    //             [
    //                 'pegawai_id' => '',
    //                 'jenis_pangkat' => 'required',
    //                 'tmt_pangkat_dari' => 'required|date',
    //                 'tmt_pangkat_sampai' => 'required|date' ,
    //                 'no_sk' => 'required',
    //                 'tanggal_sk' => 'required'

    //             ]
    //             );
    //         $kenaikanpangkat->update([
    //             'jenis_pangkat' => $request->jenis_pangkat,
    //             'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
    //             'tmt_pangkat_sampai' => $request->tmpt_pangkat_sampai,
    //             'no_sk' => $request->no_sk,
    //             'tanggal_sk' => $request->tanggal_sk
    //         ]);

               
    //             return redirect(route('kenaikan_pangkat.index'))->with('success', 'data kenaikan pangkat pegawai berhasil diupdate');




    //     } catch (\Throwable $th) {

    //         return $th->getMessage();
    //         //throw $th;
    //     }
        





    // }

    

    public function update(Request $request, KenaikanPangkat $kenaikan_pangkat){
        try {
            // return request()->all();
            $validatedData = $request->validate([
                'pegawai_id' => '',
                'pangkat' => 'required',
                'golongan' => 'required',
                'jenis_pangkat' => 'required',
                'tmt_pangkat_dari' => 'required',
                'tmt_pangkat_sampai' => 'required',
                'no_sk' => 'required',
                'tanggal_sk' => 'required',
                'penerbit_sk' => 'required',
                'link_sk' => 'required'
            ]);
            $kenaikan_pangkat->pegawai->update([
                'pangkat_golongan' => $request->pangkat. ' ' . $request->golongan,
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari
                
            ]);
            $kenaikan_pangkat->update([
                'pegawai' => $request->pegawai_id,
                'pangkat' => $request->pangkat,
                'golongan' => $request->golongan,
                'jenis_pangkat' => $request->jenis_pangkat,
                'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
                'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'penerbit_sk' => $request->penerbit_sk,
                'link_sk' => $request->link_sk
            ]);

            return redirect(route('kenaikan_pangkat.index'))->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
            //code...
        } catch (\Throwable $th) {
            //throw $th;

            return $th->getMessage();
        }
    }


    public function riwayat(Pegawai $pegawai, KenaikanPangkat $kenaikan_pangkat){
        $kenaikan_pangkat = KenaikanPangkat::where('pegawai_id' , $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.kenaikan_pangkat.riwayat', [
            'pegawai' => $pegawai,
            'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }
    //
}
