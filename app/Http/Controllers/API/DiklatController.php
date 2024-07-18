<?php

namespace App\Http\Controllers\API;

use App\Models\Diklat;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiklatResource;

class DiklatController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $diklat = Diklat::where('pegawai_id', $user)->get()->orderBy('created_at', 'desc');
        $data = DiklatResource::collection($diklat);
        $response = response()->json(
            [
                'status' => 'success',
                'message' => 'Data Diklat Pegawai Berhasil ditampilkan',
                'data' => $data
            ]
        );
        return $response;
    }
}
