<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master_data.golongan.index',[
            'golongan' => Golongan::orderBy('nama_golongan', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master_data.golongan.create');
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
                'nama_golongan' => 'required',
                'jenis' => 'required'
            ]
        );
        // return $validatedData;
        Golongan::create($validatedData);
        return redirect(route('golongan.index'))->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function show(Golongan $golongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function edit(Golongan $golongan)
    {
        return view('pages.master_data.golongan.edit',[
            'golongan' => $golongan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Golongan $golongan)
    {
        $validatedData = $request->validate([
            'nama_golongan' => 'required',
            'jenis' => 'required'
        ]);
        // return $validatedData;
        $golongan->update($validatedData);
        return redirect(route('golongan.index'))->with('success', 'data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Golongan $golongan)
    {
        $golongan->delete();
        return redirect(route('golongan.index'))->with('success', 'data berhasil dihapus');
    }
}
