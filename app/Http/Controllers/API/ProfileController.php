<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PegawaiResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        return response()->json([
            'status' => 'success',
            'message' => 'Daata pegawai berhasil ditampilkan',
            'data' => new PegawaiResource($user),
        ], 200);
    }
}
