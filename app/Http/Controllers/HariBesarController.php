<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\HariBesar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HariBesarController extends Controller
{
    //
    public function index(){
        return view('pages.master_data.hari_besar.index',[
            'hariBesar' => HariBesar::orderBy('tanggal', 'desc')->get()
        ]);
    }
    public function create(){
        return view('pages.master_data.hari_besar.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);
        // return $validatedData;
        HariBesar::create($validatedData);
        return redirect(route('hariBesar.index'))->with('success','data berhasil ditambahkan');
    }
    public function show(HariBesar $hariBesar){
        
    }
    public function edit(HariBesar $hariBesar){
        return view('pages.master_data.hari_besar.edit',[
            'hariBesar' => $hariBesar
        ]);
    }
    public function update(Request $request,HariBesar $hariBesar){
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);
        // return $validatedData;
        $hariBesar->update($validatedData);
        return redirect(route('hariBesar.index'))->with('success', 'data berhasil diupdate');
    }
    public function destroy(HariBesar $hariBesar){
        $hariBesar->delete();
        return redirect(route('hariBesar.index'))->with('success', 'data berhasil dihapus');
    }
}
