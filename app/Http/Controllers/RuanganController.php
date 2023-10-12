<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuanganController extends Controller
{
    //
    public function index(){
        return view('pages.master_data.ruangan.index',[
            'ruangan' => Ruangan::orderBy('nama_ruangan', 'desc')->get()
        ]);
    }
    public function create(){
        return view('pages.master_data.ruangan.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate(
            [
                'nama_ruangan' => 'required',
            ]
        );
        // return $validatedData;
        Ruangan::create($validatedData);
        return redirect(route('ruangan.index'))->with('success','data berhasil ditambahkan');
    }
    public function show(Ruangan $ruangan){
        
    }
    public function edit(Ruangan $ruangan){
        return view('pages.master_data.ruangan.edit',[
            'ruangan' => $ruangan
        ]);
    }
    public function update(Request $request,Ruangan $ruangan){
        $validatedData = $request->validate([
            'nama_ruangan' => 'required',
        ]);
        // return $validatedData;
        $ruangan->update($validatedData);
        return redirect(route('ruangan.index'))->with('success', 'data berhasil diupdate');
    }
    public function destroy(Ruangan $ruangan){
        $ruangan->delete();
        return redirect(route('ruangan.index'))->with('success', 'data berhasil dihapus');
    }
}
