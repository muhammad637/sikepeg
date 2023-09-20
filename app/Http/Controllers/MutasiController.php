<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    //



    public function index(){
        return view('pages.mutasi.index');
    }
    public function create(){

        $pegawai = Pegawai::all();
        return view('pages.mutasi.create', ['pegawai' => $pegawai]);
    }

    public function store(Request $request){

        $validatedData= $request->validate(
            [
                'tanggal_berlaku' => 'required|date',
                'no_sk' => 'required',
                'tanggal_sk' => 'required|date',
                'upload_link' => 'required',
                'ruangan' => 'required',
                'jenis_mutasi' => 'required'
            ]
            );
        return redirect()->back()->with('success', 'data mutasi pegawai berhasil ditambahkan');
    }
    
}
