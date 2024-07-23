<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PegawaiResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;

class AuthController extends Controller
{
    public function loginHandler(Request $request)
    {
        try {
            $request->validate([
                'nip_nippk' => 'required|exists:pegawais,nip_nippk',
                'password' => 'required',
            ], [
                'nip_nippk.required' => 'nip / nippk harus ada isinya',
                'nip_nippk.exists' => 'nip / nippk tidak ada di database',
                'password.required' => 'password harus di isi',
            ]);

            $cred = array(
                'nip_nippk' => $request->nip_nippk,
                'password' => $request->password,
            );
            if (Auth::guard('pegawai')->attempt($cred)) {
                $user = auth()->guard('pegawai')->user();
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'status' => 'success',
                    'message' => 'berhasil Login sebagai Pegawai',
                    'data' => new PegawaiResource($user),
                    'token' => $token,
                    'type' => 'Bearer',
                ], 200);
            } else {
                return response()->json(['message' => 'data yang anda masukkan salah, coba lagi'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    public function logoutHandler()
    {
        $user = Auth::guard('pegawai')->user();
        $user->tokens()->delete();
        Auth::guard('pegawai')->logout();
        return response()->json(['message' => 'anda sudah logout di sistem'], 200);
    }
}
