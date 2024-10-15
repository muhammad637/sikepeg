<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\JabatanResource;
use App\Models\PromosiDemosi;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $jabatan = PromosiDemosi::where('pegawai_id', $user->id)->orderBy('created_at', 'desc')->get();
        // return PromosiDemosi::orderBy('created_at', 'desc')->get();
        $data = JabatanResource::collection($jabatan);
        $response = response()->json(
            [
                'status' => 'success',
                'message' => 'Data Jabatan Pegawai Berhasil ditampilkan',
                'data' => $data
            ]
        );
        return $response;
    }
}
