<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asn;
use App\Models\SIP;
use App\Models\STR;
use App\Models\NonAsn;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\UmumStruktural;
use Illuminate\Routing\Controller;


class PegawaiController extends Controller
{

    private $rulesPegawai = [
        'nik' => 'required|unique:pegawais,nik,',
        'gelar_depan'  => '',
        'gelar_belakang'  => '',
        'nama_depan' => 'required',
        'nama_belakang' => '',
        'jenis_kelamin' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'usia' => 'required',
        'alamat' => 'required',
        'agama' => 'required',
        'no_wa' => 'required',
        'status_pegawai' => 'required',
        'ruangan' => 'required',
        'tahun_pensiun' => 'required',
        'status_tenaga' => 'required',
        'pendidikan_terakhir' => 'required',
        'tanggal_lulus' => 'required',
        'no_ijazah' => 'required',
        'jabatan_fungsional' => 'required'
    ];
    private $rulesNonAsn = [
        'nippk' => 'required',
        'tanggal_masuk' => 'required',
        'niPtt_pkThl' => 'required'
    ];
    private $rulesAsn = [
        'nip' =>  'required',
        'sekolah' => 'required',
        'tmt_cpns' => 'required',
        'tmt_pns' => 'required',
        'tmt_pangkat_terakhir' => 'required',
        'pangkat_golongan' => 'required',
        'jenis_tenaga_struktural' => 'required',
        'jabatan_struktural' => 'required'
    ];
    private $rulesStr = [
        'no_str' => 'required',
        'tanggal_terbit_str' => 'required',
        'masa_berlaku_str' => 'required',
        'link_str' => 'required'
    ];
    private $rulesSip = [
        'no_sip' => 'required',
        'tanggal_terbit_sip' => 'required',
        'masa_berlaku_sip' => 'required',
        'link_sip' => 'required'
    ];
    private $rulesUmum = [
        // 'masa_kerja' => 'required',
        'no_karpeg' => 'required',
        'no_taspen' => 'required',
        'no_npwp' => 'required',
        'no_hp' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Pegawai::with(['asn', 'non_asn'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validatedData = $request->validate($this->rulesPegawai);
        Pegawai::create($validatedData);
        $pegawai = Pegawai::where('nik', $request->nik)->first();
        // jika st = non_asn
        if ($request->status_tenaga == 'non_asn') {
            $request->masa_kerja != null ? $pegawai->update(['masa_kerja' => intval($request->masa_kerja)]) : null;
            $request->cuti_tahunan != null ? $pegawai->update(['cuti_tahunan' => intval($request->cuti_tahunan)]) : null;
            $pegawai->update(['sisa_cuti_tahunan' => $pegawai->cuti_tahunan]);
            // $masa_kerja = 
            $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
            $non_asn =  NonAsn::create(array_merge(['pegawai_id' => $pegawai->id], $validatedDataNonAsn));
            // jika masa_kerja non asn null
            if ($pegawai->masa_kerja == null) {
                $tanggal_masuk = intval(Carbon::parse($non_asn->tanggal_masuk)->format('Y'));
                $tahun_pensiun = intval(Carbon::parse($pegawai->tahun_pensiun)->format('Y'));
                $masa_kerja = $tahun_pensiun - $tanggal_masuk;
                $pegawai->update(['masa_kerja' => $masa_kerja]);
            }
            return $pegawai;
        }
        $validatedDataAsn = $request->validate($this->rulesAsn);
        Asn::create(array_merge(['pegawai_id' => $pegawai->id], $validatedDataAsn));
        $asn = Asn::where('pegawai_id', $pegawai->id)->first();
        $masa_kerja =  $pegawai->tahun_pensiun - Carbon::parse($asn->tmt_pns)->format('Y');
        // return $pegawai->cuti_tahunan;
        $pegawai->update([
            'sisa_cuti_tahunan' => $pegawai->cuti_tahunan,
            'masa_kerja' => $masa_kerja
        ]);
        if ($request->jenis_tenaga_struktural == 'nakes') {
            if ($request->no_str != null && $request->tanggal_terbit_str != null && $request->masa_berlaku_str != null && $request->link_str != null) {
                # code...
                $validatedDataStr = $request->validate($this->rulesStr);
                $createSTR = array_merge(['asn_id' => $asn->id], $validatedDataStr);
                STR::create($createSTR);
            }
            if ($request->no_sip != null && $request->tanggal_terbit_sip != null && $request->masa_berlaku_sip != null && $request->link_sip != null) {
                $validatedDataSip = $request->validate($this->rulesSip);
                $createSIP = array_merge(['asn_id' => $asn->id], $validatedDataSip);
                SIP::create($createSIP);
            }
            return $pegawai;
        } else if ($request->jenis_tenaga_struktural == 'umum') {
            $validatedDataUmum = $request->validate($this->rulesUmum);
            $createUmum = array_merge(['asn_id' => $asn->id], $validatedDataUmum);
            UmumStruktural::create($createUmum);
            return $pegawai;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:pegawais,nik,' . $pegawai->id,
            'gelar_depan'  => '',
            'gelar_belakang'  => '',
            'nama_depan' => 'required',
            'nama_belakang' => '',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'usia' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'no_wa' => 'required',
            'status_pegawai' => 'required',
            'ruangan' => 'required',
            'tahun_pensiun' => 'required',
            'pendidikan_terakhir' => 'required',
            'tanggal_lulus' => 'required',
            'no_ijazah' => 'required',
            'jabatan_fungsional' => 'required'
        ]);
        $pegawai->update($validatedData);


        // jika status tenaga tidak sama dengan request status_tenaga
        if ($pegawai->status_tenaga != $request->status_tenaga) {
            //jika request->status tenaga == non asn
            if ($request->status_tenaga == 'non_asn') {
                // update status tenaga nya menjadi non_asn
                $pegawai->update(['status_tenaga' => $request->status_tenaga]);
                $pegawaiAsn = Asn::where('pegawai_id', $pegawai->id)->first();
                $pegawaiAsn->delete();
                $request->masa_kerja != null ? $pegawai->update(['masa_kerja' => intval($request->masa_kerja)]) : null;
                $request->cuti_tahunan != null ? $pegawai->update(['cuti_tahunan' => intval($request->cuti_tahunan)]) : null;
                $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
                return NonAsn::create(array_merge(['pegawai_id' => $pegawai->id], $validatedDataNonAsn));
                // return $pegawaiAsn;   
            }
            $pegawai->update(['status_tenaga' => $request->status_tenaga]);
            NonAsn::findOrFail($pegawai->non_asn->id)->delete();
            if ($pegawai->asn == null) {
                Asn::create([
                    'pegawai_id' => $pegawai->id,
                    'sekolah' => $request->sekolah,
                    'tmt_cpns' => $request->tmt_cpns,
                    'tmt_pns' => $request->tmt_pns,
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_terakhir,
                    'pangkat_golongan' => $request->pangkat_golongan,
                    'jenis_tenaga_struktural' => $request->jenis_tenaga_struktural,
                    'jabatan_struktural' => $request->jabatan_struktural,
                ]);
            }else{
                $pegawai->asn[0]->update([
                    'pegawai_id' => $pegawai->id,
                    'sekolah' => $request->sekolah,
                    'tmt_cpns' => $request->tmt_cpns,
                    'tmt_pns' => $request->tmt_pns,
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_terakhir,
                    'pangkat_golongan' => $request->pangkat_golongan,
                    'jenis_tenaga_struktural' => $request->jenis_tenaga_struktural,
                    'jabatan_struktural' => $request->jabatan_struktural,
                ]);
            }
            $asn = Asn::where('pegawai_id', $pegawai->id)->get()->first();
            // if ($request->jenis_tenaga_struktural == 'nakes') {
            //     if ($request->no_str != null && $request->no_tanggal_terbit_str != null && $request->masa_berlaku_str != null && $request->link_str != null) {
            //         # code...
            //         STR::create([
            //             'asn_id' => $asn->id,
            //             'no_str' => $request->no_str,
            //             'tanggal_terbit_str' => $request->tanggal_terbit_str,
            //             'masa_berlaku_str' => $request->masa_berlaku_str,
            //             'link_str' => $request->link_str
            //         ]);
            //     }
            //     if ($request->no_sip != null && $request->no_tanggal_terbit_sip != null && $request->masa_berlaku_sip != null && $request->link_sip != null) {
            //         SIP::create([
            //             'asn_id' => $asn->id,
            //             'no_sip' => $request->no_sip,
            //             'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
            //             'masa_berlaku_sip' => $request->masa_berlaku_sip,
            //             'link_sip' => $request->link_sip
            //         ]);
            //     }
            //     return $pegawai;
            // }
            if ($request->jenis_tenaga_struktural == 'umum') {
                STR::findOrFail($pegawai->asn[0]->str[0]->id)->delete();
                SIP::findOrFail($pegawai->asn[0]->sip[0]->id)->delete();
                $validatedDataUmum = $request->validate($this->rulesUmum);
                $umum = UmumStruktural::create(array_merge(['asn_id' => $asn->id], $validatedDataUmum));
                return $umum;
            }
        }
        // jika status tenaga sama dengan pegawai->status_tenaga
        if ($request->status_tenaga == 'non_asn') {
            $validatedDataNonAsn = $this->rulesNonAsn;
            $pegawai->non_asn[0]->update($validatedDataNonAsn);
            return $pegawai->non_asn;
        }else if($request->status_tenaga == 'asn_pns' || $request->status_tenaga == 'asn_pppk'){
            $validatedDataAsn = $this->rulesAsn;
            $pegawai->asn[0]->update($validatedDataAsn);
            if ($request->jenis_tenaga_struktural == 'umum') {
                STR::findOrFail($pegawai->asn[0]->str[0]->id)->delete();
                SIP::findOrFail($pegawai->asn[0]->sip[0]->id)->delete();
                $validatedDataUmum = $request->validate($this->rulesUmum);
                $umum = $pegawai->asn[0]->umum[0]->update($validatedDataUmum);
                return $umum;
            }
        }
        // $pegawai->update($validatedData); 
        return $pegawai;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
        return $pegawai->delete();
    }
}
