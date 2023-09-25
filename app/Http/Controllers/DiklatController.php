<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DiklatController extends Controller
{
    //
    public function index(){
        $pegawai = Pegawai::where('status_tenaga', 'asn')->with(['diklat' => function ($query) {
            $query->orderBy('tanggal_sttpp', 'desc');
        }])->get();
        // return $pegawai;
        // $pegawai = Pegawai::where('jenis_tenaga', 'umum')->with('diklat', function ($query) {
        //     $query->orderBy('created_at', 'desc');
        // })->get();
        return view('pages.diklat.index', ['pegawai' => $pegawai]);
    }

    public function create(){

        $pegawai = Pegawai::all();
        return view('pages.diklat.create', ['pegawai' => $pegawai]);
    }
    public function edit(Diklat $diklat){
        // $pegawai = Pegawai::where('status_tenaga', 'asn')->with(['diklat' => function ($query) {
        //     $query->orderBy('created_at', 'desc');
        // }])->get();
        return view('pages.diklat.edit', [
            'diklat' => $diklat
        ]);
    }

    public function update(Request $request, Diklat $diklat){
        try {
            // return request()->all();
            //code...
            // $pegawai = Pegawai::find($diklat->pegawai_id);
            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'no_sttpp' => 'required',
                'tanggal_sttpp' => 'required',
                'link_sttpp' => 'required'
            ]);


            $diklat->update([
                'nama_diklat' => $request->nama_diklat,
                'jumlah_jam' => $request->jumlah_jam,
                'penyelenggara' => $request->penyelenggara,
                'tempat' => $request->tempat,
                'tahun' => $request->tahun,
                'no_sttpp' => $request->no_sttpp,
                'tanggal_sttpp' => $request->tanggal_sttpp,
                'link_sttpp' => $request->link_sttpp
            ]);
            return redirect(route('diklat.index'))->with('success', 'diklat berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function riwayat(Pegawai $pegawai)
    {
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sttpp', 'desc')->get();
        return view('pages.diklat.riwayat', [
            'pegawai' => $pegawai,
            'diklat' => $diklat
        ]);
    }







    public function store(Request $request){
        try {
            //code...
            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'no_sttpp' => 'required',
                'tanggal_sttpp' => 'required|date',
                'link_sttpp' => 'required'
            ]);


            $diklat = Diklat::create([
                'pegawai_id' => $request->pegawai_id,
                'nama_diklat' => $request->nama_diklat,
                'jumlah_jam' => $request->jumlah_jam,
                'penyelenggara' => $request->penyelenggara,
                'tempat' => $request->tempat,
                'tahun' => $request->tahun,
                'no_sttpp' => $request->no_sttpp,
                'tanggal_sttpp' => $request->tanggal_sttpp,
                'link_sttpp' => $request->link_sttpp
            ]);
            return redirect(route('diklat.index'))->with('success', 'diklat berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
