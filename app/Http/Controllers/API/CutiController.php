<?php
namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CutiResource;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class CutiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cuti = Cuti::where('pegawai_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get();
        $data = CutiResource::collection($cuti);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Cuti Pegawai Berhasil ditampilkan',
            'data' => $data
        ]);
    }

    public function jenisCuti()
    {
        try {
            $pegawai = auth()->user();
            $data = [];

            if ($pegawai->status_tipe == 'pns') {
                $data = ['cuti sakit', 'cuti tahunan', 'cuti melahirkan', 'cuti besar', 'cuti karena alasan penting', 'cuti di luar tanggungan negara'];
            } elseif ($pegawai->status_tipe == 'thl') {
                $data = ['cuti sakit', 'cuti tahunan', 'cuti melahirkan', 'cuti besar', 'cuti karena alasan penting'];
            } else {
                $data = ['cuti sakit', 'cuti tahunan', 'cuti melahirkan', 'cuti besar'];
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data Cuti Pegawai Berhasil ditampilkan',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => "Error : " . $th->getMessage(),
                'data' => []
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'jenis_cuti' => 'required',
                'alasan_cuti' => 'required',
                'mulai_cuti' => 'required',
                'selesai_cuti' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
                'jumlah_hari' => 'required',
                'link_cuti' => 'required|file'
            ]);

            $pegawai = Pegawai::find(auth()->user()->id);

            if (!$pegawai) {
                return response()->json(['status' => 'error', 'message' => 'Pegawai tidak ditemukan'], 404);
            }

            $cuti = Cuti::where('pegawai_id', $pegawai->id)->orderBy('selesai_cuti', 'desc')->first();

            if ($cuti) {
                $dataCuti = Cuti::where('pegawai_id', auth()->user()->id)
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('mulai_cuti', [$request->mulai_cuti, $request->selesai_cuti])
                            ->orWhereBetween('selesai_cuti', [$request->mulai_cuti, $request->selesai_cuti]);
                    })->get();

                $validasi = Carbon::parse($cuti->mulai_cuti) <= Carbon::parse($request->mulai_cuti) && Carbon::parse($cuti->selesai_cuti) >= Carbon::parse($request->selesai_cuti);

                if ($dataCuti->count() > 0 || $validasi) {
                    return response()->json(['status' => 'error', 'message' => 'Tanggal cuti yang Anda masukkan masih berlaku'], 400);
                }
            }

            if ($request->jenis_cuti == 'cuti tahunan') {
                if ($pegawai->sisa_cuti_tahunan < $request->jumlah_hari) {
                    return response()->json(['status' => 'error', 'message' => 'Cuti tahunan habis'], 400);
                }
            }

            if ($request->jenis_cuti == 'cuti besar') {
                if ($pegawai->sisa_cuti_tahunan == 0) {
                    return response()->json(['status' => 'error', 'message' => 'Cuti tahunan habis'], 400);
                }
            }

            $fileName = Str::random(16) . '.' . $request->file('link_cuti')->getClientOriginalExtension();
            Gdrive::put('dokumen/cuti/' . $fileName, $request->file('link_cuti'));

            $create = Cuti::create([
                'pegawai_id' => auth()->user()->id,
                'jenis_cuti' => $request->jenis_cuti,
                'alasan_cuti' => $request->alasan_cuti,
                'mulai_cuti' => $request->mulai_cuti,
                'selesai_cuti' => $request->selesai_cuti,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jumlah_hari' => $request->jumlah_hari,
                'link_cuti' => $fileName,
                'status' => 'pending'
            ]);

            $notif = Notifikasi::notif('cuti', 'Data cuti pegawai ' . $pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-week');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);

            return response()->json(['status' => 'success', 'message' => 'Data cuti berhasil ditambahkan', 'data' => new CutiResource($create)], 200);
        } catch (\Exception $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 400);
        }
    }

}
