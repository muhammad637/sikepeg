<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Admin;
use App\Exports\Export;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
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

    public function __construct()
    {
        // Middleware to restrict access to specific routes
        $this->middleware('role:admin')->only(['index', 'update', 'approve', 'reject']);
        $this->middleware('role:pegawai')->only(['create', 'store']);
    }

    // Data cuti aktif
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cuti = Cuti::query()->whereDate('selesai_cuti', '>=', now()->format('Y-m-d'));
            return DataTables::of($cuti)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', fn($item) => $item->pegawai->nama_lengkap)
                ->addColumn('status_tombol', fn($item) => $this->getStatusButton($item))
                ->filterColumn('status_tombol', fn($query, $keyword) => $this->filterStatusColumn($query, $keyword))
                ->addColumn('aksi', 'pages.cuti.data-cuti-aktif.part.aksi')
                ->addColumn('surat', 'pages.cuti.data-cuti-aktif.part.surat')
                ->rawColumns(['aksi', 'surat', 'nama_lengkap', 'status_tombol'])
                ->toJson();
        }
        return view('pages.cuti.data-cuti-aktif.index', ['bulans' => $this->bulan]);
    }

    public function create()
    {
        return view('pages.cuti.data-cuti-aktif.create', ['result' => Pegawai::all()]);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            Alert::error('Mohon masukkan nama Pegawai');
            return redirect()->back();
        }

        $cuti = Cuti::where('pegawai_id', $pegawai->id)->orderBy('selesai_cuti', 'desc')->first();
        if ($cuti && $this->isOverlappingCuti($request, $cuti)) {
            Alert::error('Gagal', 'Cuti periode ini sudah ada atau tumpang tindih.');
            return redirect()->back()->withInput();
        }

        if ($request->jenis_cuti == 'cuti tahunan' && !$this->validateCutiTahunan($pegawai, $request->jumlah_hari)) {
            Alert::error('Gagal', 'Cuti tahunan pegawai ' . $pegawai->nama_lengkap . ' telah habis pada tahun ini');
            return redirect()->back()->withInput();
        }

        if ($request->jenis_cuti == 'cuti besar' && !$this->validateCutiBesar($pegawai)) {
            Alert::error('Gagal', 'Cuti besar pegawai ' . $pegawai->nama_lengkap . ' telah digunakan dalam 5 tahun terakhir');
            return redirect()->back()->withInput();
        }

        Cuti::create($validatedData);

        Alert::success('Berhasil', 'Pengajuan cuti berhasil ditambahkan');
        return redirect()->route('cuti.index');
    }

    public function update(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);

        $validatedData = $this->validateRequest($request);

        $cuti->update($validatedData);

        Alert::success('Berhasil', 'Data cuti berhasil diperbarui');
        return redirect()->route('cuti.index');
    }

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'approved';
        $cuti->save();

        Alert::success('Berhasil', 'Pengajuan cuti berhasil disetujui');
        return redirect()->route('cuti.index');
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'rejected';
        $cuti->save();

        Alert::error('Ditolak', 'Pengajuan cuti telah ditolak');
        return redirect()->route('cuti.index');
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
        $cutiTahunanTersisa = $pegawai->cutiTahunanTersisa(); // Method ini harus ada di model Pegawai
        return $cutiTahunanTersisa >= $jumlah_hari;
    }

    private function validateCutiBesar($pegawai)
    {
        $cutiBesarTerakhir = $pegawai->cutiBesarTerakhir(); // Method ini harus ada di model Pegawai
        return !$cutiBesarTerakhir || $cutiBesarTerakhir->created_at->diffInYears(now()) >= 5;
    }

    private function getStatusButton($cuti)
    {
        if ($cuti->status == 'pending') {
            return '<button class="btn btn-warning btn-sm">Pending</button>';
        } elseif ($cuti->status == 'approved') {
            return '<button class="btn btn-success btn-sm">Approved</button>';
        } else {
            return '<button class="btn btn-danger btn-sm">Rejected</button>';
        }
    }

    private function filterStatusColumn($query, $keyword)
    {
        $query->where('status', 'like', "%{$keyword}%");
    }
}
