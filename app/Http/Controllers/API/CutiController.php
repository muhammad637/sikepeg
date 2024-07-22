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
    //
    public function index()
    {
        $user = auth()->user();
        // return $user;
        $cuti = Cuti::where('pegawai_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get();
        $data = CutiResource::collection($cuti);
        $response = response()->json(
            [
                'status' => 'success',
                'message' => 'Data Cuti Pegawai Berhasil ditampilkan',
                'data' => $data
            ]
        );
        return $response;
    }

    public function jenisCuti()
    {
        try {
            //code...
            $pegawai = auth()->user();
            $data = [];
            if ($pegawai->status_tipe == 'pns') {
                $data = ['cuti sakit', 'cuti tahunan', 'cuti melahirkan', 'cuti besar', 'cuti karena alasan penting', 'cuti di luar tanggungan negara'];
            } elseif ($pegawai->status_tipe == 'thl') {
                $data = ['cuti sakit', 'cuti tahunan', 'cuti melahirkan', 'cuti besar', 'cuti karena alasan penting'];
            } else {
                $data = ['cuti sakit', 'cuti tahunan', 'cuti melahirkan', 'cuti besar'];
            }
            $response = response()->json(
                [
                    'status' => 'success',
                    'message' => 'Data Cuti Pegawai Berhasil ditampilkan',
                    'data' => $data
                ]
            );
            return $response;
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(
                [
                    'status' => 'failed',
                    'message' => "Error : " . $th->getMessage(),
                    'data' => []
                ]
            );
        }
    }

    public function store(Request $request)
    {
        // return "testing";
        try {
            //code...
            // Validasi data input cuti
            $validatedData = $request->validate([
                'jenis_cuti' => 'required',
                'alasan_cuti' => 'required',
                'mulai_cuti' => 'required',
                'selesai_cuti' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
                'jumlah_hari' => 'required',
                'link_cuti' => 'required'
            ]);


           
            // Dapatkan data pegawai berdasarkan pegawai_id yang diberikan
            $pegawai = Pegawai::find(auth()->user()->id);

            // Jika pegawai tidak ditemukan, tampilkan pesan error dan redirect ke halaman sebelumnya
            if (!$pegawai) {
                alert()->error('Mohon masukkan nama Pegawai');
                return redirect()->back();
            }

            // Dapatkan data cuti terakhir pegawai
            $cuti = Cuti::where('pegawai_id', $pegawai->id)->orderBy('selesai_cuti', 'desc')->first();
            // return $cuti;

            // Jika terdapat data cuti terakhir
            if ($cuti) {
                // Dapatkan data cuti yang bersinggungan dengan periode cuti yang diminta
                $dataCuti = Cuti::where('pegawai_id', auth()->user()->id)
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('mulai_cuti', [$request->mulai_cuti, $request->selesai_cuti])
                            ->orWhereBetween('selesai_cuti', [$request->mulai_cuti, $request->selesai_cuti]);
                    })->get();
                // Validasi periode cuti agar tidak bersinggungan dengan cuti yang sudah ada
                $validasi = Carbon::parse($cuti->mulai_cuti) <= Carbon::parse($request->mulai_cuti) && Carbon::parse($cuti->selesai_cuti) >= Carbon::parse($request->selesai_cuti);

                // Jika terdapat data cuti yang bersinggungan atau validasi gagal, tampilkan pesan error dan redirect
                if ($dataCuti->count() > 0  || $validasi) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'tanggal cuti yang anda masukkan masih berlaku',
                        'data' => []
                    ], 200);
                }
            }

            // Jika jenis cuti adalah "cuti tahunan"
            if ($request->jenis_cuti == 'cuti tahunan') {
                // Validasi sisa cuti tahunan
                if ($pegawai->sisa_cuti_tahunan >= $request->jumlah_hari) {
                    // Update sisa cuti tahunan pegawai
                    $pegawai->update([
                        'sisa_cuti_tahunan' => $pegawai->sisa_cuti_tahunan - $request->jumlah_hari
                    ]);
                } else {

                    return response()->json([
                        'status' => 'error',
                        'message' => 'Cuti tahunan pegawai ' . $pegawai->nama_lengkap ?? $pegawai->nama_depan . ' telah habis pada tahun ini',
                        'data' => []
                    ], 200);
                }
            }

            // Jika jenis cuti adalah "cuti besar"
            if ($request->jenis_cuti == 'cuti besar') {
                // Validasi sisa cuti tahunan
                if ($pegawai->sisa_cuti_tahunan == 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Cuti tahunan pegawai ' . $pegawai->nama_lengkap ?? $pegawai->nama_depan . ' telah habis pada tahun ini',
                        'data' => []
                    ], 200);
                } else {
                    // Reset sisa cuti tahunan pegawai
                    $pegawai->update([
                        'sisa_cuti_tahunan' => 0
                    ]);
                }
            }



            // Buat objek Cuti
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
            ]);

            // Buat notifikasi untuk cuti
            $notif = Notifikasi::notif('cuti', 'Data cuti pegawai ' . $pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-week');
            $createNotif = Notifikasi::create($notif);

            // Asosiasikan notifikasi dengan admin dan pegawai terkait
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);

            // Tampilkan pesan sukses dan redirect ke halaman indeks cuti aktif
            return response()->json([
                'status' => 'success',
                'message' => 'data cuti berhasil ditambahkan',
                'data' => $create
            ], 200);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
           
        
       
    }
}
