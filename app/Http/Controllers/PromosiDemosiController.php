<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Ruangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PromosiDemosi;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PromosiDemosiController extends Controller
{
    public function Demosiindex()
    {
        return view('pages.promosiDemosi.demosi.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Demosicreate()
    {

        return view(
            'pages.promosiDemosi.demosi.create',
            [
                'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get()
            ]
        );
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function show(PromosiDemosi $promosiDemosi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function edit(PromosiDemosi $promosiDemosi)
    {
        return view('pages.promosiDemosi.demosi.edit');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromosiDemosi $promosiDemosi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromosiDemosi $promosiDemosi)
    {
        //
    }

    // promosi
    public function Promosicreate()
    {
        return view(
            'pages.promosiDemosi.promosi.create',
            [
                'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get()
            ]
        );
    }
    public function PromosiStore(Request $request)
    {
        // return auth()->user();
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            alert()->error('mohon masukkan nama Pegawai');
            return redirect()->back();
        }
        $pegawai->update(['promosiDemosi' => $request->jabatan_baru]);
        PromosiDemosi::create($request->all());
        alert()->success('Promosi PromosiDemosi ' . $pegawai->nama_lengkap . 'berhasil di buat oleh ' . auth()->user()->name);
        return redirect()->route('admin.jabatan.promosi.index');
    }

    public function Promosiedit()
    {

        return view(
            'pages.promosiDemosi.promose.edit',
            [
                'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get()
            ]
        );
        //
    }
    public function Promosiindex(Request $request)
    {
        $jabatan_terakhir = Pegawai::whereHas('promosiDemosi')->with(['promosiDemosi' => function ($q) {
            $q->orderBy('created_at', 'desc');
        if ($request->ajax()) {
            $promosi = PromosiDemosi::query()->where('type', 'promosi')->orderBy('created_at', 'desc');
            if ($request->input('pegawai') != null) {
                $promosi->where('pegawai_id', 'pegawai');
            }
            
            if ($request->input('tahun') != null) {
                $promosi->where('tanggal_sk','like','%'.$request->tahun.'%');
            }
            return DataTables::of($promosi)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($item) {
                    return $item->pegawai->nama_lengkap ?? $item->id;
                })
                ->addColumn('status_tombol', function ($item) use ($jabatan_terakhir) {
                    $data = 'nonaktif';
                    foreach ($jabatan_terakhir as $pegawai) {
                        if (isset($pegawai->promosiDemosi) &&  $pegawai->promosiDemosi[0]->id == $item->id) {
                            $data = 'aktif';
                            break;
                        }
                    }
                    $warna = $data == 'aktif' ? 'btn btn-success' : 'btn btn-secondary';
                    return "<div class='$warna'>$data</div>";
                })
                ->addColumn('ruangan', function ($item) {
                    return $item->pegawai->ruangan->nama_ruangan;
                })
                ->addColumn('aksi', 'pages.promosiDemosi.promosi.part.aksi')
                ->rawColumns(['nama_lengkap', 'aksi', 'status_tombol', 'ruangan'])
                ->make(true);
        }
        // return Ruangan::all();
        return view(
            'pages.promosiDemosi.promosi.index',
            [
                'ruangans' => Ruangan::orderBy('nama_ruangan', 'desc')->get(),
                'pegawais' => Pegawai::orderBy('nama_lengkap')->get()
            ]
        );
    }
}
