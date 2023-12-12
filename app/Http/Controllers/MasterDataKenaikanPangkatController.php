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
    public function index(Request $request){
        if($request->ajax()){
            $pegawaiAsn = Pegawai::query()->where('status_tenaga', 'asn');
            return DataTables::of($pegawaiAsn)
            ->addIndexColumn()
            ->make(true);
        }
        return;
    }

    public function update(){
        $pegawaiAsn = Pegawai::where('status_tenaga', 'asn')->whereHas('kenaikanpangkat')->get();
    }

    private function dataUpdate($pegawaiAsn){
        $data = $pegawaiAsn->kenaikanpangkat->sortByDesc('tmt_pangkat_dari')->first();
        $TmtKeniakanPangkatmulai = Carbon::parse($data->tmt_pangkat_dari)->format('Y-m-d');
        $TmtKeniakananPangkatSelanjutnya = Carbon::parse($data->tmt_pangkat_sampai)->format('Y-m-d');
        // $tmtPegawai = Carbon::parse($pegawaiAsn)->format('Y-m-d');
        $hari_ini = date('Y-m-d');
        if($TmtKeniakanPangkatmulai <= $hari_ini && $TmtKeniakananPangkatSelanjutnya >= $hari_ini){
            $pegawaiAsn->update([
                'tmt_pangkat_terakhir' => $data->tmt_pangkat_dari,
            ]);
            if($pegawaiAsn->status_tipe == 'pns'){
                $pegawaiAsn->update([
                    'pangkat_id' => $data->pangkat_id,
                    'golongan_id' => $data->golongan_id
                ]);
            }
            if($pegawaiAsn->status_tipe == 'pppk'){
                $pegawaiAsn->update([
                    'golongan_id' => $data->golongan_id
                ]);
            }
        }
        // if($pegawaiAsn->tmt_pangkat_dari >= )
    }
}
