<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MasterDataTahunCuti extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pegawai = Pegawai::query();
            return DataTables::of($pegawai)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.master_data.cuti_pegawai.index');
    }
    public function update()
    {
        $pegawais = Pegawai::all();
        foreach ($pegawais as $item) {
            $this->dataUpdate($item);
        }
        alert()->success('data berhasil di update');
        return redirect()->back();
    }
    private function dataUpdate($pegawai)
    {
        if ($pegawai->status_tipe == 'pns') {
            if ($pegawai->tahun_cuti < date('Y') && $pegawai->sisa_cuti_tahunan >= 6) {
                return $pegawai->update([
                    'sisa_cuti_tahunan' => 18,
                ]);
            }
            if ($pegawai->tahun_cuti < date('Y') && $pegawai->sisa_cuti_tahunan < 6) {
                return   $pegawai->update([
                    'sisa_cuti_tahunan' => $pegawai->sisa_cuti_tahunan + 12,
                ]);
            }
        } else {
            return  $pegawai->update([
                'sisa_cuti_tahunan' => 12,
            ]);
        }
    }
}
