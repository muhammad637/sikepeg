<?php

namespace App\Http\Controllers;

use App\Models\PromosiDemosi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
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
        return redirect()->route('admin.promosiDemosi.promosi.index');
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
        $promosi = PromosiDemosi::where('type', 'promosi')->orderBy('created_at', 'desc');
        $jabatan_terakhir = Pegawai::whereHas('promosiDemosi', function ($q) {
            $q->orderBy('created_at', 'desc');
        })->with('promosiDemosi')->get();
        if ($request->ajax()) {
            if ($request->has('pegawai')) {
                $promosi->where('pegawai_id', 'pegawai');
            }
            if ($request->has('ruangan')) {
                $promosi->with(['pegawai' => function ($q) {
                    $q->where('ruangan_id', 'ruangan');
                }]);
            }
            if ($request->has('promosiDemosi')) {
                $promosi->where('promosiDemosi', $request->promosiDemosi);
            }
            return DataTables::of($promosi)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($item) {
                    return $item->pegawai->nama_lengkap;
                })
                ->addColumn('status_tombol', function ($item) use ($jabatan_terakhir) {
                    // Cek apakah status ini adalah promosi terakhir untuk pegawai tertentu
                    $isLatestPromotion = $item->id === optional($jabatan_terakhir)->promosiDemosi[0]->id;
                    return $isLatestPromotion ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('ruangan', function ($item) {
                    return $item->pegawai->ruangan->nama_ruangan;
                })
                ->addColumn('aksi', 'pages.promosiDemosi.promosi.part.aksi')
                ->rawColumns(['nama_lengkap', 'aksi', 'status_tombol', 'ruangan'])
                ->make(true);
        }
        return view('pages.promosiDemosi.promosi.index',);
    }
}
