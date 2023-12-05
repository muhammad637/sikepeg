<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Exports\SIPExport;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SIPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('sip', function ($query) {
        //     $query->orderBy('masa_berakhir_sip', 'desc');
        // })->whereHas('sip', function ($q) {
        //     $q->orderBy('masa_berakhir_sip', 'desc');
        // })->get();
        // return $pegawai;
        if ($request->ajax()) {
            $pegawai = Pegawai::query()
                ->where('jenis_tenaga', 'nakes')->with('sip', function ($query) {
                    $query->orderBy('masa_berakhir_sip', 'desc');
                })->whereHas('sip', function ($q) {
                    $q->orderBy('masa_berakhir_sip', 'desc');
                });
            return DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('tanggal-berakhir-sip', function ($item) {
                    return Carbon::parse($item->sip[0]->masa_berakhir_sip)->format('d-m-Y');
                })
                ->addColumn('status', function ($item) {
                    $data = Carbon::parse($item->sip[0]->masa_berakhir_sip)->format('Y-m-d') > now()->format('Y-m-d');
                    // dd($data);
                    $status = $data ? 'aktif' : 'nonaktif';
                    $warna = $data == true ? 'btn-success' : 'btn-secondary';
                    return "<button class='btn " . $warna . "'>$status</button>";
                })
                ->addColumn('nama-ruangan', function ($item) {
                    return $item->ruangan->nama_ruangan;
                })
                ->addColumn('aksi', 'pages.sip.part.aksi-index')
                ->addColumn('surat', 'pages.surat.sip-index')
                ->rawColumns(['surat', 'tanggal-berakhir-sip', 'status', 'aksi', 'nama-ruangan'])
                ->toJson();
        }
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
        return view('pages.sip.create', [
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
            // return $request->all();
            $validatedData = $request->validate([
                'no_str' => '',
                'no_sip' => 'required',
                'no_rekomendasi' => 'required',
                'tanggal_terbit_sip' => 'required',
                'masa_berakhir_sip' => 'required',
                'link_sip' => 'required',
                'alamat_sip' => 'required',
            ],[
                'alamat_sip.required' => 'alamat tidak boleh kosong'
            ]);

            $sip = SIP::create([
                'pegawai_id' => $request->pegawai_id,
                'no_sip' => $request->no_sip,
                'no_rekomendasi' => $request->no_rekomendasi,
                'no_str' => $request->no_str,
                'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
                'masa_berakhir_sip' => $request->masa_berakhir_sip,
                'link_sip' => $request->link_sip,
                'alamat_sip' => $request->alamat_sip
            ]);
            $notif = Notifikasi::notif('sip', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($sip->pegawai->id);
            alert()->success('berhasil', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name);
            return redirect(route('admin.sip.index'))->with('success', 'sip berhasil ditambahkan');
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
        // return $sip;
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
            'sip' => $sip,
            'results' => Pegawai::where('jenis_tenaga', 'nakes')->get()
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
            'no_str' => '',
            'no_rekomendasi' => 'required',
            'no_sip' => 'required',
            'tanggal_terbit_sip' => 'required',
            'masa_berakhir_sip' => 'required',
            'link_sip' => 'required',
        ]);
        $sipCreate = $sip->update([
            'no_sip' => $request->no_sip,
            'no_rekomendasi' => $request->no_rekomendasi,
            'no_str' => $request->no_str,
            'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
            'masa_berakhir_sip' => $request->masa_berakhir_sip,
            'link_sip' => $request->link_sip
        ]);
        // return $sip;
        $notif = Notifikasi::notif('sip', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($sip->pegawai->id);
        alert()->success('berhasil', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name);
        if($request->riwayat){
            return redirect(route('admin.sip.riwayat',['pegawai' => $sip->pegawai_id]))->with('success', 'sip berhasil ditambahkan');
        }
        return redirect(route('admin.sip.index'))->with('success', 'sip berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SIP  $sIP
     * @return \Illuminate\Http\Response
     */
    public function destroy(SIP $sip)
    {
        alert()->success('data sip pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil di hapus');
        $sip->delete();
        return redirect()->back();
    }
    public function history(Pegawai $pegawai, Request $request)
    {
        $sip = SIP::where('pegawai_id', $pegawai->id)->orderBy('masa_berakhir_sip', 'desc')->get();
        if ($request->ajax()) {
            $dataSIP = SIP::query()->where('pegawai_id', $pegawai->id)
            ->orderBy('masa_berakhir_sip', 'desc');
            return DataTables::of($dataSIP)
                ->addIndexColumn()
                ->addColumn('surat', 'pages.surat.sip-riwayat')
                ->addColumn('aksi', 'pages.sip.part.aksi-riwayat')
                ->addColumn('status', function ($q) {
                    $data_warna = 'btn-secondary';
                    $data_status = 'nonaktif';
                    if ($q->masa_berakhir_sip > now()) {
                        $data_warna = 'btn-success';
                        $data_status = 'aktif';
                    }
                    return "<button class='btn $data_warna'> $data_status</button>";
                })
                ->addColumn('tanggal-terbit-str', function ($item) {
                    $tanggal = Carbon::parse($item->tanggal_terbit)->format('d-m-Y');
                    return $tanggal;
                })
                ->addColumn('masa-berakhir-sip', function ($item) {
                    $tanggal = Carbon::parse($item->masa_berakhir_sip)->format('d-m-Y');
                    return $tanggal;
                })
                ->rawColumns(['surat', 'aksi', 'status', 'tanggal-terbit-sip', 'masa-berakhir-sip'])
                ->toJson();
        }
        return view('pages.sip.riwayat.index', [
            'sip' => $sip,
            'pegawai' => $pegawai
        ]);
    }
    public function showRiwayat(SIP $sip)
    {
        return view('pages.sip.riwayat.show', [
            'sip' => $sip
        ]);
    }
    public function editRiwayat(SIP $sip)
    {
        $results = Pegawai::where('status_tenaga', 'asn')->where('jenis_tenaga', 'nakes')->get();
        return view('pages.sip.riwayat.edit', [
            'sip' => $sip,
            'results' => $results
        ]);
    }
    public function reminderSIP(Request $request)
    {
        $currentDate = Carbon::now();
        $sixMonthsFromNow = $currentDate->addMonths(6);
        if ($request->ajax()) {
            $reminderSIP = Pegawai::query()->where('jenis_tenaga', 'nakes')->with(['sip' => function ($query) {
                $query->orderBy('masa_berakhir_sip', 'desc');
            }])->whereHas(
                'sip',
                function ($query) use ($currentDate, $sixMonthsFromNow) {
                    $query->whereDate(
                        'tanggal_terbit_sip',
                        '<=',
                        $currentDate
                    )
                        ->whereDate('masa_berakhir_sip', '>', $currentDate)
                        ->whereDate('masa_berakhir_sip', '>', $sixMonthsFromNow);
                },
                '=',
                0
            )->get();
            $dataPegawai = DataTables::of($reminderSIP)
                ->addIndexColumn()
                ->addColumn('nama', function ($item) {
                    return $item->nama_lengkap ?? $item->nama_depan;
                })
                ->addColumn('pesan', function ($item) {
                    $nowa = $item->no_wa;
                    if (substr(trim($nowa), 0, 1) == '0') {
                        $nowa = '62' . substr(trim($nowa), 1);
                    }
                    $tanggal =  $item->sip->count() > 0 ? Carbon::parse($item->sip[0]->masa_berkahir_sip)->format('d-m-Y') : null;
                    $nama = $item->nama_lengkap ?? $item->nama_depan;
                    $pesan = "https://wa.me/$nowa/?text=SIKEP%0Auntuk :$nama %0A SIP anda  $tanggal, mohon hubungi kepegawaian untuk mengurusi SIP anda";
                    return '<a href="' . $pesan . '" target="_blank" class="btn btn transparent"><i
                                            class="fab fa-whatsapp fa-2x text-success"></i> </a>';
                })
                ->addColumn('masa_berakhir_sip', function ($item) {
                    $data = $item->sip->count() > 0 ? Carbon::parse($item->sip[0]->masa_berakhir_sip)->format('d-m-Y') : 'belum memiliki SIP';
                    return $data ?? '-';
                })
                ->rawColumns(['pesan', 'nama', 'masa_berakhr_sip'])
                ->toJson();
            return  $dataPegawai;
        }
        return view('pages.dashboard.remindersip');
    }
    private function dataLaporan($pegawais)
    {
        $dataLaporan = [];
        foreach ($pegawais as $pegawai) {
            $sip = SIP::where('pegawai_id', $pegawai->id)->orderBy('masa_berakhir_sip', 'desc')->first();
            array_push($dataLaporan, [
                'Nama Pegawai' => $pegawai->nama_lengkap ?? $pegawai->nama_depan,
                'Jabatan' => $pegawai->jabatan,
                'Ruangan' => $pegawai->ruangan->nama_ruangan,
                'Masa Berakhir' => $sip->masa_berakhir_sip ?? null,
                // 'Status' => ,
                'Status' =>  isset($sip->masa_berakhir_sip) ? ($sip->masa_berakhir_sip >= Carbon::parse(now())->format('Y-m-d') ? 'aktif' : 'non-aktif') : null,
                // 'Status' =>  $sip->masa_berakhir_str ?? null,
                'Link SIP' => $sip->link_sip ?? null
            ]);
        }
        $laporan = new SIPExport([
            ['Nama Pegawai', 'Jabatan', 'Ruangan', 'Masa Berakhir', 'Status', 'Link SIP'],
            [...$dataLaporan]
        ]);
        return Excel::download($laporan, 'SIP.xlsx');
    }

    public function export_excel()
    {
        $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('sip', function ($query) {
            $query->orderBy('masa_berakhir_sip', 'desc');
        })->get();
        return $this->dataLaporan($pegawai);
    }
}
