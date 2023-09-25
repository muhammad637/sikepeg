<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SIPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('sip', function ($query) {
            $query->orderBy('masa_berakhir_sip', 'desc');
        })->get();
        return view('pages.sip.index', [
            'pegawai' => $pegawai ?? [],
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
        return view('pages.sip.create',[
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
        try {
            //code...
            $validatedData = $request->validate([
                'no_str' => 'required',
                'no_sip' => 'required',
                'tanggal_terbit_sip' => 'required',
                'no_rekom' => 'required',
                'masa_berakhir_sip' => 'required',
                'link_sip' => 'required',
            ]);

            $sip = SIP::create([
                'pegawai_id' => $request->pegawai_id,
                'no_sip' => $request->no_sip,
                'no_str' => $request->no_str,
                'no_rekom' => $request->no_rekom,
                'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
                'masa_berakhir_sip' => $request->masa_berakhir_sip,
                'link_sip' => $request->link_sip
            ]);
            return redirect(route('sip.index'))->with('success', 'str berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SIP  $sIP
     * @return \Illuminate\Http\Response
     */
    public function show(SIP $sip)
    {
        //
        // return $str;
        return view('pages.sip.show', [
            'sip' => $sip
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SIP  $sIP
     * @return \Illuminate\Http\Response
     */
    public function edit(SIP $sip)
    {
        //
        return view('pages.sip.edit', [
            'sip' => $sip
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SIP  $sIP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SIP $sip)
    {
        //
        
        $validatedData = $request->validate([
            'no_str' => 'required',
            'no_sip' => 'required',
            'no_rekom' => 'required',
            'tanggal_terbit_sip' => 'required',
            'masa_berakhir_sip' => 'required',
            'link_sip' => 'required',
        ]);
        $sipCreate = $sip->update([
            'no_sip' => $request->no_sip,
            'no_rekom' => $request->no_rekom,
            'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
            'masa_berakhir_sip' => $request->masa_berakhir_sip,
            'link_sip' => $request->link_sip
        ]);
        // return $str;
        return redirect(route('sip.index'))->with('success', 'str berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SIP  $sIP
     * @return \Illuminate\Http\Response
     */
    public function destroy(SIP $sip)
    {
        //
    }
    public function history(Pegawai $pegawai)
    {
       $sip = SIP::where('pegawai_id', $pegawai->id)->orderBy('masa_berakhir_sip', 'desc')->get();
       
        return view('pages.sip.history', [
            'sip' => $sip
        ]);
    }
}
