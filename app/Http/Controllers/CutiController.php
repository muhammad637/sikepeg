<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class CutiController extends Controller
{
    protected $bulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    // Data cuti aktif
    public function index(Request $request)
    {
        $cuti = Cuti::query()->whereDate('selesai_cuti', '>=', now()->format('Y-m-d'));
        
        return response()->json($cuti->get());
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            return response()->json(['error' => 'Pegawai tidak ditemukan'], 404);
        }

        $cuti = Cuti::where('pegawai_id', $pegawai->id)
            ->orderBy('selesai_cuti', 'desc')
            ->first();

        if ($cuti && $this->isOverlappingCuti($request, $cuti)) {
            return response()->json(['error' => 'Cuti periode ini sudah ada atau tumpang tindih.'], 400);
        }

        if ($request->jenis_cuti == 'cuti tahunan' && !$this->validateCutiTahunan($pegawai, $request->jumlah_hari)) {
            return response()->json(['error' => 'Cuti tahunan pegawai telah habis.'], 400);
        }

        if ($request->jenis_cuti == 'cuti besar' && !$this->validateCutiBesar($pegawai)) {
            return response()->json(['error' => 'Cuti besar telah digunakan dalam 5 tahun terakhir.'], 400);
        }

        $cuti = Cuti::create($validatedData);
        return response()->json(['message' => 'Pengajuan cuti berhasil ditambahkan', 'data' => $cuti], 201);
    }

    public function show($id)
    {
        $cuti = Cuti::find($id);
        if (!$cuti) {
            return response()->json(['error' => 'Cuti tidak ditemukan'], 404);
        }
        return response()->json($cuti);
    }

    public function update(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);
        $validatedData = $this->validateRequest($request);

        $cuti->update($validatedData);
        return response()->json(['message' => 'Data cuti berhasil diperbarui', 'data' => $cuti], 200);
    }

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'approved';
        $cuti->save();

        return response()->json(['message' => 'Pengajuan cuti berhasil disetujui'], 200);
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'rejected';
        $cuti->save();

        return response()->json(['message' => 'Pengajuan cuti telah ditolak'], 200);
    }

    private function validateRequest($request)
    {
        return $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'jenis_cuti' => 'required|string',
            'mulai_cuti' => 'required|date',
            'selesai_cuti' => 'required|date|after_or_equal:mulai_cuti',
            'jumlah_hari' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);
    }

    private function isOverlappingCuti($request, $cuti)
    {
        return $cuti->mulai_cuti <= $request->selesai_cuti && $cuti->selesai_cuti >= $request->mulai_cuti;
    }

    private function validateCutiTahunan($pegawai, $jumlah_hari)
    {
        $cutiTahunanTersisa = $pegawai->cutiTahunanTersisa(); 
        return $cutiTahunanTersisa >= $jumlah_hari;
    }

    private function validateCutiBesar($pegawai)
    {
        $cutiBesarTerakhir = $pegawai->cutiBesarTerakhir(); 
        return !$cutiBesarTerakhir || $cutiBesarTerakhir->created_at->diffInYears(now()) >= 5;
    }
}
