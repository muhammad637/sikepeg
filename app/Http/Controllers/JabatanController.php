<?php

namespace App\Http\Controllers;

use App\Models\PromosiDemosi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JabatanController extends Controller
{
    /**
     * Menampilkan daftar semua resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $promosiDemosi = PromosiDemosi::all();
        return response()->json($promosiDemosi);
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $pegawai = Pegawai::all();
        return response()->json($pegawai);
    }

    /**
     * Menyimpan resource baru ke dalam storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
        public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'jabatan_sebelumnya' => 'required',
            'jabatan_selanjutnya' => 'required',
            'tanggal_berlaku' => 'required|date',
            'no_sk' => 'required',
            'tanggal_sk' => 'required|date',
            'link_sk' => 'required|url',
            'type' => 'required',
            'ruanganawal_id' => 'required',
            'ruanganbaru_id' => 'required'
        ]);

        PromosiDemosi::create($request->all());

        return response()->json([
            'message' => 'Data promosi/demosi berhasil disimpan'
        ], 201);
    }

    /**
     * Menampilkan resource tertentu.
     *
     * @param  PromosiDemosi  $promosiDemosi
     * @return JsonResponse
     */
    public function show(PromosiDemosi $promosiDemosi): JsonResponse
    {
        return response()->json($promosiDemosi);
    }

    /**
     * Menampilkan form untuk mengedit resource tertentu.
     *
     * @param  PromosiDemosi  $promosiDemosi
     * @return JsonResponse
     */
    public function edit(PromosiDemosi $promosiDemosi): JsonResponse
    {
        $pegawai = Pegawai::all();
        return response()->json([
            'promosiDemosi' => $promosiDemosi,
            'pegawai' => $pegawai,
        ]);
    }

    /**
     * Memperbarui resource tertentu dalam storage.
     *
     * @param  Request  $request
     * @param  PromosiDemosi  $promosiDemosi
     * @return JsonResponse
     */
    public function update(Request $request, PromosiDemosi $promosiDemosi): JsonResponse
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'jabatan_sebelumnya' => 'required',
            'jabatan_selanjutnya' => 'required',
            'tanggal_berlaku' => 'required|date',
            'no_sk' => 'required',
            'tanggal_sk' => 'required|date',
            'link_sk' => 'required',
            'type' => 'required'
        ]);

        $promosiDemosi->update($validatedData);

        $pegawai = Pegawai::find($request->pegawai_id);
        $pegawai->update(['promosiDemosi' => $request->jabatan_selanjutnya]);

        return response()->json($promosiDemosi);
    }

    /**
     * Menghapus resource tertentu dari storage.
     *
     * @param  PromosiDemosi  $promosiDemosi
     * @return JsonResponse
     */
    public function destroy(PromosiDemosi $promosiDemosi): JsonResponse
    {
        $promosiDemosi->delete();
        return response()->json(null, 204);
    }
}
