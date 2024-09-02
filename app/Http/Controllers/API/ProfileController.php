<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotifikasiApiResource;
use App\Http\Resources\PegawaiResource;
use App\Models\Notifikasi;
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

    public function notifikasi()
    {
        $notifikasi = auth()->user()->notifikasi->sortByDesc('created_at');
        return response()->json([
            'status' => 'success',
            'message' => 'data notifikasi pegawai berhasil ditampilkan',
            'data' => NotifikasiApiResource::collection([...$notifikasi]) 
        ]);
    }
}
