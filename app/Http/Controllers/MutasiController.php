<?php

namespace App\Http\Controllers;

use App\Models\mutasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;


class MutasiController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pegawai = Pegawai::query()->with(['mutasi' => function ($q) {
                $q->orderBy('tanggal_sk', 'desc');
            }])->whereHas('mutasi')->get();
            $dataMutasi = DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('nama', function ($item) {
                    return $item->nama_lengkap ?? $item->nama_depan;
                })
                ->addColumn('ruangan-awal', function ($item) {
                    return $item->mutasi[0]->ruanganAwal->nama_ruangan ?? '-';
                })
                ->addColumn('ruangan-tujuan', function ($item) {
                    return $item->mutasi[0]->ruanganTujuan->nama_ruangan ?? '-';
                })
                ->addColumn('instansi-awal', function ($item) {
                    return $item->mutasi[0]->instansi_awal ?? '-';
                })
                ->addColumn('instansi-tujuan', function ($item) {
                    return $item->mutasi[0]->instansi_tujuan ?? '-';
                })
                ->addColumn('jenis-mutasi', function ($item) {
                    return $item->mutasi[0]->jenis_mutasi;
                })
                ->addColumn('no-sk', function ($item) {
                    return $item->mutasi[0]->no_sk;
                })
                ->addColumn('tanggal-berlaku', function ($item) {
                    return Carbon::parse($item->mutasi[0]->tanggal_berlaku)->format('d/m/Y');
                })
                
                ->addColumn('surat', 'pages.surat.mutasi')
                ->addColumn('aksi', function ($item) {
                    $show = "<a href='" . route('admin.mutasi.show', ['mutasi' => $item->mutasi[0]]) . "'
                                        class='badge p-2 text-white bg-info mr-1'><i class='fas fa-info-circle'></i></a>";
                    $edit = "<a href='" . route('admin.mutasi.edit', ['mutasi' => $item->mutasi[0]]) . "'
                                        class='badge p-2 text-white bg-warning mr-1'><i class='fas fa-pen'></i></a>";
                    return "<div class='d-flex'>$show $edit</div>";
                })
                ->rawColumns(['nama','ruangan-awal','ruangan-tujuan','instansi-awal','instansi-tujuan','jenis-mutasi','no-sk','tanggal-berlaku','surat','aksi'])
                ->toJson();
            return $dataMutasi;
        }
        $mutasi = Mutasi::orderBy('tanggal_sk', 'desc')->with('pegawai')->get();
        $pegawai =  Pegawai::with(['mutasi' => function ($q) {
            $q->orderBy('tanggal_sk', 'desc');
        }])->whereHas('mutasi')->get();
        return view(
            'pages.mutasi.index',
            [

                'pegawai' => $pegawai,
                'i' => 0,
            ]
        );
    }
    public function create()
    {

        $pegawai = Pegawai::all();
        return view('pages.mutasi.create', ['pegawai' => $pegawai]);
    }
    public function store(Request $request)
    {
        // return $request->all();
        $pegawai = Pegawai::find($request->pegawai_id);
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->first();
        if ($request->jenis_mutasi == 'internal') {
            if ($mutasi) {
                Carbon::parse($mutasi->tanggal_sk) <= Carbon::parse($request->tanggal_sk) ? $pegawai->update(['ruangan_id' => $request->ruangan_tujuan_id]) : null;
            } else {
                $bandingkan = Carbon::parse($pegawai->created_at)->format('Y-m-d') <= Carbon::parse($request->tanggal_sk)->format('Y-m-d');
                $bandingkan ?  $pegawai->update(['ruangan_id' => $request->ruangan_tujuan_id]) : null;
            }
            // return $pegawai->created_at;
            $request->validate(
                [
                    'pegawai_id' => '',
                    'tanggal_berlaku' => 'required|date',
                    'ruangan_awal_id' => 'required',
                    'ruangan_tujuan_id' => 'required',
                    'no_sk' => 'required',
                    'tanggal_sk' => 'required|date',
                    'link_sk' => 'required',
                ]
            );
        } else {
            $pegawai->update(['status_pegawai' => 'nonaktif']);
            $validatedData =   $request->validate(
                [
                    'pegawai_id' => '',
                    'tanggal_berlaku' => 'required|date',
                    'no_sk' => 'required',
                    'tanggal_sk' => 'required|date',
                    'link_sk' => 'required',
                    'instansi_awal' => 'required',
                    'instansi_tujuan' => 'required'
                ]
            );
        }
        $mutasi = Mutasi::create(request()->all());
        return redirect()->route('admin.mutasi.index')->with('success', 'data mutasi pegawai berhasil ditambahkan');
        //code...

    }



    public function edit(Mutasi $mutasi)
    {
        return view('pages.mutasi.edit', [
            'mutasi' => $mutasi,
            'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get()
        ]);
    }

    public function show(Mutasi $mutasi)
    {
        return view('pages.mutasi.show', [
            'mutasi' => $mutasi
        ]);
    }


    public function history(Pegawai $pegawai)
    {
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.mutasi.history', [
            'pegawai' => $pegawai,
            'mutasi' => $mutasi
        ]);
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        //   return request()->all();
        try {
            $pegawai = Pegawai::find($mutasi->pegawai_id);
            $mutasiTerbaru = Mutasi::orderBy('tanggal_sk', 'desc')->first();
            $perbandinganMutasi = Carbon::parse($mutasi->tanggal_sk) >= Carbon::parse($mutasiTerbaru->tanggal_sk);
            $validatedData = [];
            if ($request->jenis_mutasi == 'internal') {
                $pegawai->update(['status_pegawai' => 'aktif']);
                if ($perbandinganMutasi) {
                    $perbandinganPegawai = Carbon::parse($request->tanggal_sk) >= Carbon::parse($pegawai->created_at);
                    $perbandinganPegawai ? $pegawai->update(['ruangan_id' => $request->ruangan_tujuan_id]) : $pegawai->update(['ruangan_id' => $mutasi->ruangan_awal_id]);
                } else {
                    $perbandinganPegawai = Carbon::parse($mutasiTerbaru->tanggal_sk) >= Carbon::parse($pegawai->created_at);
                    $perbandinganPegawai ? $pegawai->update(['ruangan_id' => $mutasiTerbaru->ruangan_tujuan_id]) : $pegawai->update(['ruangan_id' => $mutasiTerbaru->ruangan_awal_id]);
                }
                $validatedData =   $request->validate(
                    [
                        'tanggal_berlaku' => 'required|date',
                        'no_sk' => 'required',
                        'tanggal_sk' => 'required|date',
                        'link_sk' => 'required',
                        'ruangan_awal_id' => 'required',
                        'ruangan_tujuan_id' => 'required',
                    ],
                    [
                        'ruangan_awal_id.required' => ' ruangan awal id tidak ada',
                        'ruangan_tujuan_id.required' => ' ruangan tujuan id tidak ada',
                    ]
                );
                $mutasi->update([
                    'tanggal_berlaku' => $request->tanggal_berlaku,
                    'no_sk' => $request->no_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'link_sk' => $request->link_sk,
                    'ruangan_awal_id' => $request->ruangan_awal_id,
                    'ruangan_tujuan_id' => $request->ruangan_tujuan_id,
                    'instansi_awal' => null,
                    'intansi_tujuan' => null
                ]);
            } else {
                $pegawai->update(['status_pegawai' => 'nonaktif']);
                $validatedData =   $request->validate(
                    [
                        'pegawai_id' => '',
                        'tanggal_berlaku' => 'required|date',
                        'no_sk' => 'required',
                        'tanggal_sk' => 'required|date',
                        'link_sk' => 'required',
                        'instansi_awal' => 'required',
                        'instansi_tujuan' => 'required'
                    ]
                );
                $mutasi->update([
                    'tanggal_berlaku' => $request->tanggal_berlaku,
                    'no_sk' => $request->no_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'link_sk' => $request->link_sk,
                    'ruangan_awal_id' => null,
                    'ruangan_tujuan_id' => null,
                    'instansi_awal' => $request->instansi_awal,
                    'instansi_tujuan' => $request->instansi_tujuan
                ]);
            }


            return redirect()->route('admin.mutasi.index')->with('success', 'data mutasi pegawai berhasil diupdate');

            //code...
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
