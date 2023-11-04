<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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
            ]);

            $sip = SIP::create([
                'pegawai_id' => $request->pegawai_id,
                'no_sip' => $request->no_sip,
                'no_rekomendasi' => $request->no_rekomendasi,
                'no_str' => $request->no_str,
                'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
                'masa_berakhir_sip' => $request->masa_berakhir_sip,
                'link_sip' => $request->link_sip
            ]);
            $notif = Notifikasi::notif('str', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($sip->pegawai->id);
            alert()->success('berhasil', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name);
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
        // return $str;
        $notif = Notifikasi::notif('sip', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($sip->pegawai->id);
        alert()->success('berhasil', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name);
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
                    $data = $item->sip->count() > 0 ? Carbon::parse($item->sip[0]->masa_berakhir_sip)->format('d-m-Y') : '-';
                    return $data ?? '-';
                })
                ->rawColumns(['pesan', 'nama', 'masa_berakhr_sip'])
                ->toJson();
            return  $dataPegawai;
        }
        return view('pages.dashboard.remindersip');
    }
}
