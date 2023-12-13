<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Golongan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\KenaikanPangkat;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export;

class KenaikanPangkatController extends Controller
{
    public function index(Request $request)
    {
        $data = KenaikanPangkat::orderBy('tanggal_sk', 'desc')->first();
        // return [$data,$data->pegawai];
        $tahun = $data ? Carbon::parse($data->tanggal_sk)->format('Y') : date('Y');
        if ($request->ajax()) {
            $kenaikanPangkat = KenaikanPangkat::query()
                ->orderBy('tmt_pangkat_dari', 'desc')
                ->orderBy('pegawai_id', 'desc');
            if ($request->input('status_tipe') != null) {
                $kenaikanPangkat->where('status_tipe', $request->status_tipe);
            }
            if ($request->input('tahun') != null) {
                $kenaikanPangkat->where('tanggal_sk', 'like', '%' . $request->tahun . '%');
            }
            if ($request->input('ruangan') != null) {
                $kenaikanPangkat->where('ruangan_id', $request->ruangan);
            }
            $dataKenaikanPangkat = DataTables::of($kenaikanPangkat)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($item) {
                    return $item->pegawai ? $item->pegawai->nama_lengkap : '-';
                })
                ->addColumn('ruangan', function ($item) {
                    return $item->ruangan->nama_ruangan;
                })
                ->addColumn('pangkat', function ($item) {
                    return $item->pangkat->nama_pangkat ?? '-';
                })
                ->addColumn('golongan', function ($item) {
                    return $item->golongan->nama_golongan;
                })
                ->addColumn('no_sk', function ($item) {
                    return $item->no_sk;
                })
                ->addColumn('status', function ($item) {
                    $tanggal_mulai = Carbon::parse($item->tmt_pangkat_dari)->format('Ymd');
                    $tanggal_selesai = Carbon::parse($item->tmt_pangkat_sampai)->format('Ymd');
                    $tanggal_saat_ini = now()->format('Ymd');
                    $status = null;
                    if ($tanggal_mulai <= $tanggal_saat_ini && $tanggal_selesai >= $tanggal_saat_ini) {
                        $status = 'aktif';
                    } elseif ($tanggal_mulai >= $tanggal_saat_ini) {
                        $status = 'pending';
                    } else {
                        $status = 'nonaktif';
                    }
                    // return 'tes';
                    return '<button class="btn  text-white btn-' . ($status == 'aktif' ? 'success' : ($status == 'pending' ? 'secondary'  : 'secondary')) . ' border-0">' . $status . '</button>';
                })
                ->filterColumn('nama_lengkap', function ($query, $keyword) {
                    $query->wherHas('pegawai', function ($item) use ($keyword) {
                        $item->where('nama_lengkap', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('penerbit_sk', function ($item) {
                    return $item->penerbit_sk;
                })
                ->addColumn('tmt', function ($item) {
                    return $item->tmt_pangkat_dari;
                })
                ->addColumn('sk', 'pages.surat.kenaikanpangkat')
                ->addColumn('aksi', 'pages.kenaikan_pangkat.part.aksi-index')
                ->rawColumns(['status', 'nama_lengkap', 'ruangan', 'pangkat', 'golongan', 'no_sk', 'tmt', 'penerbit_sk', 'sk', 'aksi'])
                ->toJson();
            return $dataKenaikanPangkat;
            // $pegawai = Pegawai::where('status_tenaga', 'asn')->with(['kenaikanpangkat' => function ($q) {
            //     $q->orderBy('tanggal_sk', 'desc');
            // }])->get();
            // return $pegawai[0]->kenaikanpangkat[0];


        }
        return view(
            'pages.kenaikan_pangkat.index',
            [
                // 'KenaikanPangkat' => $kenaikanpangkat,
                'i' => 0,
                'data' => $tahun,
                'ruangans' => Ruangan::orderBy('nama_ruangan', 'desc')->get(),
            ]
        );
    }


    public function create()
    {
        $pegawai = Pegawai::where('status_tenaga', 'asn')->get();
        return view('pages.kenaikan_pangkat.create', ['pegawai' => $pegawai,]);
    }

    public function createriwayat(Pegawai $pegawai)
    {
        if ($pegawai->status_tenaga == 'non asn') {
            alert()->error('pegawai bukan merupakan PNS ataupun PPPK');
            return redirect()->route('admin.dashboard.index');
        }
        $status_tipe = $pegawai->status_tipe;
        $pegawai_select = Pegawai::where('status_tenaga', 'asn')->get();
        if ($status_tipe == 'pppk') {
            $golongan = Golongan::where('jenis', 'pppk')->orderBy('nama_golongan', 'asc')->get();
        } else {
            $golongan = Golongan::where('jenis', 'pns')->orderBy('nama_golongan', 'asc')->get();
        }
        $pangkat = Pangkat::orderBy('nama_pangkat', 'asc')->get();
        // return $pegawai;
        return view('pages.kenaikan_pangkat.riwayat.create', [
            'pegawai' => $pegawai,
            'pegawai_select' => $pegawai_select,
            'golongan' => $golongan,
            'pangkat' => $pangkat,
            'status' => $status_tipe,
        ]);
    }


    public function store(Request $request)
    {

        try {
            //code...

            $pegawai = Pegawai::find($request->pegawai_id);
            if (!$pegawai) {
                return 'pegawai tidak ada';
            }
            $pangkat_id = $request->pangkat_id;
            if ($request->pangkat_id == 'lainnya') {
                $request->validate([
                    'nama_pangkat' => 'required|unique:pangkats,nama_pangkat'
                ], [
                    'nama_pangkat.unique' => 'nama pangkat sudah ada'
                ]);
                $pangkat = Pangkat::create([
                    'nama_pangkat' => $request->nama_pangkat
                ]);
                $pangkat_id = $pangkat->id;
            }
            $golongan_id = $request->golongan_id;
            if ($request->golongan_id == 'lainnya') {
                $request->validate([
                    'nama_golongan' => 'required'
                ], [
                    'nama_golongan.unique' => 'nama golongan sudah ada'
                ]);
                $golongan = Golongan::create([
                    'nama_golongan' => $request->nama_golongan,
                    'jenis' => $pegawai->status_tipe
                ]);
                $golongan_id = $golongan->id;
            }
            $validatedData = $request->validate(
                [
                    'pegawai_id' => '',
                    // 'jabatan' => 'required',
                    'tmt_pangkat_dari' => 'required|date',
                    'tmt_pangkat_sampai' => 'required|date',
                    'no_sk' => 'required',
                    'tanggal_sk' => 'required',
                    'penerbit_sk' => 'required'

                ]
            );
            $kenaikanpangkat = KenaikanPangkat::create(
                [
                    'pegawai_id' => $request->pegawai_id,
                    'ruangan_id' => $request->ruangan_id,
                    'status_tipe' => $request->status_tipe,
                    'pangkat_id' => $pangkat_id ?? null,
                    'golongan_id' => $golongan_id,
                    'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
                    'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
                    'no_sk' => $request->no_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'penerbit_sk' => $request->penerbit_sk,
                    'link_sk' => $request->link_sk
                ]
            );
            $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('Ymd') <= date('Ymd') && Carbon::parse($request->tmt_pangkat_sampai)->format('Ymd') >= date('Ymd') ? 'aktif' : '-';
            $kenaikanpangkat->update([
                'golongan_id_sebelumnya' => $pegawai->golongan_id,
                'tmt_sebelumnya' => $pegawai->tmt_pangkat_terakhir,
                'pangkat_id_sebelumnya' => $pegawai->pangkat_id,
            ]);
            if ($tmt_pangkat == 'aktif') {
                $pegawai->update([
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                    'golongan_id' => $golongan_id,
                    'pangkat_id' => $pangkat_id ?? null,
                ]);
            }
            $notif = Notifikasi::notif('kenaikan pangkat', 'data cuti  pegawai ' . $pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-day');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);
            alert()->success('berhasil', 'data cuti pegawai berhasi dibuat oleh ' . auth()->user()->name);
            if ($request->has('riwayat')) {
                return redirect()->route('admin.kenaikan-pangkat.riwayat', ['pegawai' => $request->pegawai_id]);
            }
            return redirect()->route('admin.kenaikan-pangkat.index');
        } catch (\Throwable $th) {
            alert()->error($th->getMessage());
            return redirect()->back()->withInput();
            //throw $th;
        }
    }
    public function edit(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.edit', [
            'kenaikan_pangkat' => $kenaikan_pangkat,
            'pegawai' => Pegawai::all(),
        ]);
    }

    public function show(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.show', [
            'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }
    public function update(Request $request, KenaikanPangkat $kenaikan_pangkat)
    {
        
        $pegawaiUpdate = Pegawai::find($request->pegawai_id);

        $pegawaiSebelumnya = Pegawai::find($kenaikan_pangkat->pegawai_id);
        $pegawaiSebelumnya->update([
            'pangkat_id' => $kenaikan_pangkat->pangkat_id_sebelumnya ?? null,
            'golongan_id' => $kenaikan_pangkat->golongan_id_sebelumnya,
            'tmt_pangkat_terakhir' => $kenaikan_pangkat->tmt_sebelumnya
        ]);
        if ($pegawaiUpdate->kenaikanpangkat->count() > 1) {
            $kenaikanPangkatSebelumnya =  $pegawaiUpdate->kenaikanpangkat->sortByDesc('tmt_pangkat_sampai')->first();
            // return $kenaikanPangkatSebelumnya;
            $kenaikan_pangkat->update([
                'pangkat_id_sebelumnya' => $kenaikanPangkatSebelumnya->pangkat_id,
                'golongan_id_sebelumnya' => $kenaikanPangkatSebelumnya->golongan_id,
                'tmt_sebelumnya' => $kenaikanPangkatSebelumnya->tmt_seblumnya
            ]);
        } else {
            $kenaikan_pangkat->update([
                'pangkat_id_sebelumnya' => $pegawaiUpdate->pangkat_id,
                'golongan_id_sebelumnya' => $pegawaiUpdate->golongan_id,
                'tmt_sebelumnya' => $pegawaiUpdate->tmt_pangkat_terakhir
            ]);
        }
        $validatedData = $request->validate([
            'pegawai_id' => '',
            'tmt_pangkat_dari' => 'required',
            'tmt_pangkat_sampai' => 'required',
            'no_sk' => 'required',
            'tanggal_sk' => 'required',
            'penerbit_sk' => 'required',
            'link_sk' => 'required'
        ]);

        if ($pegawaiUpdate->status_tipe == 'pns') {
            $request->validate([
                'pangkat_id' => 'required',
                'golongan_id' => 'required'
            ], [
                'pangkat_id.required' => 'pangkat id masih kosong',
                'golongan_id.required' => 'golongan id masih kosong',
            ]);
        } elseif ($pegawaiUpdate->status_tipe == 'pppk') {
            $request->validate([
                'golongan_id' => 'required',
            ], [
                'golongan_id.required' => 'golongan id masih kosong',
            ]);
        }
        $pangkat_id = $request->pangkat_id;
        if ($request->pangkat_id == 'lainnya') {
            $request->validate([
                'nama_pangkat' => 'required|unique:pangkats,nama_pangkat'
            ], [
                'nama_pangkat.unique' => 'nama pangkat sudah ada'
            ]);
            $pangkat = Pangkat::create([
                'nama_pangkat' => strtolower($request->nama_pangkat),
            ]);
            $pangkat_id = $pangkat->id;
        }
        $golongan_id = $request->golongan_id;
        if ($request->golongan_id == 'lainnya') {
            $request->validate([
                'nama_golongan' => 'required'
            ], [
                'nama_golongan.unique' => 'nama golongan sudah ada'
            ]);
            $golongan = Golongan::create([
                'nama_golongan' => strtolower($request->nama_golongan),
                'jenis' => $pegawaiUpdate->status_tipe
            ]);
            $golongan_id = $golongan->id;
        }
        $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('Ymd') <= date('Ymd') && Carbon::parse($request->tmt_pangkat_sampai)->format('Ymd') >= date('Ymd') ? 'aktif' : '-';
        if ($tmt_pangkat == 'aktif') {
            $pegawaiUpdate->update([
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                'golongan_id' => $golongan_id,
                'pangkat_id' => $pangkat_id ?? null,
            ]);
        }
        $kenaikan_pangkat->update([
            'pegawai_id' => $request->pegawai_id,
            'pangkat_id' => $pangkat_id ?? null,
            'status_tipe' => $request->status_tipe,
            'golongan_id' => $golongan_id,
            'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
            'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'penerbit_sk' => $request->penerbit_sk,
            'link_sk' => $request->link_sk,
        ]);
        // return [$kenaikan_pangkat,$kenaikan_pangkat->pegawai];
        $notif = Notifikasi::notif('kenaikan pangkat', 'data kenaikan pangkat  pegawai ' . $kenaikan_pangkat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-day');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($kenaikan_pangkat->pegawai->id);
        alert()->success('berhasil', 'data kenaikan pangkat berhasi dupdate oleh ' . auth()->user()->name);
        if ($request->riwayat) {
            return redirect()->route('admin.kenaikan-pangkat.riwayat', ['pegawai' => $request->pegawai_id])->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
        }
        return redirect()->route('admin.kenaikan-pangkat.index')->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
    }


    public function riwayat(Pegawai $pegawai, KenaikanPangkat $kenaikan_pangkat, Request $request)
    {
        $kenaikan_pangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_sampai', 'desc')->get();
        if ($request->ajax()) {
            $kp = KenaikanPangkat::query()->where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_sampai', 'desc');
            $dataKp = DataTables::of($kp)
                ->addIndexColumn()
                ->addColumn('pangkat_golongan', function ($item) {
                    // return 'tes';
                    return $item->pangkat ? $item->pangkat->nama_pangkat . " / " . $item->golongan->nama_golongan : $item->golongan->nama_golongan;
                })
                ->addColumn('aksi', 'pages.kenaikan_pangkat.part.aksi-riwayat')
                ->rawColumns(['pangkat_golongan', 'aksi'])
                ->toJson();
            return $dataKp;
        }
        return view('pages.kenaikan_pangkat.riwayat.index', [
            'pegawai' => $pegawai,
            // 'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }
    public function editRiwayat(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.riwayat.edit', [
            'kenaikan_pangkat' => $kenaikan_pangkat,
            'pegawai' => Pegawai::all(),
        ]);
    }

    public function lihatRiwayat(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.riwayat.show', [
            'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }

    public function destroy(KenaikanPangkat $kenaikan_pangkat)
    {
        // $riwayatKP = KenaikanPangkat::where('pegawai_id', $kenaikan_pangkat->pegawai_id)
        //     ->orderBy('tanggal_sk', 'desc')
        //     ->first();
        // return $riwayatKP;
        $tanggal_mulai = Carbon::parse($kenaikan_pangkat->tmt_pangkat_dari)->format('Ymd');
        $tanggal_selesai = Carbon::parse($kenaikan_pangkat->tmt_pangkat_sampai)->format('Ymd');
        $tanggal_saat_ini = now()->format('Ymd');
        $status = null;
        if ($tanggal_mulai <= $tanggal_saat_ini && $tanggal_selesai >= $tanggal_saat_ini) {
            $status = 'aktif';
        } elseif ($tanggal_mulai >= $tanggal_saat_ini) {
            $status = 'pending';
        } else {
            $status = 'nonaktif';
        }
        if ($status == 'aktif') {
            $kenaikan_pangkat->pegawai->update([
                'tmt_pangkat_terakhir' => $kenaikan_pangkat->tmt_sebelumnya,
                'pangkat_id' => $kenaikan_pangkat->pangkat_id_sebelumnya,
                'golongan_id' => $kenaikan_pangkat->golongan_id_sebelumnya,
            ]);
        }
        $kenaikan_pangkat->delete();
        alert()->success('data berhasil dihapus');
        return redirect()->back();
    }
    //

    private function dataLaporan($kenaikan_pangkat
    )
    {
        $dataLaporan = [];
        foreach ($kenaikan_pangkat as $item) {
            array_push($dataLaporan, [
                'Nama Pegawai' => $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan,
                'Status Tipe' => $item->status_tipe,
                'Ruangan' => $item->ruangan->nama_ruangan ?? '-',
                'Pangkat' => $item->pangkat->nama_pangkat ?? '-',
                'Golongan' => $item->golongan->nama_golongan ?? '-',
                'No SK' => $item->no_sk,
                'Tanggal Mulai Terhitung' => Carbon::parse($item->tmt_pangkat_dari)->format('d/m/Y') .' - '.Carbon::parse($item->tmt_pangkat_dari)->format('d/m/Y'),
                'Penerbit SK' => $item->penerbit_sk,
            ]);
        }
        // return $dataLaporan;
        $laporan = new Export([
            ['Nama Pegawai', 'Status Tipe', 'Ruangan', 'Pangkat', 'Golongan', 'No SK', 'Tanggal Mulai Terhitung', 'Penerbit SK'],
            [...$dataLaporan]
        ]);
        // return $dataLaporan;
        return Excel::download($laporan, 'kenaikan-pangkat.xlsx');
    }

    public function export_excel(Request $request)
    {
        // return 'testing';
        $kenaikan_pangkat = KenaikanPangkat::orderBy('tmt_pangkat_dari', 'desc')->orderBy('pegawai_id', 'asc');
        if ($request->input('status_tipe') != null) {
            $kenaikan_pangkat->where('status_tipe', $request->status_tipe);
        }
        if ($request->input('ruangan') != null) {
            $kenaikan_pangkat->where('ruangan_id', $request->ruangan);
        }
        if ($request->input('tahun') != null) {
            $kenaikan_pangkat->where('tmt_pangkat_dari', 'like', '%' . $request->tahun . '%');
        }
        // return $mutasi->get();
        return $this->dataLaporan($kenaikan_pangkat->get());
    }
}
