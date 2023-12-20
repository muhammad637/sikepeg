<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Admin;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Golongan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Imports\PegawaiImport;
use App\Models\PangkatGolongan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Shared;
use Illuminate\Validation\Rule;




class PegawaiController extends Controller
{

    public function loginHandler(Request $request)
    {
        $request->validate([
            'nip_nippk' => 'required|exists:pegawais,nip_nippk',
            'password' => 'required',
        ], [
            'nip_nippk.required' => 'nip / nippk harus ada isinya',
            'nip_nippk.exists' => 'nip / nippk tidak ada di database',
            'password.required' => 'password harus di isi',
        ]);

        $cred = array(
            'nip_nippk' => $request->nip_nippk,
            'password' => $request->password,
        );
        if (Auth::guard('pegawai')->attempt($cred)) {
            return redirect()->route('pegawai.home');
        } else {
            session()->flash('fail', 'data yang anda masukkan salah, coba lagi');
            return redirect()->back();
        }
    }
    public function logoutHandler()
    {
        Auth::guard('pegawai')->logout();
        session()->flash('fail', 'anda sudah logout di sistem');
        return redirect()->route('pegawai.login');
    }

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
        // 'tmt_cpns' => 'required',
        // 'tmt_pppk' => 'required',
        // 'tmt_pns' => 'required',
        'tmt_pangkat_terakhir' => 'required',
        // 'golongan_id' => 'required',
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
        'masa_berakhir_sip' => 'required',
        'link_sip' => 'required'
    ];
    private $rulesNonNakes = [
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
    public function index(Request $request)
    {
        // return Asn::all();
        if ($request->ajax()) {
            $pegawai = Pegawai::query();
            if ($request->input('ruangan') != null) {
                $pegawai = $pegawai->where('ruangan_id', $request->ruangan);
            }
            if ($request->input('jenis_tenaga') != null) {
                $pegawai = $pegawai->where('jenis_tenaga', $request->jenis_tenaga);
            }
            if ($request->input('status_tipe') != null) {
                $pegawai = $pegawai->where('status_tipe', $request->status_tipe);
            }
            $pegawai->orderBy('created_at', 'desc');
            $dataPegawai = DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('jenis_kelamin', function ($item) {
                    if (strtolower($item->jenis_kelamin) == 'laki-laki' || strtolower($item->jenis_kelamin) == 'perempuan') {
                        return $item->jenis_kelamin;
                    }
                    return 'tidak diketahui';
                })
                ->addColumn('aksi', 'pages.pegawai.part.aksi')
                ->addColumn('ruangan', function ($item) {
                    return "<span class='text-uppercase'> " . ($item->ruangan ? $item->ruangan->nama_ruangan : '-') . "</span>";
                })
                ->addColumn('status_pegawai', function ($item) {
                    // return $item->status_pegawai ?? null;
                    return '<button class="btn btn-' . ($item->status_pegawai == 'aktif' ? 'success' : 'secondary') . ' border-0">' . $item->status_pegawai . '</button>';
                })
                ->filterColumn('ruangan', function ($query, $keyword) {
                    // Logika pencarian kolom "ruangan"
                    $query->whereHas('ruangan', function ($query) use ($keyword) {
                        $query->where('nama_ruangan', 'like', '%' . $keyword . '%');
                    });
                })
                ->filterColumn('status_pegawai', function ($query, $keyword) {
                    // Logika pencarian kolom "status_pegawai"
                    $query->where('status_pegawai', 'like', '%' . $keyword . '%');
                })
                ->rawColumns(['aksi', 'ruangan', 'status_pegawai', 'jenis_kelamin'])
                ->toJson();
            return $dataPegawai;
        }
        return view('pages.pegawai.index', [
            'ruangans' => Ruangan::orderBy('nama_ruangan', 'asc')->get()
        ]);
        // Pegawai::with(['asn', 'non_asn'])->get();
    }
    public function import_excel(Request $request)
    {
        // return Ruangan::firstOrCreate(['nama_ruangan' => 'loket 10']);
        // try {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx,txt'
        ]);
        // return '$testing';   
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_pegawai', $nama_file);
       Excel::import(new PegawaiImport, public_path('file_pegawai/' . $nama_file));
        alert()->success('berhasil', 'data pegawai berhasil di import');
        return redirect()->route('admin.pegawai.index')->with('success', 'data pegawai berhasil di import');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return Golongan::all();
        return view('pages.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function gelarDepan($gelar_depan)
    {
        $data_gelar_depan = $gelar_depan ?? null;
        if (strpos($data_gelar_depan, '.') == false && $gelar_depan != null) {
            $data_gelar_depan = $gelar_depan . '.';
        }
        return $data_gelar_depan;
    }

    private function gelarBelakang($gelar_belakang)
    {
        $data_gelar_belakang = $gelar_belakang ?? null;
        if (strpos($data_gelar_belakang, ',') == false && $gelar_belakang != null) {
            $data_gelar_belakang = ',' . $gelar_belakang;
        }
        return $data_gelar_belakang;
    }

    public function store(Request $request)
    {
        $pegawai = [];
        $usia = $this->lama($request->tanggal_lahir);
        $validatedData = $request->validate($this->rulesPegawai);
        $parseTanggalLahir = Carbon::parse($request->tanggal_lahir)->format('dmY');
        $password = Hash::make($parseTanggalLahir);
        $data_gelar_depan = $this->gelarDepan($request->gelar_depan);
        $data_gelar_belakang = $this->gelarBelakang($request->gelar_belakang);
        $nama_lengkap = $data_gelar_depan . " " . $request->nama_depan . " " . $request->nama_belakang . " " . $data_gelar_belakang;
        $ruangan = $request->ruangan_id;
        if ($request->ruangan_id == 'ruangan_lainnya') {
            $request->validate(
                ['nama_ruangan' => 'required|unique:ruangans,nama_ruangan']
            );
            $ruangan = Ruangan::create([
                'nama_ruangan' => strtolower($request->nama_ruangan),
            ]);
        }
        $data = array_merge(['usia' => $usia, 'nama_lengkap' => $nama_lengkap, 'ruangan_id' => $ruangan->id ?? $ruangan, 'password' => $password], $validatedData);
        if ($request->status_tenaga == 'non asn') {
            $masa_kerja = $this->lama($request->tanggal_masuk);
            $data = array_merge([
                'cuti_tahunan' => $request->cuti_tahunan,
                'sisa_cuti_tahunan' => $request->cuti_tahunan,
                'masa_kerja' => $masa_kerja,
                'status_tipe' => 'thl'
            ], $data);
            $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
            $createPegawai = Pegawai::create(array_merge($validatedDataNonAsn, $data));
            alert()->success('sukses', 'data pegawai berhasil ditambahkan');
            $notif = Notifikasi::notif('pegawai', 'pegawai baru berhasil ditambahkan oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($createPegawai->id);
            return redirect(route('admin.pegawai.index'))->with('success', 'Data pegawai berhasil ditambahkan')->withInput();
        }

        $pangkat_golongan_id = $request->pangkat_golongan_id;
        if ($request->pangkat_golongan_id == 'pangkat_golongan_lainnya') {
            $request->validate([
                'nama_pangkat_golongan' => 'unique:pangkat_golongans,nama'
            ]);
            $pangkat_golongan = PangkatGolongan::create([
                'nama' => $request->nama_pangkat_golongan,
                'nama_kecil' => strtolower(
                    $request->nama_pangkat_golongan
                ),
            ]);
            $pangkat_golongan_id = $pangkat_golongan->id;
        }
        if ($request->status_tipe == 'pns') {
            $masa_kerja = $this->lama($request->tmt_pns);
            $status_tipe = [
                'pangkat_golongan_id' => $pangkat_golongan_id,
                'tmt_pns' => $request->tmt_pns,
                'tmt_cpns' => $request->tmt_cpns,
            ];
        } elseif ($request->status_tipe == 'pppk') {
            $masa_kerja = $this->lama($request->tmt_pppk);
            $status_tipe = [
                'pangkat_golongan_id' => $pangkat_golongan_id,
                'tmt_pppk' => $request->tmt_pppk,
            ];
        }
        $sisaCutiTahunan = isset($request->cuti_tahunan) ? $request->cuti_tahunan : 12;
        $validatedAsn = $request->validate($this->rulesAsn);
        $data = array_merge([
            'sisa_cuti_tahunan' => $sisaCutiTahunan,
            'masa_kerja' => $masa_kerja,
            'status_tipe' => $request->status_tipe
        ], $validatedAsn, $data, $status_tipe);
        if ($request->jenis_tenaga == 'umum') {
            $validatedDataUmum = $request->validate($this->rulesNonNakes);
            $pegawai = array_merge($data, $validatedDataUmum);
        } else if ($request->jenis_tenaga == 'struktural') {
            $validatedDataUmum = $request->validate($this->rulesNonNakes);
            $pegawai = array_merge($data, $validatedDataUmum);
        } else if ($request->jenis_tenaga == 'nakes') {
            $createPegawai = Pegawai::create($data);
            if ($request->no_str != null && $request->tanggal_terbit_str != null && $request->masa_berakhir_str != null && $request->link_str != null) {
                $validatedDataStr = $request->validate($this->rulesStr);
                $createSTR = array_merge(['pegawai_id' => $createPegawai->id], $validatedDataStr);
                STR::create($createSTR);
            }
            if ($request->no_sip != null && $request->tanggal_terbit_sip != null && $request->masa_berlaku_sip != null && $request->link_sip != null) {
                $validatedDataSip = $request->validate($this->rulesSip);
                $createSIP = array_merge(['pegawai_id' => $createPegawai->id], $validatedDataSip);
                SIP::create($createSIP);
            }
            $notif = Notifikasi::notif('pegawai', 'pegawai baru berhasil ditambahkan oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($createPegawai->id);
            alert()->success('sukses', 'data pegawai berhasil ditambahkan');
            return redirect(route('admin.pegawai.index'))->with('success', 'Data pegawai berhasil ditambahkan')->withInput();
        }
        $createPegawai = Pegawai::create($pegawai);
        $notif = Notifikasi::notif('pegawai', 'pegawai baru berhasil ditambahkan oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($createPegawai->id);
        alert()->success('sukses', 'data pegawai berhasil ditambahkan');
        return redirect(route('admin.pegawai.index'))->with('success', 'Data pegawai berhasil ditambahkan')->withInput();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {

        // return $pegawai->golongan;
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

        $ruangan_id = $request->ruangan_id;
        $password = bcrypt(Carbon::parse($request->tanggal_lahir)->format('dmY'));
        $validatedData = $request->validate($this->validatedPegawaiEdit($pegawai), [
            'nik.required' => 'nik tidak boleh kosong',
            'nik.unique' => 'nik harus unik',
            'nip_nippk.unique' => 'nip / nippk harus unik',
        ]);

        if ($request->ruangan_id == 'ruangan_lainnya') {
            $request->validate(
                ['nama_ruangan' => 'required|unique:ruangans,nama_ruangan'],
                ['nama_ruangan.unique' => 'nama ruangan harus unik']
            );
            $ruangan = Ruangan::create([
                'nama_ruangan' => strtolower($request->nama_ruangan),
            ]);
            $ruangan_id = $ruangan->id;
        }
        $data_gelar_depan = $this->gelarDepan($request->gelar_depan);
        $data_gelar_belakang = $this->gelarBelakang($request->gelar_belakang);
        $pegawai->update([
            'nama_lengkap' => $data_gelar_depan . " " . $request->nama_depan . " " . $request->nama_belakang . " " .  $data_gelar_belakang,
            'password' => $password,
            'ruangan_id' =>  $ruangan_id

        ]);
        $usia = $this->lama($request->tanggal_lahir);
        $pegawai->update(array_merge(['usia' => $usia], $validatedData));

        if (isset($request->pangkat_golongan_id)) {
            $pangkat_golongan_id = $request->pangkat_golongan_id;
            if ($request->pangkat_golongan_id == 'pangkat_golongan_lainnya') {
                $request->validate([
                    'nama_pangkat_golongan' => 'unique:pangkat_golongans,nama'
                ]);
                $pangkat_golongan = PangkatGolongan::create([
                    'nama' => $request->nama_pangkat_golongan,
                    'nama_kecil' => strtolower(
                        $request->nama_pangkat_golongan
                    ),
                ]);
                $pangkat_golongan_id = $pangkat_golongan->id;
            }
            $dataTambahan = [
                'pangkat_golongan_id' => $pangkat_golongan_id ?? null,
                'tmt_pns' => $request->tmt_pns ?? null,
                'tmt_cpns' => $request->tmt_cpns ?? null,
                'tmt_pppk' => $request->tmt_pppk ?? null
            ];
        }
        if (isset($request->cuti_tahunan)) {
            $pegawai->update(['cuti_tahunan' => $request->cuti_tahunan]);
        }
        if (isset($request->tmt_pns)) {
            $masa_kerja = $this->lama($request->tmt_pns);
        }
        if (isset($request->tmt_pppk)) {
            $masa_kerja = $this->lama($request->tmt_pppk);
        }
        if ($pegawai->status_tenaga != $request->status_tenaga && $request->status_tenaga == 'non asn') {
            $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
            $pegawai->update(
                array_merge(
                    [
                        'status_tenaga' => $request->status_tenaga,
                        'status_tipe' => 'thl',
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
                        'pangkat_id' => null,
                        'golongan_id' => null,
                        'jenis_tenaga' => null,
                    ],
                    $validatedDataNonAsn
                )
            );
            count($pegawai->str) > 0 ? STR::destroy($pegawai->str->pluck('id')->toArray()) : null;
            count($pegawai->sip) > 0 ? SIP::destroy($pegawai->sip->pluck('id')->toArray()) : null;
            $notif = Notifikasi::notif('pegawai', 'pegawai berhasil diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);
            alert()->success('sukses', 'data pegawai berhasil diupdate');
            return redirect(route('admin.pegawai.index'))->withInput();
        } elseif ($pegawai->status_tenaga != $request->status_tenaga && $request->status_tenaga == 'asn') {
            $validatedDataAsn = $request->validate($this->rulesAsn);
            $pegawai->update(array_merge([
                'status_tenaga' => $request->status_tenaga,
                'status_tipe' => $request->status_tipe,
                'tanggal_masuk' => null,
                'niPtt_pkThl' => null,
                'masa_kerja' => $masa_kerja
            ], $validatedDataAsn, $dataTambahan));
            alert()->success('sukses', 'data pegawai berhasil diupdate');
            $notif = Notifikasi::notif('pegawai', 'pegawai berhasil diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);
            alert()->success('sukses', 'data pegawai berhasil diupdate');
            return redirect(route('admin.pegawai.index'))->withInput();
        }
        if ($request->status_tenaga == 'non asn') {
            $validatedDataNonAsn = $request->validate($this->rulesNonAsn);
            $pegawai->update(array_merge(['masa_kerja' => $this->lama($request->tanggal_masuk)], $validatedDataNonAsn));
            $notif = Notifikasi::notif('pegawai', 'pegawai berhasil diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);
            alert()->success('sukses', 'data pegawai berhasil diupdate');
            return redirect(route('admin.pegawai.index'));
        } else if ($request->status_tenaga == 'asn') {
            $validatedDataAsn = $request->validate($this->rulesAsn);
            $pegawai->update(array_merge(
                ['masa_kerja' => $masa_kerja],
                $validatedDataAsn,
                $dataTambahan
            ));
        }
        if ($request->jenis_tenaga == 'umum' || $request->jenis_tenaga == 'struktural') {
            count($pegawai->str) > 0 ? STR::destroy($pegawai->str->pluck('id')->toArray()) : null;
            count($pegawai->sip) > 0 ? SIP::destroy($pegawai->sip->pluck('id')->toArray()) : null;
            $validatedDataUmum = $request->validate($this->rulesNonNakes);
            $pegawai->update($validatedDataUmum);
            $notif = Notifikasi::notif('pegawai', 'pegawai berhasil diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);
            alert()->success('sukses', 'data pegawai berhasil diupdate');
            return redirect(route('admin.pegawai.index'));
        }
        $notif = Notifikasi::notif('pegawai', 'pegawai berhasil diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-user');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawai->id);
        alert()->success('sukses', 'data pegawai berhasil diupdate');
        return redirect(route('admin.pegawai.index'))->withInput();
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
            'tahun_pensiun' => 'required',
            'pendidikan_terakhir' => 'required',
            'tanggal_lulus' => 'required',
            'no_ijazah' => 'required',
            'jabatan' => 'required'
        ];
    }



    public function dataPegawai($query)
    {
        $dataPegawai = DataTables::of($query)
            ->addColumn('aksi', function ($item) {
                $show = "<a href='" . route('admin.pegawai.show', ['pegawai' => $item->id]) . "'
                                        class='badge p-2 text-white bg-info mr-1'><i class='fas fa-info-circle'></i></a>";
                $edit = "<a href='" . route('admin.pegawai.edit', ['pegawai' => $item->id]) . "'
                                        class='badge p-2 text-white bg-warning mr-1'><i class='fas fa-pen'></i></a>";
                return "<div class='d-flex'>$show $edit</div>";
            })
            ->addColumn('ruangan', function ($item) {
                return $item->ruangan->nama_ruangan ?? ' -';
            })
            ->editColumn('status_pegawai', function ($item) {
                // return $item->status_pegawai ?? null;
                return '<button class="btn btn-' . ($item->status_pegawai == 'aktif' ? 'success' : 'secondary') . ' border-0">' . $item->status_pegawai . '</button>';
            })
            ->rawColumns(['aksi', 'ruangan', 'status_pegawai', 'jenis_kelamin'])
            ->toJson();
        return $dataPegawai;
    }

    public function searchPegawai(Request $request)
    {
        $namaRuangan = $request->search;
        $pegawaiDalamRuangan = Pegawai::whereHas('ruangan', function ($query) use ($namaRuangan) {
            $query->where('nama_ruangan', 'like', '%' . $namaRuangan . '%');
        })
            ->orWhere('nip_nippk', 'like', '%' . $request->search . '%')
            ->orWhere('nama_lengkap', 'like', '%' . $request->search . '%')
            ->orWhere('nama_depan', 'like', '%' . $request->search . '%')
            ->orWhere('status_tipe', 'like', '%' . $request->search . '%')
            ->get();
        return [$request->search, $pegawaiDalamRuangan];
    }

 
}
