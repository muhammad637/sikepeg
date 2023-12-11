<?php

namespace App\Http\Controllers;

use App\Models\mutasi;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Notifikasi;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;


class MutasiController extends Controller
{
    //
    public function index(Request $request)
    {
        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc');

        if ($request->ajax()) {
            $pegawai = Pegawai::query()->with(['mutasi' => function ($q) {
                $q->orderBy('created_at', 'desc')->orderBy('tanggal_sk', 'desc');
            }])->whereHas('mutasi');
            if ($request->input('ruangan_tujuan') != null) {
                $pegawai->where('ruangan_id', $request->ruangan_tujuan);
            }
            if ($request->input('jenis_mutasi') != null) {
                $pegawai->whereHas('mutasi', function ($q) use ($request) {
                    $q->where('jenis_mutasi', $request->jenis_mutasi);
                });
            }
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
                ->addColumn('aksi', 'pages.mutasi.part.aksi-index')
                ->rawColumns(['nama', 'ruangan-awal', 'ruangan-tujuan', 'instansi-awal', 'instansi-tujuan', 'jenis-mutasi', 'no-sk', 'tanggal-berlaku', 'surat', 'aksi'])
                // ->toJson()
                ->make(true);
            return $dataMutasi;
        }
        $mutasi = Mutasi::orderBy('tanggal_sk', 'desc')->with('pegawai')->get();
        $pegawai =  Pegawai::with(['mutasi' => function ($q) {
            $q->orderBy('tanggal_sk', 'desc');
        }])->whereHas('mutasi')->get();
        // session()->flash('rute',route('admin.mutasi.index'));
        return view(
            'pages.mutasi.index',
            [
                'pegawai' => $pegawai,
                'ruangans' => $ruangan,
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
        try {
            //code...
            // return $request->all();
            $ruangan_awal_id = $request->ruangan_awal_id;
            $ruangan_tujuan_id = $request->ruangan_tujuan_id;
            if ($request->ruangan_awal_id == 'lainnya') {
                $request->validate(
                    [
                        'tambah_ruangan_awal' => 'required|unique:ruangans,nama_ruangan'
                    ],
                    [
                        'tambah_ruangan_awal.unique' => 'nama ruangan yang anda inputkan sudah ada'
                    ]
                );
                $ruangan_awal = Ruangan::create([
                    'nama_ruangan' => $request->tambah_ruangan_awal,
                ]);
                $ruangan_awal_id = $ruangan_awal->id;
            }
            if ($request->ruangan_tujuan_id == 'lainnya') {
                if ($request->tambah_ruangan_awal == $request->tambah_ruangan_tujuan) {
                    $ruangan_tujuan = Ruangan::create([
                        'nama_ruangan' => $request->tambah_ruangan_tujuan,
                    ]);
                } else {
                    $request->validate(
                        [
                            'tambah_ruangan_tujuan' => 'unique:ruangans,nama_ruangan'
                        ],
                        [
                            'tambah_ruangan_tujuan' => 'nama ruangan yang anda inputkan sudah ada'
                        ]
                    );
                    $ruangan_tujuan = Ruangan::create([
                        'nama_ruangan' => $request->tambah_ruangan_tujuan,
                    ]);
                }
                $ruangan_tujuan_id = $ruangan_tujuan->id;
            }
            $pegawai = Pegawai::find($request->pegawai_id);
            $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->first();
            // if()
            if ($request->jenis_mutasi == 'internal') {
                if ($mutasi) {
                    Carbon::parse($mutasi->tanggal_sk) <= Carbon::parse($request->tanggal_sk) ? $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]) : null;
                } else {
                    $bandingkan = Carbon::parse($pegawai->created_at)->format('Y-m-d') <= Carbon::parse($request->tanggal_sk)->format('Y-m-d');
                    $bandingkan ?  $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]) : null;
                }

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
                $mutasi = Mutasi::create([
                    'pegawai_id' => $request->pegawai_id,
                    'tanggal_berlaku' => $request->tanggal_berlaku,
                    'ruangan_awal_id' => $ruangan_awal_id,
                    'ruangan_tujuan_id' => $ruangan_tujuan_id,
                    'no_sk' => $request->no_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'link_sk' => $request->link_sk,
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
                $mutasi = Mutasi::create(request()->all());
            }
            $notif = Notifikasi::notif('mutasi', 'mutasi  pegawai ' . $mutasi->pegawai->nama_lengkap . ' berhasil  ditambahkan oleh ' . auth()->user()->name, 'bg-success', 'fas fa-compress-alt');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);
            alert()->success('mutasi', 'mutasi  pegawai ' . $mutasi->pegawai->nama_lengkap . ' berhasil  ditambahkan oleh ' . auth()->user()->name);
            return redirect()->route('admin.mutasi.index')->with('success', 'data mutasi pegawai berhasil ditambahkan');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            // return $th->getMessage();
            alert()->error($th->getMessage());
            return redirect()->back()->withInput();
        }
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




    public function update(Request $request, Mutasi $mutasi)
    {
        //  return request()->all();
        try {
            // return $request->all();
            $mutasi->pegawai->update(['status_pegawai' => 'aktif']);
            $ruangan_awal_id = $request->ruangan_awal_id;
            $ruangan_tujuan_id = $request->ruangan_tujuan_id;
            if ($request->ruangan_awal_id == 'lainnya') {
                $request->validate(
                    [
                        'tambah_ruangan_awal' => 'required|unique:ruangans,nama_ruangan'
                    ],
                    [
                        'tambah_ruangan_awal.unique' => 'nama ruangan yang anda inputkan sudah ada'
                    ]
                );
                $ruangan_awal = Ruangan::create([
                    'nama_ruangan' => $request->tambah_ruangan_awal,
                ]);
                $ruangan_awal_id = $ruangan_awal->id;
            }
            if ($request->ruangan_tujuan_id == 'lainnya') {
                if ($request->tambah_ruangan_awal == $request->tambah_ruangan_tujuan) {
                    $ruangan_tujuan = $ruangan_awal;
                } else {
                    $request->validate(
                        [
                            'tambah_ruangan_tujuan' => 'unique:ruangans,nama_ruangan'
                        ],
                        [
                            'tambah_ruangan_tujuan' => 'nama ruangan yang anda inputkan sudah ada'
                        ]
                    );
                    $ruangan_tujuan = Ruangan::create([
                        'nama_ruangan' => $request->tambah_ruangan_tujuan,
                    ]);
                }
                $ruangan_tujuan_id = $ruangan_tujuan->id;
            }
            $pegawai = Pegawai::find($request->pegawai_id);
            $mutasiTerbaru = Mutasi::orderBy('tanggal_sk', 'desc')->first();
            $perbandinganMutasi = Carbon::parse($mutasi->tanggal_sk) >= Carbon::parse($mutasiTerbaru->tanggal_sk);
            $validatedData = [];
            if ($request->jenis_mutasi == 'internal') {
                $pegawai->update(['status_pegawai' => 'aktif']);
                if ($perbandinganMutasi && $request->jenis_mutasi == $mutasi->jenis_mutasi) {
                    $perbandinganPegawai = Carbon::parse($request->tanggal_sk) >= Carbon::parse($pegawai->created_at);
                    $perbandinganPegawai ? $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]) : $pegawai->update(['ruangan_id' => $mutasi->ruangan_awal_id]);
                } elseif ($perbandinganMutasi && $request->jenis_mutasi != $mutasi->jenis_mutasi) {
                    $perbandinganPegawai = Carbon::parse($request->tanggal_sk) >= Carbon::parse($pegawai->created_at);
                    $perbandinganPegawai ? $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]) : null;
                    // $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]);
                }
                // else {
                //     // dd($ruangan_tujuan_id);
                //     $perbandinganPegawai = Carbon::parse($mutasiTerbaru->tanggal_sk) >= Carbon::parse($pegawai->created_at);    
                //     $perbandinganPegawai ? $pegawai->update(['ruangan_id' => $mutasiTerbaru->ruangan_tujuan_id]) : $pegawai->update(['ruangan_id' => $mutasiTerbaru->ruangan_awal_id]);
                // }
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
                    'pegawai_id' => $request->pegawai_id,
                    'tanggal_berlaku' => $request->tanggal_berlaku,
                    'jenis_mutasi' => $request->jenis_mutasi,
                    'no_sk' => $request->no_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'link_sk' => $request->link_sk,
                    'ruangan_awal_id' => $ruangan_awal_id,
                    'ruangan_tujuan_id' => $ruangan_tujuan_id,
                    'instansi_awal' => null,
                    'instansi_tujuan' => null
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
                    'pegawai_id' => $request->pegawai_id,
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

            $notif = Notifikasi::notif('mutasi', 'mutasi  pegawai ' . $mutasi->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-compress-alt');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);
            alert()->success('mutasi', 'mutasi  pegawai ' . $mutasi->pegawai->nama_lengkap . ' berhasil  ditambahkan oleh ' . auth()->user()->name);
            return redirect()->route('admin.mutasi.index')->with('success', 'data mutasi pegawai berhasil diupdate');

            //code...
        } catch (\Throwable $th) {
            alert()->error('gagal', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Mutasi $mutasi)
    {
        $data_mutasi = Mutasi::where('pegawai_id', $mutasi->pegawai_id)->orderBy('tanggal_sk', 'desc')->orderBy('created_at', 'desc')->first();
        $pegawai = Pegawai::find($mutasi->pegawai_id);
        $data_mutasi_internal = Mutasi::where('pegawai_id', $mutasi->pegawai_id)->where('jenis_mutasi', 'internal')->orderBy('tanggal_sk', 'desc')->orderBy('created_at', 'desc')->first();
        $perbandinganMutasi = Carbon::parse($mutasi->tanggal_berlaku) >= Carbon::parse($data_mutasi->tanggal_berlaku);
        if ($data_mutasi_internal && $perbandinganMutasi) {
            if ($mutasi->jenis_mutasi == 'internal') {
                $pegawai->update(['ruangan_id' => $mutasi->ruangan_awal_id]);
            } elseif ($mutasi->jenis_tenaga == 'eksternal') {
                $pegawai->update(['ruangan_id' => $data_mutasi_internal->ruangan_awal_id, 'status_pegawai' => 'aktif']);
            }
        }
        $mutasi->delete();
        alert()->success('data mutasi berhasil dihapus');
        return redirect()->back();
    }
    public function history(Pegawai $pegawai, Request $request)
    {
        if ($request->ajax()) {
            $mutasi = Mutasi::query()->where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc');
            $dataMutasi = DataTables::of($mutasi)
                ->addIndexColumn()
                ->addColumn('nama', function ($item) {
                    return $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan;
                })
                ->addColumn('ruangan-awal', function ($item) {
                    return $item->ruanganAwal->nama_ruangan ?? '-';
                })
                ->addColumn('ruangan-tujuan', function ($item) {
                    return $item->ruanganTujuan->nama_ruangan ?? '-';
                })
                ->addColumn('instansi-awal', function ($item) {
                    return $item->instansi_awal ?? '-';
                })
                ->addColumn('instansi-tujuan', function ($item) {
                    return $item->instansi_tujuan ?? '-';
                })
                ->addColumn('jenis-mutasi', function ($item) {
                    return $item->jenis_mutasi;
                })
                ->addColumn('no-sk', function ($item) {
                    return $item->no_sk;
                })
                ->addColumn('tanggal-berlaku', function ($item) {
                    return Carbon::parse($item->tanggal_berlaku)->format('d/m/Y');
                })

                ->addColumn('surat', 'pages.mutasi.part.surat-riwayat')
                ->addColumn('aksi', 'pages.mutasi.part.aksi-riwayat')
                ->rawColumns(['nama', 'ruangan-awal', 'ruangan-tujuan', 'instansi-awal', 'instansi-tujuan', 'jenis-mutasi', 'no-sk', 'tanggal-berlaku', 'surat', 'aksi'])
                ->toJson();
            return $dataMutasi;
        }
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.mutasi.riwayat.index', [
            'pegawai' => $pegawai,
            'mutasi' => $mutasi
        ]);
    }
    public function historyEdit(Mutasi $mutasi)
    {
        return view('pages.mutasi.riwayat.edit', [
            'mutasi' => $mutasi,
            'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get()
        ]);
    }

    public function historyShow(Mutasi $mutasi)
    {
        return view('pages.mutasi.riwayat.show', [
            'mutasi' => $mutasi
        ]);
    }
}
