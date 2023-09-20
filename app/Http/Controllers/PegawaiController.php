<?php

namespace App\Http\Controllers;

use App\Imports\PegawaiImport;
use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Pegawai;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;



class PegawaiController extends Controller
{

    private $rulesPegawai = [
        'nik' => 'required|unique:pegawais,nik,',
        'nip_nippk' =>  'required|unique:pegawais,nip_nippk',
        'gelar_depan'  => '',
        'gelar_belakang'  => '',
        'nama_depan' => 'required',
        'nama_belakang' => '',
        'jenis_kelamin' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'alamat' => 'required',
        'agama' => 'required',
        'no_wa' => 'required',
        'status_pegawai' => 'required',
        'ruangan' => 'required',
        'tahun_pensiun' => 'required',
        'pendidikan_terakhir' => 'required',
        'tanggal_lulus' => 'required',
        'status_tenaga' => 'required',
        'no_ijazah' => 'required',
        'jabatan' => 'required'
    ];
    private $rulesNonAsn = [
        'tanggal_masuk' => 'required',
        'niPtt_pkThl' => 'required'
    ];
    private $rulesAsn = [
        'sekolah' => 'required',
        'tmt_cpns' => 'required',
        'tmt_pns' => 'required',
        'tmt_pangkat_terakhir' => 'required',
        'pangkat_golongan' => 'required',
        'jenis_tenaga' => 'required',
        // 'jabatan' => 'required'
    ];
    private $rulesStr = [
        'no_str' => 'required',
        'tanggal_terbit_str' => 'required',
        'masa_berakhir_str' => 'required',
        'link_str' => 'required'
    ];
    private $rulesSip = [
        'no_sip' => 'required',
        'tanggal_terbit_sip' => 'required',
        'masa_berlaku_sip' => 'required',
        'link_sip' => 'required'
    ];
    private $rulesUmum = [
        'masa_kerja' => '',
        'no_karpeg' => '',
        'no_taspen' => '',
        'no_npwp' => '',
        'no_hp' => '',
        'email' => '',
        'pelatihan' => ''
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return Asn::all();   
        return view('pages.pegawai.index', [
            'pegawai' => Pegawai::all()
        ]);
        // Pegawai::with(['asn', 'non_asn'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.pegawai.create');
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
            // $tahun_ini = Carbon::parse(now())->format('Y');
            $usia = $this->lama($request->tanggal_lahir);
            // return $request->tanggalMasuk;
            $validatedData = $request->validate($this->rulesPegawai);
            $pegawai = Pegawai::create(array_merge(['usia' => $usia], $validatedData));
            $nama_lengkap = $request->gelar_depan . " " . $request->nama_depan . " " . $request->nama_belakang . " " . $request->gelar_belakang;
            $pegawai->update(['nama_lengkap' => $nama_lengkap]);
            if ($request->status_tenaga == 'non asn') {
                // $tahun
                $masa_kerja = $this->lama($request->tanggal_masuk);
                $pegawai->update(
                    [
                        'cuti_tahunan' => $request->cuti_tahunan,
                        'sisa_cuti_tahunan' => $request->cuti_tahunan,
                        'masa_kerja' => $masa_kerja,
                        'status_tipe' => $pegawai->status_tenaga
                    ]
                );
                $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
                $pegawai->update($validatedDataNonAsn);
                return redirect(route('pegawai.index'))->with('success', 'data pegawai berhasil ditambahkan')->withInput();
            }
            $masa_kerja = $this->lama($request->tmt_pns);
            $sisaCutiTahunan = isset($request->cuti_tahunan) ? $request->cuti_tahunan : 12;
            $pegawai->update([
                'sisa_cuti_tahunan' => $sisaCutiTahunan,
                'masa_kerja' => $masa_kerja,
                'status_tipe' => $request->status_tipe
            ]);
            $asn = $this->CreateAsn($request, $pegawai);
            if ($request->jenis_tenaga == 'nakes') {
                if ($request->no_str != null && $request->tanggal_terbit_str != null && $request->masa_berakhir_str != null && $request->link_str != null) {
                    # code...
                    $validatedDataStr = $request->validate($this->rulesStr);
                    $createSTR = array_merge(['pegawai_id' => $pegawai->id], $validatedDataStr);
                    STR::create($createSTR);
                }
                if ($request->no_sip != null && $request->tanggal_terbit_sip != null && $request->masa_berlaku_sip != null && $request->link_sip != null) {
                    $validatedDataSip = $request->validate($this->rulesSip);
                    $createSIP = array_merge(['pegawai_id' => $pegawai->id], $validatedDataSip);
                    SIP::create($createSIP);
                }
                return redirect(route('pegawai.index'))->with('success', 'data pegawai berhasil ditambahkan')->withInput();
            } else if ($request->jenis_tenaga == 'umum') {
                $validatedDataUmum = $request->validate($this->rulesUmum);
                $pegawai->update($validatedDataUmum);
                return redirect(route('pegawai.index'))->with('success', 'data pegawai berhasil ditambahkan')->withInput();
            }
            return "ada yang salah nih logic mu ini";   //code...
        } catch (\Throwable $th) {
            return $th->getMessage();
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
        return $pegawai;
        return view('pages.pegawai.show', [
            'pegawai' => $pegawai
        ]);
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
        return view('pages.pegawai.edit', [
            'pegawai' => $pegawai
        ]);
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

        //code...
        // return $request->all();
        // proses validasi
        $validatedData = $request->validate([
            'nik' => 'required|unique:pegawais,nik,' . $pegawai->id,
            'nip_nippk' => 'required|unique:pegawais,nip_nippk,' . $pegawai->id,
            'gelar_depan'  => '',
            'gelar_belakang'  => '',
            'nama_depan' => 'required',
            'nama_belakang' => '',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            // 'usia' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'no_wa' => 'required',
            'status_pegawai' => 'required',
            'status_tipe' => 'required',
            'ruangan' => 'required',
            'tahun_pensiun' => 'required',
            'pendidikan_terakhir' => 'required',
            'tanggal_lulus' => 'required',
            'no_ijazah' => 'required',
            'jabatan' => 'required'
        ]);
        $usia = $this->lama($request->tanggal_lahir);
        $pegawai->update(array_merge(['usia' => $usia], $validatedData));
        # jika status tenaga tidak sama dengan request status_tenaga
        if ($pegawai->status_tenaga != $request->status_tenaga) {
            #jika request->status tenaga == non asn
            if ($request->status_tenaga == 'non asn') {
                #buat pegawai non asn
                $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
                $pegawai->update(
                    array_merge(
                        [
                            'status_tenaga' => $request->status_tenaga,
                            'status_tipe' => $request->status_tipe,
                            'masa_kerja' => $this->lama($pegawai->tanggalMasuk),
                            'no_karpeg' => null,
                            'no_taspen' => null,
                            'no_npwp' => null,
                            'no_hp' => null,
                            'email' => null,
                            'pelatihan' => null,
                            'sekolah' => null,
                            'tmt_cpns' => null,
                            'tmt_pns' => null,
                            'tmt_pangkat_terakhir' => null,
                            'pangkat_golongan' => null,
                            'jenis_tenaga' => null,
                        ],
                        $validatedDataNonAsn
                    )
                );
                count($pegawai->str) > 0 ? STR::destroy($pegawai->str->pluck('id')->toArray()) : null;
                count($pegawai->sip) > 0 ? SIP::destroy($pegawai->sip->pluck('id')->toArray()) : null;
                # jika izin cuti di edit maka edit izin cuti nya
                $request->cuti_tahunan != null ? $pegawai->update(['cuti_tahunan' => intval($request->cuti_tahunan)]) : null;
                return redirect(route('pegawai.index'))->with('success', 'pegawai berhasil di update');
            } else {
                $validatedDataAsn = $request->validate($this->rulesAsn);
                $masa_kerja = $this->lama($request->tmt_pns);
                $pegawai->update(array_merge([
                    'status_tenaga' => $request->status_tenaga,
                    'status_tipe' => $request->status_tipe,
                    'tanggal_masuk' => null,
                    'niPtt_pkThl' => null,
                    'masa_kerja' => $masa_kerja
                ], $validatedDataAsn));
                // return $this->CreateAsn($request, $pegawai);
            }


            // {{count($pegawai->)}}
            // if (count($pegawai->asn) > 0) {
            //     $validatedDataAsn = $request->validate($this->rulesAsn);
            //     $pegawai->asn->update($validatedDataAsn);
            // } else {
            //     $validatedDataAsn = $request->validate($this->rulesAsn);
            //     count($pegawai->non_asn) > 0 ? NonAsn::findOrFail($pegawai->non_asn[0]->id)->delete() : null;
            //     Asn::create(array_merge([
            //         'pegawai_id' => $pegawai->id,
            //     ], $validatedDataAsn));
            // }
            // $pegawai->update(['status_tenaga' => $request->status_tenaga]);
            // if (
            //     $request->jenis_tenaga == 'umum'
            // ) {
            //     count($pegawai->asn[0]->str) > 0 ? STR::destroy($pegawai->asn[0]->str->pluck('id')->toArray()) : null;
            //     count($pegawai->asn[0]->sip) > 0 ? SIP::destroy($pegawai->asn[0]->sip->pluck('id')->toArray()) : null;
            //     $validatedDataUmum = $request->validate($this->rulesUmum);
            //     count($pegawai->asn[0]->umum) > 0 ? $pegawai->asn[0]->umum[0]->update($validatedDataUmum) : UmumStruktural::create(array_merge(['asn_id' => $pegawai->asn[0]->id], $validatedDataUmum));
            //     return redirect(route('pegawai.index'))->with('success', 'pegawai berhasil di update');
            //     // return 'testing';
            // }


            return redirect(route('pegawai.index'))->with('success', 'pegawai berhasil di update');
        }
        // end request

        // jika status tenaga sama dengan pegawai->status_tenaga
        if ($request->status_tenaga == 'non asn') {
            $validatedDataNonAsn = $this->rulesNonAsn;
            $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
            $pegawai->nonAsn->update($validatedDataNonAsn);
            return redirect(route('pegawai.index'))->with('success', 'data pegawai berhasil diupdate');
        } else if ($request->status_tenaga == 'asn') {
            $validatedDataAsn = $request->validate($this->rulesAsn);
            $pegawai->asn->update($validatedDataAsn);
        }
        if ($request->jenis_tenaga == 'umum') {
            // count($pegawai->asn->str) > 0 ? STR::destroy($pegawai->asn->str->pluck('id')->toArray()) : null;
            // count($pegawai->asn->sip) > 0 ? SIP::destroy($pegawai->asn->sip->pluck('id')->toArray()) : null;
            // $validatedDataUmum = $request->validate($this->rulesUmum);
            // count($pegawai->asn->umum) > 0 ? $pegawai->asn->umum->update($validatedDataUmum) : UmumStruktural::create(array_merge(['asn_id' => $pegawai->asn->id], $validatedDataUmum));
            return redirect(route('pegawai.index'))->with('success', 'pegawai berhasil di update');
            // return 'testing';
        }
        // $pegawai->update($validatedData); 
        return redirect(route('pegawai.index'))->with('success', 'data pegawai berhasil diupdate')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        return $pegawai->delete();
    }

    private function CreateAsn($request, $pegawai)
    {
        $validateDataAsn = $request->validate($this->rulesAsn);
        return $pegawai->update($validateDataAsn);
    }

    public function lama($tanggalMulai)
    {
        $parseTanggalMulai = Carbon::parse($tanggalMulai);
        $tahun = $parseTanggalMulai->diffInYears();
        $bulan = $parseTanggalMulai->diffInMonths() % 12;
        $lama = "$tahun tahun, $bulan bulan";
        return $lama;
    }
}
