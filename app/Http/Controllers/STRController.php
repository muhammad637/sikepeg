<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\STR;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Dotenv\Util\Str as UtilStr;
use App\Http\Controllers\Controller;

class STRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('str', function ($query) {
            $query->orderBy('masa_berakhir_str', 'desc');
        })->get();
        // $pegawai = pegawai::with('str')->get();
        // return $pegawai;
        return view('pages.str.index', [
            'pegawai' => $pegawai,
            'i' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = Pegawai::where('status_tenaga', 'asn')->where('jenis_tenaga', 'nakes')->get();
        return view('pages.str.create',[
            'results' => $results
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'no_str' => 'required',
            'tanggal_terbit_str' => 'required',
            'no_sertikom' => 'required',
            'kompetensi' => 'required',
            'masa_berakhir_str' => 'required',
            'link_str' => 'required',
        ]);

        $str = STR::create([
            'pegawai_id' => $request->asn_id,
            'no_str' => $request->no_str,
            'no_sertikom' => $request->no_sertikom,
            'kompetensi' => $request->kompetensi,
            'tanggal_terbit_str' => $request->tanggal_terbit_str,
            'masa_berakhir_str' => $request->masa_berakhir_str,
            'link_str' => $request->link_str
        ]);
        // return $str;
        return redirect(route('str.index'))->with('success', 'str berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function show(STR $str)
    {

        // return $str;
        return view('pages.str.show', [
            'str' => $str
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function edit(STR $str)
    {
        return view('pages.str.edit', [
            'str' => $str
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, STR $str)
    {
        //
        // return $request->all();
        try {
            //code...
            $validatedData = $request->validate([
                'no_str' => 'required',
                'kompetensi' => 'required',
                'no_sertikom' => 'required',
                'tanggal_terbit_str' => 'required',
                'masa_berakhir_str' => 'required',
                'link_str' => 'required',
            ]);
            $strUpdate = $str->update([
                'no_str' => $request->no_str,
                'kompetensi' => $request->kompetensi,
                'no_sertikom' => $request->no_sertikom,
                'tanggal_terbit_str' => $request->tanggal_terbit_str,
                'masa_berakhir_str' => $request->masa_berakhir_str,
                'link_str' => $request->link_str
            ]);
            // return $str;
            return redirect(route('str.index'))->with('success', 'str berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function destroy(STR $sTR)
    {
        //
    }

    // history
    public function history(Pegawai $pegawai)
    {
        return view('pages.str.history',[
            'pegawai' => $pegawai
        ]);
    }
}
