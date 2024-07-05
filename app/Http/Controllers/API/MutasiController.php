<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MutasiResource;
use App\Models\mutasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use PhpParser\Node\Expr\Cast\Array_;

class MutasiController extends Controller
{
    //

    public function index(): JsonResponse
    {
        $pegawai = auth()->user();
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Data mutasi pegawai berhasil ditampilkan.',
            'data' => MutasiResource::collection($mutasi),
        ], 200);
    }
}
