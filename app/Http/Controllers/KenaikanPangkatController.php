<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\KenaikanPangkat;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class KenaikanPangkatController extends Controller
{
    public function index(Request $request)
    {
        // $kenaikanpangkat = KenaikanPangkat::orderBy('tanggal_sk', 'desc')->with('pegawai')->get();
        // $pegawai = Pegawai::find(1);
        // return $pegawai->kenaikanpangkat->sortByDesc('tmt_pangkat_sampai')->first();
        // return $kenaikanpangkat;
        if ($request->ajax()) {
            $pegawai = Pegawai::query()
                ->where('status_tenaga', 'asn')
                ->with(['kenaikanpangkat' => function ($q) {
                    $q->orderBy('tanggal_sk', 'desc');
                }])
                ->whereHas('kenaikanpangkat', function ($q) {
                    $q->orderBy('tanggal_sk', 'desc');
                });
            $dataKenaikanPangkat = DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('ruangan', function ($item) {
                    return $item->ruangan->nama_ruangan;
                })
                ->addColumn('pangkat', function ($item) {
                    return $item->kenaikanpangkat[0]->pangkat->nama_pangkat ?? '-';
                })
                ->addColumn('golongan', function ($item) {
                    return $item->kenaikanpangkat[0]->golongan->nama_golongan;
                })
                ->addColumn('no_sk', function ($item) {
                    return $item->kenaikanpangkat[0]->no_sk;
                })
                ->addColumn('penerbit_sk', function ($item) {
                    return $item->kenaikanpangkat[0]->penerbit_sk;
                })
                ->addColumn('tmt', function ($item) {
                    return $item->kenaikanpangkat[0]->tmt_pangkat_dari;
                })
                ->addColumn('sk', 'pages.surat.kenaikanpangkat')
                ->addColumn('aksi', 'pages.kenaikan_pangkat.part.aksi-index')
                ->rawColumns(['ruangan', 'pangkat', 'golongan', 'no_sk', 'tmt', 'penerbit_sk', 'sk', 'aksi'])
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
            ]
        );
    }


    public function create()
    {
        $pegawai = Pegawai::where('status_tenaga', 'asn')->get();
        return view('pages.kenaikan_pangkat.create', ['pegawai' => $pegawai,]);
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
                'jabatan' => 'required',
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
                'pangkat_id' => $pangkat_id ?? null,
                'jabatan' => $request->jabatan,
                'golongan_id' => $golongan_id,
                'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
                'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'penerbit_sk' => $request->penerbit_sk,
                'link_sk' => $request->link_sk
            ]
        );
        $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('d-m-y') >= Carbon::parse($pegawai->tmt_pangkat_terakhir)->format('d-m-y');
        // return $tmt_pangkat;
        if ($pegawai->status_tipe == 'pppk' && $tmt_pangkat) {
            $kenaikanpangkat->update([
                'golongan_id_sebelumnya' => $pegawai->golongan_id,
                'jabatan_sebelumnya' => $pegawai->jabatan,
                'tmt_sebelumnya' => $pegawai->tmt_pangkat_terakhir,
            ]);
            $pegawai->update([
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                'golongan_id' => $golongan_id,
                'jabatan' => $request->jabatan
            ]);
        } elseif ($pegawai->status_tipe == 'pns' && $tmt_pangkat) {
            $kenaikanpangkat->update([
                'golongan_id_sebelumnya' => $pegawai->golongan_id,
                'pangkat_id_sebelumnya' => $pegawai->pangkat_id,
                'tmt_sebelumnya' => $pegawai->tmt_pangkat_terakhir,
                'jabatan_sebelumnya' => $pegawai->jabatan,
                
            ]);
            $pegawai->update([
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                'golongan_id' => $golongan_id,
                'pangkat_id' => $pangkat_id,
                'jabatan' => $request->jabatan
            ]);
        }
        // return $pegawai->jabatan;


        $notif = Notifikasi::notif('kenaikan pangkat', 'data cuti  pegawai ' . $pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-day');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawai->id);
        alert()->success('berhasil', 'data cuti pegawai berhasi dibuat oleh ' . auth()->user()->name);
        return redirect()->route('admin.kenaikan-pangkat.index')->with('success', 'data kenaikan pangkat pegawai berhasil ditambahkan');
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
        // try {
            // return request()->all();
            $pegawaiUpdate = Pegawai::find($request->pegawai_id);
            // reset kenaikan pangkat pegawai sebelumnya
            $pegawaiSebelumnya = Pegawai::find($kenaikan_pangkat->pegawai_id);
            $pegawaiSebelumnya->update([
                'jabatan_sebelumnya' => $kenaikan_pangkat->jabatan_sebelumnya ?? null,
                'pangkat_id' => $kenaikan_pangkat->pangkat_id_sebelumnya ?? null,
                'golongan_id' => $kenaikan_pangkat->golongan_id_sebelumnya,
                'tmt_pangkat_terakhir' => $kenaikan_pangkat->tmt_sebelumnya 
            ]);
            if ($pegawaiUpdate->kenaikanpangkat->count() > 1) {
                $kenaikanPangkatSebelumnya =  $pegawaiUpdate->kenaikanpangkat->sortByDesc('tmt_pangkat_sampai')->sortByDesc('tmt_pangkat_sampai')->first();
                // return $kenaikanPangkatSebelumnya;
                $kenaikan_pangkat->update([
                    'pangkat_id_sebelumnya' => $kenaikanPangkatSebelumnya->pangkat_id,
                    'golongan_id_sebelumnya' => $kenaikanPangkatSebelumnya->golongan_id,
                    'jabatan_sebelumnya' => $kenaikanPangkatSebelumnya->jabatan,
                    'tmt_sebelumnya' => $kenaikanPangkatSebelumnya->tmt_seblumnya
                ]);
            }else{
                $kenaikan_pangkat->update([
                    'pangkat_id_sebelumnya' => $pegawaiUpdate->pangkat_id,
                    'golongan_id_sebelumnya' => $pegawaiUpdate->golongan_id,
                    'jabatan_sebelumnya' => $pegawaiUpdate->jabatan,
                    'tmt_sebelumnya' => $pegawaiUpdate->tmt_pangkat_terakhir
                ]);
            }
            $validatedData = $request->validate([
                'pegawai_id' => '',
                'jabatan' => 'required',
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
            $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('d-m-y') >= Carbon::parse($pegawaiUpdate->tmt_pangkat_terakhir)->format('d-m-y');
            if ($pegawaiUpdate->status_tipe == 'pppk' && $tmt_pangkat) {
                $pegawaiUpdate->update([
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                    'golongan_id' => $golongan_id,
                    'jabatan' => $request->jabatan
                ]);
            } elseif ($pegawaiUpdate->status_tipe == 'pns' && $tmt_pangkat) {
                $pegawaiUpdate->update([
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                    'golongan_id' => $golongan_id,
                    'pangkat_id' => $pangkat_id,
                    'jabatan' => $request->jabatan
                ]);
            }
            $kenaikan_pangkat->update([
                'pegawai_id' => $request->pegawai_id,
                'pangkat_id' => $pangkat_id ?? null,
                'golongan_id' => $golongan_id,
                'jabatan' => $request->jabatan,
                'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
                'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'penerbit_sk' => $request->penerbit_sk,
                'link_sk' => $request->link_sk,
            ]);
            $notif = Notifikasi::notif('kenaikan pangkat', 'data kenaikan pangkat  pegawai ' . $kenaikan_pangkat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-day');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($kenaikan_pangkat->pegawai->id);
            alert()->success('berhasil', 'data kenaikan pangkat berhasi dupdate oleh ' . auth()->user()->name);
            if($request->riwayat){
                return redirect()->route('admin.kenaikan-pangkat.riwayat',['pegawai' => $request->pegawai_id])->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
            }
            return redirect()->route('admin.kenaikan-pangkat.index')->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
            //code...
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     // alert()->error('gagal', 'data kenaikan pangkat gagal diupdate oleh ' . auth()->user()->name);
        //     // return redirect()->back()->withInput();
        //     return $th->getMessage();
        // }
    }


    public function riwayat(Pegawai $pegawai, KenaikanPangkat $kenaikan_pangkat, Request $request)
    {
        $kenaikan_pangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_sampai', 'desc')->get();
        if($request->ajax()){
            $kp = KenaikanPangkat::query()->where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_sampai', 'desc');
            $dataKp = DataTables::of($kp)
            ->addIndexColumn()
            ->addColumn('pangkat_golongan', function($item){
                // return 'tes';
                return $item->pangkat ? $item->pangkat->nama_pangkat ." / ". $item->golongan->nama_golongan : $item->golongan->nama_golongan;
            })
            ->addColumn('aksi', 'pages.kenaikan_pangkat.part.aksi-riwayat')
            ->rawColumns(['pangkat_golongan','aksi'])
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

    public function destroy(KenaikanPangkat $kenaikan_pangkat){
        $riwayatKP = KenaikanPangkat::where('pegawai_id', $kenaikan_pangkat->id)
        ->orderBy('tanggal_sk','desc')
        ->first();
        $riwayatKP->pegawai->update([
            'tmt_pangkat_terakhir' => $riwayatKP->tmt_sebelumnya,
            'pangkat_id' => $riwayatKP->pangkat_id_sebelumnya,
            'golongan_id' => $riwayatKP->golongan_id_sebelumnya,
            'jabatan' => $riwayatKP->jabatan_sebelumnya
        ]);
        $kenaikan_pangkat->delete();
        alert()->success('data berhasil dihapus');
        return redirect()->back();
    }
    //
}
