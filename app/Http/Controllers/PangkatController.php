<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master_data.pangkat.index',[
            'pangkat' => Pangkat::orderBy('nama_pangkat', 'desc')->get()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master_data.pangkat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_pangkat' => 'required',
            ]
        );
        // return $validatedData;
        Pangkat::create($validatedData);
        return redirect(route('pangkat.index'))->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function show(Pangkat $pangkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(Pangkat $pangkat)
    {
        return view('pages.master_data.pangkat.edit',[
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pangkat $pangkat)
    {
        $validatedData = $request->validate([
            'nama_pangkat' => 'required',
        ]);
        // return $validatedData;
        $pangkat->update($validatedData);
        return redirect(route('pangkat.index'))->with('success', 'data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pangkat $pangkat)
    {
        $pangkat->delete();
        return redirect(route('pangkat.index'))->with('success', 'data berhasil dihapus');
    }
}
