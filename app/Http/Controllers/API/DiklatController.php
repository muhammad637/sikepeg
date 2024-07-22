<?php

namespace App\Http\Controllers\API;

use App\Models\Admin;
use App\Models\Diklat;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiklatResource;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class DiklatController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $diklat = Diklat::where('pegawai_id', $user)->orderBy('created_at', 'desc')->get();
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


    public function store(Request $request)
    {
        try {
            //code...
            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required|integer',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'no_sertifikat' => 'required',
                'tanggal_sertifikat' => 'required|date',
                'link_sertifikat' => 'required',
                // 'ruangan_id' => 'required'
            ]);

            $fileName = Str::random(16) . '.' . $request->file('link_sertifikat')->getClientOriginalExtension();
            Gdrive::put('dokumen/diklat/' . $fileName, $request->file('link_sertifikat'));
            // Membuat objek Diklat dengan menggunakan data yang valid
            $diklat = Diklat::create([
                'pegawai_id' => auth()->user()->id,
                'nama_diklat' => $request->nama_diklat,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'jumlah_hari' => $request->jumlah_hari,
                'jumlah_jam' => $request->jumlah_jam,
                'penyelenggara' => $request->penyelenggara,
                'tempat' => $request->tempat,
                'tahun' => $request->tahun,
                'no_sertifikat' => $request->no_sertifikat,
                'tanggal_sertifikat' => $request->tanggal_sertifikat,
                'link_sertifikat' => $fileName,
                'ruangan_id' => auth()->user()->ruangan->id
            ]);

            // Membuat notifikasi untuk tindakan tambah data diklat
            $notif = Notifikasi::notif('diklat', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
            $createNotif = Notifikasi::create($notif);

            // Mengasosiasikan notifikasi dengan admin dan pegawai terkait
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);

            // Menampilkan pesan sukses dan mengarahkan ke halaman indeks diklat
            // alert()->success('Berhasil', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name);
            return response()->json([
                'status' => 'success',
                'message' => 'data diklat berhasil di buat',
                'data' => $diklat
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => 'error',
                'message' => 'error : ' . $th->getMessage(),

            ]);
        }
        // Validasi data input

    }
}
