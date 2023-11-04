<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Diklat;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiklatController extends Controller
{
    //
    public function index(){
        $pegawai = Pegawai::where('status_tenaga', 'asn')->with(['diklat' => function ($query) {
            $query;
        }])->get();
        return view('pages.diklat.index', ['pegawai' => $pegawai, 'i' => 0]);
    }

    public function create(){
        $pegawai = Pegawai::where('status_tenaga','asn')->get();
        return view('pages.diklat.create', ['pegawai' => $pegawai]);
    }
    public function edit(Diklat $diklat){
        return view('pages.diklat.edit', [
            'results' => Pegawai::all(),
            'diklat' => $diklat,
            
        ]);
    }

    public function update(Request $request, Diklat $diklat){
        try {

            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'no_sertifikat' => 'required',
                'tanggal_sertifikat' => 'required',
                'link_sertifikat' => 'required'
            ]);
            
            $diklat->update([
                'pegawai_id' => $request->pegawai_id,
                'nama_diklat' => $request->nama_diklat,
                'jumlah_jam' => $request->jumlah_jam,
                'penyelenggara' => $request->penyelenggara,
                'tempat' => $request->tempat,
                'tahun' => $request->tahun,
                'no_sertifikat' => $request->no_sertifikat,
                'tanggal_sertifikat' => $request->tanggal_sertifikat,
                'link_sertifikat' => $request->link_sertifikat
            ]);
            $notif = Notifikasi::notif('diklat', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);
            alert()->success('berhasil', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name);
            return redirect(route('admin.diklat.index'))->with('success', 'diklat berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function riwayat(Pegawai $pegawai)
    {
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc')->get();
        return view('pages.diklat.riwayat', [
            'pegawai' => $pegawai,
            'diklat' => $diklat
        ]);
    }
    public function store(Request $request){
        // try {
            //code...
            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required|integer',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'no_sertifikat' => 'required',
                'tanggal_sertifikat' => 'required|date',
                'link_sertifikat' => 'required'
            ]);
            $diklat = Diklat::create([
                'pegawai_id' => $request->pegawai_id,
                'nama_diklat' => $request->nama_diklat,
                'jumlah_jam' => $request->jumlah_jam,
                'penyelenggara' => $request->penyelenggara,
                'tempat' => $request->tempat,
                'tahun' => $request->tahun,
                'no_sertifikat' => $request->no_sertifikat,
                'tanggal_sertifikat' => $request->tanggal_sertifikat,
                'link_sertifikat' => $request->link_sertifikat
            ]);
        $notif = Notifikasi::notif('diklat', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($diklat->pegawai->id);
        alert()->success('berhasil', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name);
        return redirect()->route('admin.diklat.index')->with('success', 'diklat berhasil ditambahkan');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return $th->getMessage();
        // }
    }
}
