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
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $bulan = [
        '01' => 'Januari',
        '02' => 'Ferbruari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'Sepetember',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
    public function testing()
    {
        $cuti = Cuti::query();
        $dataCuti = DataTables::of($cuti)
            ->addIndexColumn()
            ->toJson();
        return $dataCuti;
    }
    // data cuti aktif
    public function index(Request $request)
    {

        // $cuti = Cuti::where('status', 'aktif')->orWhere('status', 'pending')->get();
        if ($request->ajax()) {
            $cuti = Cuti::query()->whereDate('selesai_cuti', '>=', now()->format('Y-m-d'));
            return  DataTables::of($cuti)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($item) {
                    return $item->pegawai->nama_lengkap;
                    // return 'testing';
                })
                ->addColumn('status_tombol', function ($item) {
                    $tanggal_mulai = Carbon::parse($item->mulai_cuti)->format('Ymd');
                    $tanggal_selesai = Carbon::parse($item->selesai_cuti)->format('Ymd');
                    $tanggal_saat_ini = now()->format('Ymd');
                    $status = 'pending';
                    if ($tanggal_mulai <= $tanggal_saat_ini && $tanggal_selesai >= $tanggal_saat_ini) {
                        $status = 'aktif';
                    }
                    return '<button class="btn  text-white btn-' . ($status == 'aktif' ? 'success' : 'warning') . ' border-0">' . $status . '</button>';
                })
                ->filterColumn('status_tombol', function ($query, $keyword) {
                    if (Str::contains('pending', $keyword)) {
                        $query->where('selesai_cuti', '>=', now()->format('Y-m-d'))->whereDate('mulai_cuti', '>', now()->format('Y-m-d'));
                    }
                    if (Str::contains('aktif', $keyword)) {
                        $query->where('selesai_cuti', '>=', now()->format('Y-m-d'))->whereDate('mulai_cuti', '<=', now()->format('Y-m-d'));
                    } elseif (Str::contains('nonaktif', $keyword)) {
                        $query->where('selesai_cuti', '<', now()->format('Y-m-d'));
                    }
                })
                ->addColumn('aksi', 'pages.cuti.data-cuti-aktif.part.aksi')
                ->addColumn('surat', 'pages.cuti.data-cuti-aktif.part.surat')
                ->rawColumns(['aksi', 'surat', 'nama_lengkap', 'status_tombol'])
                ->toJson();
            // return $dataCuti;
            $cuti = Cuti::all();
            return response()->json($cuti);
        }
        return view('pages.cuti.data-cuti-aktif.index', [
            'bulans' => $this->bulan
        ]);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.cuti.data-cuti-aktif.create', [
            'result' => Pegawai::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cuti = Cuti::create([
            'pegawai_id' => $request->pegawai_id,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
            'status' => $request->status
        ]);

        return response()->json($cuti, 201);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $id)
    {
        $cuti = Cuti::find($id);

        if (is_null($cuti)) {
            return response()->json(['message' => 'Data cuti tidak ditemukan'], 404);
        }

        return response()->json($cuti);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        //
        // return $cuti;
        return view('pages.cuti.edit', [
            'pegawai' => Pegawai::all(),
            'cuti' => $cuti
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cuti = Cuti::find($id);

        if (is_null($cuti)) {
            return response()->json(['message' => 'Data cuti tidak ditemukan'], 404);
        }

        $cuti->update([
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
            'status' => $request->status
        ]);

        return response()->json($cuti);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuti = Cuti::find($id);

        if (is_null($cuti)) {
            return response()->json(['message' => 'Data cuti tidak ditemukan'], 404);
        }

        $cuti->delete();
        return response()->json(['message' => 'Data cuti berhasil dihapus']);
    }
    public function historiCuti(Request $request)
    {
        if ($request->ajax()) {
            $cuti = Cuti::query()->orderBy('selesai_cuti', 'desc');
            $cuti = Cuti::query();
            if ($request->input('tahun') != null) {
                $cuti = $cuti->where('mulai_cuti', 'like', '%' . $request->tahun . '%');
            }
            if ($request->input('pegawai') != null) {
                $cuti = $cuti->where('pegawai_id', $request->pegawai);
            }
            if ($request->input('jenis_cuti') != null) {
                $cuti = $cuti->where('jenis_cuti', $request->jenis_cuti);
            }
            return DataTables::of($cuti)
                ->addIndexColumn()
                ->addColumn('nama_pegawai', function ($item) {
                    return $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan;
                })
                ->addColumn('mulai_cuti', function ($item) {
                    $mulai_cuti = Carbon::parse($item->mulai_cuti)->format('d-M-Y');
                    return $mulai_cuti;
                })
                ->addColumn('selesai_cuti', function ($item) {
                    $selesai_cuti = Carbon::parse($item->selesai_cuti)->format('d-M-Y');
                    return $selesai_cuti;
                })
                ->addColumn('sisa_cuti', function ($item) {
                    $sisa_cuti = $item->pegawai->sisa_cuti_tahunan;
                    return $sisa_cuti;
                })
                ->addColumn('status_tombol', function ($item) {
                    $tanggal_mulai = Carbon::parse($item->mulai_cuti)->format('Ymd');
                    $tanggal_selesai = Carbon::parse($item->selesai_cuti)->format('Ymd');
                    $tanggal_saat_ini = now()->format('Ymd');
                    $status = null;
                    if ($tanggal_mulai <= $tanggal_saat_ini && $tanggal_selesai >= $tanggal_saat_ini) {
                        $status = 'aktif';
                    } elseif ($tanggal_mulai >= $tanggal_saat_ini) {
                        $status = 'pending';
                    } else {
                        $status = 'nonaktif';
                    }
                    // return 'tes';
                    return '<button class="btn  text-white btn-' . ($status == 'aktif' ? 'success' : ($status == 'pending' ? 'warning'  : 'secondary')) . ' border-0">' . $status . '</button>';
                })
                ->filterColumn('status_tombol', function ($query, $keyword) {
                    if (Str::contains('pending', $keyword)) {
                        $query->where('selesai_cuti', '>=', now()->format('Y-m-d'))->whereDate('mulai_cuti', '>', now()->format('Y-m-d'));
                    }
                    if (Str::contains('aktif', $keyword)) {
                        $query->where('selesai_cuti', '>=', now()->format('Y-m-d'))->whereDate('mulai_cuti', '<=', now()->format('Y-m-d'));
                    } elseif (Str::contains('nonaktif', $keyword)) {
                        $query->where('selesai_cuti', '<', now()->format('Y-m-d'));
                    }
                })
                ->addColumn('aksi', 'pages.cuti.histori-cuti.part.aksi')
                // ->addColumn('surat', 'pages.cuti.part.surat')
                ->rawColumns(['nama_pegawai', 'mulai_cuti', 'selesai_cuti', 'sisa_cuti', 'status_tombol', 'aksi'])
                ->toJson();
            // return $dataCuti;
        }
        return view('pages.cuti.histori-cuti.index', [
            'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get(),
            'ruangans' => Ruangan::orderBy('nama_ruangan', 'asc')->get(),
            'bulans' => $this->bulan
        ]);
    }

    public function riwayatCutiPegawai(Request $request, $id)
    {
        $queryCuti = Cuti::query()->where('pegawai_id', $id)->orderBy('mulai_cuti', 'desc');
        $pegawai = Pegawai::find($id);
        if ($request->ajax()) {
            return DataTables::of($queryCuti)
                ->addIndexColumn()
                ->addColumn('mulai_cuti', function ($item) {
                    $mulai_cuti = Carbon::parse($item->mulai_cuti)->format('d-M-Y');
                    return $mulai_cuti;
                })
                ->addColumn('selesai_cuti', function ($item) {
                    $selesai_cuti = Carbon::parse($item->selesai_cuti)->format('d-M-Y');
                    return $selesai_cuti;
                })
                ->addColumn('status_tombol', function ($item) {
                    $tanggal_mulai = Carbon::parse($item->mulai_cuti)->format('Ymd');
                    $tanggal_selesai = Carbon::parse($item->selesai_cuti)->format('Ymd');
                    $tanggal_saat_ini = now()->format('Ymd');
                    $status = null;
                    if ($tanggal_mulai <= $tanggal_saat_ini && $tanggal_selesai >= $tanggal_saat_ini) {
                        $status = 'aktif';
                    } elseif ($item->tanggal_mulai >= $tanggal_saat_ini) {
                        $status = 'pending';
                    } else {
                        $status = 'nonaktif';
                    }
                    // return 'tes';
                    return '<button class="btn  text-white btn-' . ($status == 'aktif' ? 'success' : ($status == 'pending' ? 'warning'  : 'secondary')) . ' border-0">' . $status . '</button>';
                })
                ->addColumn('aksi', 'pages.cuti.part.aksi')
                ->addColumn('surat', 'pages.cuti.part.surat')
                ->rawColumns(['mulai_cuti', 'selesai_cuti', 'status_tombol', 'surat', 'aksi'])
                ->toJson();
        }
        return view('pages.cuti.index', [
            'id' => $id,
            'pegawai' => $pegawai,
            'testing' => 'testing'
        ]);
    }

    public function tambahCutiMasaLalu(Request $request)
    {
        return $request->all();
    }
    public function showRiwayat(Cuti $cuti)
    {
        //
        return view('pages.cuti.show', [
            'cuti' => $cuti
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function editRiwayat(Cuti $cuti)
    {

        return view('pages.cuti.histori-cuti.edit', [
            'pegawai' => Pegawai::all(),
            'cuti' => $cuti
        ]);
    }
    private function dataLaporan($cutis, $request)
    {
        $bulan = $request->bulan != null ? 'bulan ' . $this->bulan[$request->bulan] : 'semua bulan';
        $tahun = $request->tahun != null ? 'tahun ' . $request->tahun : 'semua';

        $dataLaporan = [];
        foreach ($cutis as $cuti) {
            array_push($dataLaporan, [
                'Nama Pegawai' => $cuti->pegawai->nama_lengkap ?? $cuti->pegawai->nama_depan,
                'jenis_cuti' => $cuti->jenis_cuti,
                'Tanggal' => Carbon::parse($cuti->mulai_cuti)->format('d/m/Y') . ' - ' . Carbon::parse($cuti->selesai_cuti)->format('d/m/Y'),
                'jumlah_hari' => $cuti->jumlah_hari . ' hari',
                'alamat' => $cuti->alamat,
                'no_hp' => $cuti->no_hp,
                'link_cuti' => $cuti->link_cuti,
            ]);
        }
        // return $dataLaporan;
        $laporan = new Export([
            ["Rekapan Data Cuti $bulan, $tahun"],
            ['Nama Pegawai', 'Jenis cuti', 'Tanggal', 'Jumlah Hari', 'Alamat', 'No HP', 'Link Cuti'],
            [...$dataLaporan]
        ]);

        return Excel::download($laporan, 'cuti.xlsx');
    }

    public function exportAll(Request $request)
    {
        // return 'testing';
        $cuti = Cuti::query()->orderBy('selesai_cuti', 'desc')->orderBy('pegawai_id', 'asc');
        if ($request->bulan != null) {
            $cuti->whereMonth('mulai_cuti', $request->bulan);
        }
        if ($request->tahun != null) {
            $cuti->whereYear('mulai_cuti', $request->tahun);
        }
        return $this->dataLaporan($cuti->get(), $request);
    }
}
