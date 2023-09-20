<?php

namespace App\Http\Controllers;

use App\Models\mutasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    //



    public function index(){
        $pegawai =  Pegawai::whereHas('mutasi', function($q){
            $q->orderBy('created_at','desc');
        })->get();
        // return $pegawai[0]->mutasi[count($pegawai[0]->mutasi)-1];
        return view('pages.mutasi.index',
        [
            'pegawai' => $pegawai,
            'i' => 0, 
        ]);
    }
    public function create(){

        $pegawai = Pegawai::all();
        return view('pages.mutasi.create', ['pegawai' => $pegawai]);
    }

    public function store(Request $request){
        try {
            $pegawai = Pegawai::find($request->pegawai_id);
            $validatedData='';
                if($request-> jenis_mutasi == 'internal'){
                   $pegawai->update(['ruangan' => $request->ruangan_tujuan]);
                   $validatedData =   $request->validate(
                    [
                        'pegawai_id' => '',
                        'tanggal_berlaku' => 'required|date',
                        'no_sk' => 'required',
                        'tanggal_sk' => 'required|date',
                        'link_sk' => 'required',
                        'ruangan_awal' => 'required',
                        'ruangan_awal' => 'required',
                    ]
                    );
                
                }
                else{
                    $pegawai->update(['status_pegawai' => 'nonaktif']);
                    $validatedData =   $request->validate(
                        [
                            'pegawai_id' => '',
                            'tanggal_berlaku' => 'required|date',
                            'no_sk' => 'required',
                            'tanggal_sk' => 'required|date',
                            'link_sk' => 'required',
                            'instansi_awal' => 'required',
                            'instansi_tujuan' => 'required'
                        ]
                        );
                }
               $mutasi = Mutasi::create(request()->all());
             
            return redirect()->back()->with('success', 'data mutasi pegawai berhasil ditambahkan');
    
            //code...
        } catch (\Throwable $th) {
        return $th->getMessage();            //throw $th;
        }
           }
    
}
