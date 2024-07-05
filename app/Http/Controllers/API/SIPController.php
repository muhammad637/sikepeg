<?php

namespace App\Http\Controllers\API;

use App\Models\SIP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SIPController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $sip = SIP::where('pegawai_id', $user->id)->get()->orderBy('updated_at', 'desc');
        return response()->json(
            [
                'message' => "Data SIP Pegawai berhasil Di tamplikan",
                'status' => 'success',
                'data' => $sip,
            ], 200
        );
    }
}
