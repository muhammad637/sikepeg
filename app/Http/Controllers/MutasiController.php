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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export;



class MutasiController extends Controller
{
    //
    public function index(Request $request)
    {
        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        $mutasi_terakhir = Pegawai::whereHas('mutasi')->with(['mutasi' => function ($q) {
            $q->orderBy('tanggal_sk', 'desc');
        }])->get();
        // return Mutasi::with('ruanganAwal', 'ruanganTujuan')->get();
        if ($request->ajax()) {
            $mutasi = Mutasi::query()->orderBy('pegawai_id', 'asc')->orderBy('tanggal_sk', 'desc');
            if ($request->input('ruangan_awal') != null) {
                $mutasi->where('ruangan_awal_id', $request->ruangan_awal);
            }
            if ($request->input('ruangan_tujuan') != null) {
                $mutasi->where('ruangan_tujuan_id', $request->ruangan_tujuan);
            }
            if ($request->input('tahun') != null) {
                $mutasi->where('tanggal_sk', 'like', '%' . $request->tahun . '%');
            }
            if ($request->input('jenis_mutasi') != null) {
                $mutasi->where('jenis_mutasi', $request->jenis_mutasi);
            }
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
                ->addColumn('status_tombol', function ($item) use ($mutasi_terakhir) {
                    $data = 'nonaktif';
                    foreach ($mutasi_terakhir as $pegawai) {
                        if (isset($pegawai->mutasi) &&  $pegawai->mutasi[0]->id == $item->id) {
                            $data = 'aktif';
                            break;
                        }
                    }
                    $warna = $data == 'aktif' ? 'btn btn-success' : 'btn btn-secondary';
                    return "<div class='$warna'>$data</div>";
                })
                ->addColumn('surat', 'pages.surat.mutasi')
                ->addColumn('aksi', 'pages.mutasi.part.aksi-index')
                ->rawColumns(['nama', 'ruangan-awal', 'ruangan-tujuan', 'instansi-awal', 'instansi-tujuan', 'jenis-mutasi', 'no-sk', 'tanggal-berlaku', 'surat', 'status_tombol', 'aksi'])
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
            // Ekstraksi data dari request
            $ruangan_awal_id = $request->ruangan_awal_id;
            $ruangan_tujuan_id = $request->ruangan_tujuan_id;

            # Penanganan kasus khusus untuk 'lainnya' pada ruangan_awal_id
            if ($request->ruangan_awal_id == 'lainnya') {
                $request->validate(
                    [
                        'tambah_ruangan_awal' => 'required|unique:ruangans,nama_ruangan'
                    ],
                    [
                        'tambah_ruangan_awal.unique' => 'Nama ruangan yang Anda inputkan sudah ada.'
                    ]
                );

                // Membuat objek Ruangan baru untuk ruangan_awal
                $ruangan_awal = Ruangan::create([
                    'nama_ruangan' => $request->tambah_ruangan_awal,
                ]);

                $ruangan_awal_id = $ruangan_awal->id;
            }

            // Penanganan kasus khusus untuk 'lainnya' pada ruangan_tujuan_id
            if ($request->ruangan_tujuan_id == 'lainnya') {
                // Memeriksa apakah nama ruangan_awal dan ruangan_tujuan sama
                if ($request->tambah_ruangan_awal == $request->tambah_ruangan_tujuan) {
                    // Membuat objek Ruangan baru untuk ruangan_tujuan
                    $ruangan_tujuan = Ruangan::create([
                        'nama_ruangan' => $request->tambah_ruangan_tujuan,
                    ]);
                } else {
                    $request->validate(
                        [
                            'tambah_ruangan_tujuan' => 'unique:ruangans,nama_ruangan'
                        ],
                        [
                            'tambah_ruangan_tujuan.unique' => 'Nama ruangan yang Anda inputkan sudah ada.'
                        ]
                    );

                    // Membuat objek Ruangan baru untuk ruangan_tujuan
                    $ruangan_tujuan = Ruangan::create([
                        'nama_ruangan' => $request->tambah_ruangan_tujuan,
                    ]);
                }

                $ruangan_tujuan_id = $ruangan_tujuan->id;
            }

            // Menemukan objek Pegawai berdasarkan pegawai_id yang diberikan
            $pegawai = Pegawai::find($request->pegawai_id);

            // Mendapatkan record Mutasi terbaru untuk Pegawai
            $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->first();

            // Menangani mutasi internal
            if ($request->jenis_mutasi == 'internal') {
                if ($mutasi) {
                    // Memperbarui ruangan_id Pegawai jika mutasi terbaru sebelum atau sama dengan tanggal mutasi baru
                    Carbon::parse($mutasi->tanggal_sk) <= Carbon::parse($request->tanggal_sk) ? $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]) : null;
                } else {
                    $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]);
                }

                // Validasi data request untuk mutasi internal
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

                // Membuat record Mutasi baru untuk mutasi internal
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
                // Menonaktifkan Pegawai untuk mutasi non-internal
                $pegawai->update(['status_pegawai' => 'nonaktif']);

                // Validasi data request untuk mutasi non-internal
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

                // Membuat record Mutasi baru untuk mutasi non-internal
                $mutasi = Mutasi::create(request()->all());
            }

            // Membuat notifikasi untuk tindakan mutasi
            $notif = Notifikasi::notif('mutasi', 'Mutasi pegawai ' . $mutasi->pegawai->nama_lengkap . ' berhasil ditambahkan oleh ' . auth()->user()->name, 'bg-success', 'fas fa-compress-alt');
            $createNotif = Notifikasi::create($notif);

            // Mengasosiasikan notifikasi dengan admin dan pegawai
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);

            // Menampilkan pesan sukses dan mengarahkan ke halaman indeks mutasi
            alert()->success('Mutasi', 'Mutasi pegawai ' . $mutasi->pegawai->nama_lengkap . ' berhasil ditambahkan oleh ' . auth()->user()->name);
            return redirect()->route('admin.mutasi.index')->with('success', 'Data mutasi pegawai berhasil ditambahkan');
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengarahkan kembali dengan input
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
                if ($perbandinganMutasi) {
                    $pegawai->update(['ruangan_id' => $ruangan_tujuan_id]);
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
    private function dataLaporan($promosiDemosi, $request)
    {
        $tahun = $request->tahun != null ? $request->tahun : 'Semua Tahun';
        $ruangan_awal = $request->ruangan_awal != null ?  Ruangan::find($request->ruangan_awal_id)->nama_ruangan : 'Semua Ruangan';
        $ruangan_tujuan = $request->ruangan_awal != null ?  Ruangan::find($request->ruangan_awal_id)->nama_ruangan : 'Semua Ruangan';
        $jenis_mutasi = $request->jenis_mutasi != null ? $request->jenis_mutasi : 'Semua Jenis';
        $dataLaporan = [];
        foreach ($promosiDemosi as $item) {
            array_push($dataLaporan, [
                'Nama Pegawai' => $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan,
                'Jenis' => $item->jenis_mutasi,
                'Ruangan sebelumnya' => $item->ruanganAwal->nama_ruangan ?? '-',
                'Ruangan Baru' => $item->ruanganTujuan->nama_ruangan ?? '-',
                'Instansi sebelumnya' => $item->instansi_awal ?? '-',
                'Instansi Baru' => $item->instansi_tujuan ?? '-',
                'No SK' => $item->no_sk,
                'Tanggal Berlaku' => Carbon::parse($item->tanggal_berlaku)->format('d/m/Y'),
                'Tanggal SK' => Carbon::parse($item->tanggal_sk)->format('d/m/Y'),
                'link SK' => $item->link_sk ?? '-',
            ]);
        }
        // return $dataLaporan;
        $laporan = new Export([
            ['Rekap Data Mutasi'],
            ["Tahun : $tahun"],
            ["Jenis Mutasi : $jenis_mutasi"],
            ["Ruangan Awal : $ruangan_awal"],
            ["Ruangan Tujuan : $ruangan_tujuan"],
            ['Nama Pegawai', 'Jenis', 'Ruangan Sebelumnya', 'Ruangan Baru', 'Instansi Sebelumnya', 'Instansi Baru', 'No SK', 'Tanggal Berlaku', 'Tanggal SK', 'Link SK'],
            [...$dataLaporan]
        ]);

        return Excel::download($laporan, 'mutasi.xlsx');
    }

    public function export_excel(Request $request)
    {
        // return 'testing';
        $mutasi = Mutasi::orderBy('tanggal_berlaku', 'desc')->orderBy('pegawai_id', 'asc');
        if ($request->input('ruangan_awal') != null) {
            $mutasi->where('ruangan_awal_id', $request->ruangan_awal);
        }
        if ($request->input('ruangan_tujuan') != null) {
            $mutasi->where('ruangan_tujuan_id', $request->ruangan_tujuan);
        }
        if ($request->input('tahun') != null) {
            $mutasi->where('tanggal_sk', 'like', '%' . $request->tahun . '%');
        }
        if ($request->input('jenis_mutasi') != null) {
            $mutasi->where('jenis_mutasi', $request->jenis_mutasi);
        }
        // return $mutasi->get();
        return $this->dataLaporan($mutasi->get(), $request);
    }
}
