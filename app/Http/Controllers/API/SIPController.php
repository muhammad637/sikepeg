<?php

namespace App\Http\Controllers\API;

use App\Models\SIP;
use App\Models\Admin;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\SIPResource;
use App\Http\Controllers\Controller;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class SIPController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $sip = SIP::where('pegawai_id', $user->id)->orderBy('updated_at', 'desc')->get();
        $data = SIPResource::collection($sip);
        return response()->json(
            [
                'message' => "Data SIP Pegawai berhasil Di tamplikan",
                'status' => 'success',
                'data' => $sip,
            ],
            200
        );
    }
    public function store(Request $request)
    {
        //
        try {
            //code...
            // return $request->all();
            $validatedData = $request->validate([
                'no_str' => '',
                'no_sip' => 'required',
                'no_rekomendasi' => 'required',
                'penerbit_sip' => 'required',
                'tanggal_terbit_sip' => 'required',
                'masa_berakhir_sip' => 'required',
                'tempat_praktik' => 'required',
                'link_sip' => 'required|mimes:pdf',
                'alamat_sip' => 'required',
            ], [
                'alamat_sip.required' => 'alamat tidak boleh kosong'
            ]);
            $fileName = Str::random(16) . '.' . $request->file('link_sip')->getClientOriginalExtension();
            Gdrive::put('dokumen/sip/' . $fileName, $request->file('link_sip'));
            $sip = SIP::create([
                'pegawai_id' => auth()->user()->id,
                'no_sip' => $request->no_sip,
                'no_rekomendasi' => $request->no_rekomendasi,
                'no_str' => $request->no_str,
                'penerbit_sip' => $request->penerbit_sip,
                'tanggal_terbit_sip' => $request->tanggal_terbit_sip,
                'masa_berakhir_sip' => $request->masa_berakhir_sip,
                'tempat_praktik' => $request->tempat_praktik,
                'link_sip' => $fileName,
                'alamat_sip' => $request->alamat_sip
            ]);
            $notif = Notifikasi::notif('sip', 'data STR pegawai ' . $sip->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($sip->pegawai->id);
            return response()->json([
                'status' => 'success',
                'message' => 'data sip berhasil di buat',
                'data' => $sip
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
