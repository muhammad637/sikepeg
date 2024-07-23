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
    public function index()
    {
        $user = auth()->user();
        $diklat = Diklat::where('pegawai_id', $user->id)->orderBy('created_at', 'desc')->get();
        $data = DiklatResource::collection($diklat);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Diklat Pegawai Berhasil ditampilkan',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required|integer',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'no_sertifikat' => 'required',
                'tanggal_sertifikat' => 'required|date',
                'link_sertifikat' => 'required|file',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'jumlah_hari' => 'required|integer',
            ]);

            $fileName = Str::random(16) . '.' . $request->file('link_sertifikat')->getClientOriginalExtension();
            Gdrive::put('dokumen/diklat/' . $fileName, $request->file('link_sertifikat'));

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
                'ruangan_id' => auth()->user()->ruangan->id,
            ]);

            $notif = Notifikasi::notif('diklat', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);

            return response()->json([
                'status' => 'success',
                'message' => 'Data diklat berhasil dibuat',
                'data' => $diklat
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $th->getMessage(),
            ], 400);
        }
    }
}
