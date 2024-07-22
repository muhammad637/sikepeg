<?php

namespace App\Http\Controllers\API;

use App\Models\STR;
use App\Models\Admin;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class STRController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        $str = STR::where('pegawai_id', $user->id)->orderBy('updated_at', 'desc')->get();
        return response()->json(
            [
                'message' => "Data STR Pegawai berhasil Di tamplikan",
                'status' => 'success',
                'data' => $str,
            ],
            200
        );
    }

    public function store(Request $request)
    {
        //
        // return $request->all();
        try {
            $validatedData = $request->validate([
                'no_str' => 'required',
                'penerbit_str' => 'required',
                'tanggal_terbit_str' => 'required',
                'no_sertikom' => 'required',
                'kompetensi' => 'required',
                'masa_berakhir_str' => 'required',
                'link_str' => 'required|mimes:pdf',
            ]);
            $fileName = time() . '_' . md5(uniqid()). '.' . $request->file('link_str')->getClientOriginalExtension();
            Gdrive::put('dokumen/str/' . $fileName, $request->file('link_str'));
            $str = STR::create([
                'pegawai_id' => auth()->user()->id,
                'no_str' => $request->no_str,
                'no_sip' => $request->no_sip,
                'no_sertikom' => $request->no_sertikom,
                'kompetensi' => $request->kompetensi,
                'penerbit_str' => $request->penerbit_str,
                'tanggal_terbit_str' => $request->tanggal_terbit_str,
                'masa_berakhir_str' => $request->masa_berakhir_str,
                'link_str' => $fileName
            ]);
            $notif = Notifikasi::notif('str', 'data STR pegawai ' . $str->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($str->pegawai->id);

            return response()->json([
                'status' => 'success',
                'message' => 'data str berhasil di buat',
                'data' => $str
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'data error : ' . $th->getMessage(),
                'data' => $th->getMessage()
            ], 200);
        }
    }
}
