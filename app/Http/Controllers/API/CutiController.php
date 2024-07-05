<?php

namespace App\Http\Controllers\API;

use App\Models\Cuti;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CutiResource;

class CutiController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        // return $user;
        $cuti = Cuti::where('pegawai_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get();
        $data = CutiResource::collection($cuti);
        $response = response()->json(
            [
                'status' => 'success',
                'message' => 'Data Cuti Pegawai Berhasil ditampilkan',
                'data' => $data
            ]
        );
        return $response;
    }
}
