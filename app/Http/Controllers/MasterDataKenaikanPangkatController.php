<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MasterDataKenaikanPangkatController extends Controller
{
    //
    public function index(Request $request)
    {
        $pegawaiAsn = Pegawai::query()->where('status_tenaga', 'asn')->get();
        // return $pegawaiAsn[0]->pangkat ?? 'testing' ;
        if ($request->ajax()) {
            $pegawaiAsn = Pegawai::query()->where('status_tenaga', 'asn');
            return DataTables::of($pegawaiAsn)
                ->addIndexColumn()
                ->addColumn('pangkat', function ($item) {
                    return $item->pangkat->nama_pangkat ?? '-';
                })
                ->addColumn('ruangan', function ($item) {
                    return $item->ruangan->nama_ruangan ?? '-';
                })
                ->addColumn('golongan', function ($item) {
                    return  $item->golongan->nama_golongan;
                })
                ->addColumn('tmt_pangkat', function ($item) {
                    return Carbon::parse($item->tmt_pangkat)->format('d-m-Y');
                })
                ->rawColumns(['pangkat', 'golongan', 'tmt_pangkat','ruangan'])
                ->make(true);
        }
        return view('pages.master_data.kenaikan_pangkat.index');
    }

    public function update()
    {
        $pegawaiAsn = Pegawai::where('status_tenaga', 'asn')->whereHas('kenaikanpangkat')->get();
        foreach ($pegawaiAsn as $item) {
            # code...
            return $this->dataUpdate($item);
        }
        alert()->success('data berhasil diupdate');
        return redirect()->back();
    }

    private function dataUpdate($pegawaiAsn)
    {
        $data = $pegawaiAsn->kenaikanpangkat->sortByDesc('tmt_pangkat_dari')->first();
        $TmtKeniakanPangkatmulai = Carbon::parse($data->tmt_pangkat_dari)->format('Y-m-d');
        $TmtKeniakananPangkatSelanjutnya = Carbon::parse($data->tmt_pangkat_sampai)->format('Y-m-d');
        // $tmtPegawai = Carbon::parse($pegawaiAsn)->format('Y-m-d');
        $hari_ini = date('Y-m-d');
        if ($TmtKeniakanPangkatmulai <= $hari_ini && $TmtKeniakananPangkatSelanjutnya >= $hari_ini) {
            $pegawaiAsn->update([
                'tmt_pangkat_terakhir' => $data->tmt_pangkat_dari,
            ]);
            if ($pegawaiAsn->status_tipe == 'pns') {
                $pegawaiAsn->update([
                    'pangkat_id' => $data->pangkat_id,
                    'golongan_id' => $data->golongan_id
                ]);
            }
            if ($pegawaiAsn->status_tipe == 'pppk') {
                $pegawaiAsn->update([
                    'golongan_id' => $data->golongan_id
                ]);
            }
        }
        // if($pegawaiAsn->tmt_pangkat_dari >= )
    }
}
