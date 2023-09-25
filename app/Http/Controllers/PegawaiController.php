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
            'pegawai' => Pegawai::orderBy('created_at', 'desc')->get()
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
        // Fungsi untuk menyimpan data pegawai
      
            $pegawai = []; // Inisialisasi array pegawai

            // Menghitung usia berdasarkan tanggal lahir
            $usia = $this->lama($request->tanggal_lahir);

            // Validasi data yang diterima dari request sesuai dengan aturan validasi pada $this->rulesPegawai
            $validatedData = $request->validate($this->rulesPegawai);

            // Menggabungkan nama lengkap dari input
            $nama_lengkap = $request->gelar_depan . " " . $request->nama_depan . " " . $request->nama_belakang . " " . $request->gelar_belakang;

            // Menggabungkan data-data yang telah divalidasi dengan informasi tambahan seperti usia dan nama lengkap
            $data = array_merge(['usia' => $usia, 'nama_lengkap' => $nama_lengkap], $validatedData);

            // Jika status tenaga adalah "non asn", maka lakukan langkah-langkah berikut
            if ($request->status_tenaga == 'non asn') {

                // Menghitung masa kerja berdasarkan tanggal masuk
                $masa_kerja = $this->lama($request->tanggal_masuk);

                // Menambahkan data tambahan untuk pegawai non ASN, seperti cuti tahunan dan lainnya
                $data = array_merge([
                    'cuti_tahunan' => $request->cuti_tahunan,
                    'sisa_cuti_tahunan' => $request->cuti_tahunan,
                    'masa_kerja' => $masa_kerja,
                    'status_tipe' => $request->status_tenaga
                ], $data);

                // Validasi data tambahan untuk pegawai non ASN
                $validatedDataNonAsn = $request->validate($this->rulesNonAsn);

                // Menggabungkan data pegawai dengan data tambahan
                $pegawai = array_merge($data, $validatedDataNonAsn);

                // Membuat pegawai baru dalam database dengan data yang telah dipersiapkan
                $createPegawai = Pegawai::create($pegawai);

                // Mengarahkan pengguna ke halaman indeks pegawai dengan pesan sukses
                return redirect(route('pegawai.index'))->with('success', 'Data pegawai berhasil ditambahkan')->withInput();
            }

            // Menghitung masa kerja berdasarkan TMT PNS
            $masa_kerja = $this->lama($request->tmt_pns);

            // Menetapkan jumlah cuti tahunan default jika tidak ada input
            $sisaCutiTahunan = isset($request->cuti_tahunan) ? $request->cuti_tahunan : 12;

            // Validasi data untuk pegawai ASN
            $validatedAsn = $request->validate($this->rulesAsn);

            // Menggabungkan data dengan data tambahan untuk pegawai ASN
            $data = array_merge([
                'sisa_cuti_tahunan' => $sisaCutiTahunan,
                'masa_kerja' => $masa_kerja,
                'status_tipe' => $request->status_tipe
            ], $validatedAsn, $data);

            // Jika jenis tenaga adalah "umum", lakukan validasi data tambahan
            if ($request->jenis_tenaga == 'umum') {
                $validatedDataUmum = $request->validate($this->rulesUmum);
                $pegawai = array_merge($data, $validatedDataUmum);
            }

            // Jika jenis tenaga adalah "struktural", lakukan validasi data tambahan
            else if ($request->jenis_tenaga == 'struktural') {
                $validatedDataUmum = $request->validate($this->rulesUmum);
                $pegawai = array_merge($data, $validatedDataUmum);
            }

            // Jika jenis tenaga adalah "nakes", lakukan langkah-langkah berikut
            else if ($request->jenis_tenaga == 'nakes') {

                // Membuat pegawai baru dalam database
                $createPegawai = Pegawai::create($data);

                // Jika terdapat data STR (Surat Tanda Registrasi), lakukan validasi dan simpan data STR
                if ($request->no_str != null && $request->tanggal_terbit_str != null && $request->masa_berakhir_str != null && $request->link_str != null) {
                    $validatedDataStr = $request->validate($this->rulesStr);
                    $createSTR = array_merge(['pegawai_id' => $createPegawai->id], $validatedDataStr);
                    STR::create($createSTR);
                }

                // Jika terdapat data SIP (Surat Izin Praktik), lakukan validasi dan simpan data SIP
                if ($request->no_sip != null && $request->tanggal_terbit_sip != null && $request->masa_berlaku_sip != null && $request->link_sip != null) {
                    $validatedDataSip = $request->validate($this->rulesSip);
                    $createSIP = array_merge(['pegawai_id' => $createPegawai->id], $validatedDataSip);
                    SIP::create($createSIP);
                }

                // Mengarahkan pengguna ke halaman indeks pegawai dengan pesan sukses
                return redirect(route('pegawai.index'))->with('success', 'Data pegawai berhasil ditambahkan')->withInput();
            }

            // Membuat pegawai baru dalam database
            $createPegawai = Pegawai::create($pegawai);

            // Mengarahkan pengguna ke halaman indeks pegawai dengan pesan sukses
            return redirect(route('pegawai.index'))->with('success', 'Data pegawai berhasil ditambahkan')->withInput();
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
        // return $pegawai;
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
        $validatedData = $request->validate($this->validatedPegawaiEdit($pegawai));
        $pegawai->update([
            'nama_lengkap' =>  $request->gelar_depan . " " . $request->nama_depan . " " . $request->nama_belakang . " " . $request->gelar_belakang,
        ]);
        $usia = $this->lama($request->tanggal_lahir);
        $pegawai->update(array_merge(['usia' => $usia], $validatedData));
        if ($pegawai->status_tenaga != $request->status_tenaga) {
            if ($request->status_tenaga == 'non asn') {
                $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
                $pegawai->update(
                    array_merge(
                        [
                            'status_tenaga' => $request->status_tenaga,
                            'status_tipe' => $request->status_tipe,
                            'masa_kerja' => $this->lama($request->tanggal_masuk),
                            'cuti_tahunan' => $request->cuti_tahunan,
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
                // $request->cuti_tahunan != null ? $pegawai->update(['cuti_tahunan' => intval($request->cuti_tahunan)]) : null;
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
            }
            return redirect(route('pegawai.index'))->with('success', 'pegawai berhasil di update');
        }

        if ($request->status_tenaga == 'non asn') {
            $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
            $pegawai->update(array_merge(['masa_kerja' => $this->lama($request->tanggal_masuk)], $validatedDataNonAsn));
            return redirect(route('pegawai.index'))->with('success', 'data pegawai berhasil diupdate');
        } else if ($request->status_tenaga == 'asn') {
            $validatedDataAsn = $request->validate($this->rulesAsn);
            $pegawai->update(array_merge(
                ['masa_kerja' => $this->lama($request->tmt_pns)],
                $validatedDataAsn
            ));
        }
        if ($request->jenis_tenaga == 'umum') {
            count($pegawai->str) > 0 ? STR::destroy($pegawai->str->pluck('id')->toArray()) : null;
            count($pegawai->sip) > 0 ? SIP::destroy($pegawai->sip->pluck('id')->toArray()) : null;
            $validatedDataUmum = $request->validate($this->rulesUmum);
            $pegawai->update($validatedDataUmum);
            return redirect(route('pegawai.index'))->with('success', 'pegawai berhasil di update');
        }
       
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
    public function lama($tanggalMulai)
    {
        $parseTanggalMulai = Carbon::parse($tanggalMulai);
        $tahun = $parseTanggalMulai->diffInYears();
        $bulan = $parseTanggalMulai->diffInMonths() % 12;
        $lama = "$tahun tahun, $bulan bulan";
        return $lama;
    }
    public function validatedPegawaiEdit($pegawai)
    {
        return [
            'nik' => 'required|unique:pegawais,nik,' . $pegawai->id,
            'nip_nippk' => 'required|unique:pegawais,nip_nippk,' . $pegawai->id,
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
            'status_tipe' => 'required',
            'ruangan' => 'required',
            'tahun_pensiun' => 'required',
            'pendidikan_terakhir' => 'required',
            'tanggal_lulus' => 'required',
            'no_ijazah' => 'required',
            'jabatan' => 'required'
        ];
    }
}
