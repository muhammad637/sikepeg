<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KenaikanPangkatResource;
use App\Models\KenaikanPangkat;
use Illuminate\Http\Request;

class KenaikanPangkatController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        // return $user->id;
        $kenaikanPangkat = KenaikanPangkat::where('pegawai_id', $user->id)->orderBy('updated_at', 'desc')->get();
        // return $kenaikanPangkat;
        return response()->json([
            'status' => 'success',
            'messsage' => 'Data Kenaikan Pangkat Pegawai Berhasil Di tampilkan',
            'data' => KenaikanPangkatResource::collection($kenaikanPangkat)
        ]);
    }
}
