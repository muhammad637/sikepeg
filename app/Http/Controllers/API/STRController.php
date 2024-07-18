<?php

namespace App\Http\Controllers\API;

use App\Models\STR;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
