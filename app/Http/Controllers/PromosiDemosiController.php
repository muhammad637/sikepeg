<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Exports\Export;
use App\Models\Pegawai;
use App\Models\Ruangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PromosiDemosi;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PromosiDemosiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

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
    
    public function PromosiShow(PromosiDemosi $promosiDemosi)
    {
        return view(
            'pages.promosiDemosi.promosi.show',
            [
                'promosiDemosi' => $promosiDemosi
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
        $pegawai->update(['jabatan' => $request->jabatan_selanjutnya]);
        PromosiDemosi::create($request->all());
        alert()->success('Promosi PromosiDemosi ' . $pegawai->nama_lengkap . 'berhasil di buat oleh ' . auth()->user()->name);
        return redirect()->route('admin.jabatan.promosi.index');
    }

    public function Promosiedit(PromosiDemosi $promosiDemosi)
    {
        return view('pages.promosiDemosi.promosi.edit', [
            'promosiDemosi' => $promosiDemosi
        ]);
    }

    public function PromosiUpdate(Request $request, PromosiDemosi $promosiDemosi)
    {
        $pegawai = Pegawai::with(['promosiDemosi' => function ($item) {
            $item->orderBy('tanggal_berlaku', 'desc');
        }])->find($promosiDemosi->pegawai_id);
        if ($pegawai->promosiDemosi[0]->id == $promosiDemosi->id) {
            $pegawai->update(['jabatan', $request->jabatan_selanjutnya]);
        }
        $promosiDemosi->update($request->all());
        alert()->success('data berhasil diupdate');
        return redirect()->route('admin.jabatan.promosi.index');
    }

    public function PromosiDestroy(PromosiDemosi $promosiDemosi)
    {
        $pegawai = Pegawai::with(['promosiDemosi' => function ($item) {
            $item->orderBy('tanggal_berlaku', 'desc');
        }])->find($promosiDemosi->pegawai_id);
        if ($pegawai->promosiDemosi[0]->id == $promosiDemosi->id) {
            $pegawai->update(['jabatan', $promosiDemosi->jabatan_sebelumnya]);
        }
        $promosiDemosi->delete();
        alert()->success('data berhasil dihapus');
        return redirect()->route('admin.jabatan.promosi.index');
    }

    public function Promosiindex(Request $request)
    {
        $jabatan_terakhir = Pegawai::whereHas('promosiDemosi')->with(['promosiDemosi' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->get();
        if ($request->ajax()) {
            $promosi = PromosiDemosi::query()->where('type', 'promosi')->orderBy('created_at', 'desc');
            if ($request->input('pegawai') != null) {
                $promosi->where('pegawai_id', $request->pegawai);
            }
            if ($request->input('ruangan') != null) {
                $promosi->where('ruangan_id', $request->ruangan);
            }
            if ($request->input('tahun') != null) {
                $promosi->where('tanggal_sk', 'like', '%' . $request->tahun . '%');
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

    public function Riwayat(Request $request)
    {
        $jabatan_terakhir = Pegawai::whereHas('promosiDemosi')->with(['promosiDemosi' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->get();
        if ($request->ajax()) {
            $promosi = PromosiDemosi::query()->where('pegawai_id', $request->pegawai_id)->orderBy('created_at', 'desc');
            return DataTables::of($promosi)
                ->addIndexColumn()

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

                ->addColumn('aksi', 'pages.promosiDemosi.promosi.part.aksi')
                ->rawColumns(['aksi', 'status_tombol'])
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
    private function dataLaporan($promosiDemosi)
    {
        $dataLaporan = [];
        foreach ($promosiDemosi as $item) {
            array_push($dataLaporan, [
                'Nama Pegawai' => $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan,
                'Tipe' => $item->type,
                'jabatan sebelumnya' => $item->jabatan_sebelumnya,
                'jabatan selanjutnya' => $item->jabatan_selanjutnya,
                'No SK' => $item->no_sk,
                'Tanggal Berlaku' => Carbon::parse($item->tanggal_berlaku)->format('d/m/Y'),
                'Tanggal SK' => Carbon::parse($item->tanggal_sk)->format('d/m/Y'),
                'link SK' => $item->link_sk ?? '-',
            ]);
        }
        // return $dataLaporan;
        $laporan = new Export([
            ['Nama Pegawai', 'TIpe', 'Jabatan Sebelumnya', 'Jabatan Selanjutnya', 'No SK', 'Tanggal Berlaku', 'Tanggal SK', 'Link SK'],
            [...$dataLaporan]
        ]);

        return Excel::download($laporan, 'jabatan.xlsx');
    }

    public function export_excel(Request $request)
    {
        // return $request->all();
        $promosiDemosi = PromosiDemosi::orderBy('tanggal_berlaku', 'desc')->orderBy('pegawai_id', 'asc');
        if ($request->input('year') != null) {
            $promosiDemosi->where('tanggal_sk', 'like', '%' . $request->year . '%');
        }
        if ($request->input('pegawai_id') != null) {
            $promosiDemosi->where('pegawai_id', $request->pegawai_id);
        }
        if ($request->input('type') != null) {
            $promosiDemosi->where('type', $request->type);
        }
        // return $promosiDemosi->get();
        return $this->dataLaporan($promosiDemosi->get());
    }

    public function Demosiindex(Request $request)
    {
        $jabatan_terakhir = Pegawai::whereHas('promosiDemosi')->with(['promosiDemosi' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->get();
        if ($request->ajax()) {
            $promosi = PromosiDemosi::query()->where('type', 'demosi')->orderBy('created_at', 'desc');
            if ($request->input('pegawai') != null) {
                $promosi->where('pegawai_id', $request->pegawai);
            }
            if ($request->input('ruangan') != null) {
                $promosi->where('ruangan_id', $request->ruangan);
            }
            if ($request->input('tahun') != null) {
                $promosi->where('tanggal_sk', 'like', '%' . $request->tahun . '%');
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
                ->addColumn('aksi', 'pages.promosiDemosi.demosi.part.aksi')
                ->rawColumns(['nama_lengkap', 'aksi', 'status_tombol', 'ruangan'])
                ->make(true);
        }
        // return Ruangan::all();
        return view(
            'pages.promosiDemosi.demosi.index',
            [
                'ruangans' => Ruangan::orderBy('nama_ruangan', 'desc')->get(),
                'pegawais' => Pegawai::orderBy('nama_lengkap')->get()
            ]
        );
    }
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
    public function DemosiShow(PromosiDemosi $promosiDemosi)
    {
        return view(
            'pages.promosiDemosi.demosi.show',
            [
                'promosiDemosi' => $promosiDemosi
            ]
        );
    }
    public function DemosiStore(Request $request)
    {
        // return auth()->user();
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            alert()->error('mohon masukkan nama Pegawai');
            return redirect()->back();
        }
        $pegawai->update(['jabatan' => $request->jabatan_selanjutnya]);
        PromosiDemosi::create($request->all());
        alert()->success('Promosi PromosiDemosi ' . $pegawai->nama_lengkap . 'berhasil di buat oleh ' . auth()->user()->name);
        return redirect()->route('admin.jabatan.demosi.index');
    }

    public function Demosiedit(PromosiDemosi $promosiDemosi)
    {
        return view('pages.promosiDemosi.demosi.edit', [
            'promosiDemosi' => $promosiDemosi
        ]);
    }

    public function DemosiUpdate(Request $request, PromosiDemosi $promosiDemosi)
    {
        $pegawai = Pegawai::with(['promosiDemosi' => function ($item) {
            $item->orderBy('tanggal_berlaku', 'desc');
        }])->find($promosiDemosi->pegawai_id);
        if ($pegawai->promosiDemosi[0]->id == $promosiDemosi->id) {
            $pegawai->update(['jabatan', $request->jabatan_selanjutnya]);
        }
        $promosiDemosi->update($request->all());
        alert()->success('data berhasil diupdate');
        return redirect()->route('admin.jabatan.demosi.index');
    }

   
}
