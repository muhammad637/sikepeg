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
    // Function index
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

    // Function store
    public function store(Request $request)
    {
        try {
            // Validasi input
            // return request()->all();
            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required|integer',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'jumlah_hari' => 'required|integer',
            ]);
           

            Gdrive::put('location/filename.png', $request->file('file'));

            // Simpan data diklat tanpa link dokumen
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
                'no_sertifikat' => null,
                'tanggal_sertifikat' => null,
                'link_sertifikat' => null,
                'ruangan_id' => auth()->user()->ruangan->id,
                'status' => 'pending',
            ]);

            // Buat notifikasi
            $notif = Notifikasi::notif('diklat', 'Pengajuan diklat pegawai ' . auth()->user()->name . ' berhasil dibuat', 'bg-warning', 'fas fa-chalkboard-teacher');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);

            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan diklat berhasil dibuat dan menunggu persetujuan',
                'data' => $diklat
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $th->getMessage(),
            ], 400);
        }
    }

    // Function update
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'link_sertifikat' => 'required|file',
                'no_sertifikat' => 'required',
                'tanggal_sertifikat' => 'required|date',
            ]);

            // Cari diklat berdasarkan ID
            $diklat = Diklat::findOrFail($id);

            // Periksa apakah diklat sudah disetujui
            if ($diklat->status_diklat !== 'disetujui') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Diklat belum disetujui',
                ], 400);
            }

            // Hapus file lama dari Google Drive jika ada
            if ($diklat->link_sertifikat) {
                Gdrive::delete('dokumen/diklat/' . $diklat->link_sertifikat);
            }

            // Upload file baru ke Google Drive
            $fileName = Str::random(16) . '.' . $request->file('link_sertifikat')->getClientOriginalExtension();
            Gdrive::put('dokumen/diklat/' . $fileName, $request->file('link_sertifikat'));

            // Update data diklat dengan nama file baru
            $diklat->link_sertifikat = $fileName;
            $diklat->no_sertifikat = $request->no_sertifikat;
            $diklat->tanggal_sertifikat = $request->tanggal_sertifikat;
            $diklat->save();

            // Buat notifikasi
            $notif = Notifikasi::notif('diklat', 'Dokumen sertifikat untuk diklat ' . $diklat->nama_diklat . ' berhasil diperbarui oleh ' . auth()->user()->name, 'bg-info', 'fas fa-file-alt');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);

            return response()->json([
                'status' => 'success',
                'message' => 'Dokumen sertifikat berhasil diperbarui',
                'data' => new DiklatResource($diklat)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $th->getMessage(),
            ], 400);
        }
    }
}
