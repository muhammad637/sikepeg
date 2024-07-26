<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\STR;
use App\Models\Admin;
use App\Models\Diklat;
use App\Exports\Export;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Maatwebsite\Excel\Facades\Excel;

class DiklatController extends Controller
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

    public function index(Request $request)
    {
        $dataNamaDiklat = [];
        $nama_diklats = Diklat::orderBy('nama_diklat', 'asc')->get();

        foreach ($nama_diklats as $item) {
            if (!in_array($item->nama_diklat, $dataNamaDiklat)) {
                $dataNamaDiklat[] = $item->nama_diklat;
            }
        }

        if ($request->ajax()) {
            $diklat = Diklat::query()->orderBy('tanggal_selesai', 'desc');
            if ($request->input('nama_diklat') != null) {
                $diklat->where('nama_diklat', $request->nama_diklat);
            }
            if ($request->input('ruangan') != null) {
                $diklat->where('ruangan_id', $request->ruangan);
            }
            if ($request->input('bulan') != null) {
                $diklat->whereMonth('tanggal_selesai', $request->bulan);
            }
            if ($request->input('tahun') != null) {
                $diklat->whereYear('tanggal_selesai', $request->tahun);
            }
            $dataPegawaiDiklat = DataTables::of($diklat)
                ->addIndexColumn()
                ->addColumn('nama', function ($item) {
                    return $item->pegawai->nama_lengkap ?? $item->nama_depan;
                })
                ->addColumn('nama_diklat', function ($item) {
                    return $item->nama_diklat;
                })
                ->addColumn('nama_ruangan', function ($item) {
                    return $item->ruangan->nama_ruangan;
                })
                ->addColumn('penyelenggara', function ($item) {
                    return $item->penyelenggara;
                })
                ->addColumn('tahun', function ($item) {
                    return $item->tahun;
                })
                ->addColumn('no_sertifikat', function ($item) {
                    return $item->no_sertifikat;
                })
                ->addColumn('surat', 'pages.surat.diklat-index')
                ->addColumn('aksi', 'pages.diklat.part.aksi-index')
                ->rawColumns(['nama', 'nama_diklat', 'nama_ruangan', 'penyelenggara', 'tahun', 'no_sertifikat', 'surat', 'aksi'])
                ->toJson();
            return $dataPegawaiDiklat;
        }

        return view('pages.diklat.index', [
            'ruangans' => Ruangan::orderBy('nama_ruangan', 'asc')->get(),
            'dataNamaDiklat' => $dataNamaDiklat,
            'bulan' => $this->bulan,
        ]);
    }

    public function create()
    {
        $pegawai = Pegawai::where('status_tenaga', 'asn')->get();
        return view('pages.diklat.create', ['pegawai' => $pegawai]);
    }

    public function edit(Diklat $diklat)
    {
        return view('pages.diklat.edit', [
            'results' => Pegawai::all(),
            'diklat' => $diklat,
        ]);
    }

    public function update(Request $request, Diklat $diklat)
    {
        try {
            $validatedData = $request->validate([
                'nama_diklat' => 'required',
                'jumlah_jam' => 'required',
                'penyelenggara' => 'required',
                'tempat' => 'required',
                'tahun' => 'required',
                'no_sertifikat' => 'required',
                'tanggal_sertifikat' => 'required',
                'link_sertifikat' => 'required',
            ]);
            $diklat->update([
                'pegawai_id' => $request->pegawai_id,
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
                'link_sertifikat' => $request->link_sertifikat,
                'status' => $request->status,
            ]);
            $notif = Notifikasi::notif('diklat', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);
            alert()->success('berhasil', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil diupdate oleh ' . auth()->user()->name);
            if (isset($request->riwayat)) {
                return redirect(route('admin.diklat.riwayat', ['pegawai' => $request->pegawai_id]))->with('success', 'Diklat berhasil diupdate');
            }
            return redirect(route('admin.diklat.index'))->with('success', 'Diklat berhasil diupdate');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_diklat' => 'required',
            'jumlah_jam' => 'required|integer',
            'penyelenggara' => 'required',
            'tempat' => 'required',
            'tahun' => 'required',
            'no_sertifikat' => 'required',
            'tanggal_sertifikat' => 'required|date',
            'link_sertifikat' => 'required',
            'ruangan_id' => 'required',
        ]);

        $diklat = Diklat::create([
            'pegawai_id' => $request->pegawai_id,
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
            'link_sertifikat' => $request->link_sertifikat,
            'ruangan_id' => $request->ruangan_id,
            'status' => 'pending',
        ]);

        $notif = Notifikasi::notif('diklat', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($diklat->pegawai->id);

        alert()->success('Berhasil', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name);
        return redirect()->route('admin.diklat.index')->with('success', 'Diklat berhasil ditambahkan');
    }

    public function show(Diklat $diklat)
    {
        return response()->json($diklat);
    }

    public function destroy(Diklat $diklat)
    {
        $diklat->delete();
        alert()->success('Berhasil', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dihapus oleh ' . auth()->user()->name);
        return back()->with('success', 'Diklat berhasil dihapus');
    }

    public function validateDiklat(Request $request, Diklat $diklat)
    {
        $status = $request->input('status');
        if ($status == 'disetujui') {
            $diklat->status = 'aktif';
        } elseif ($status == 'ditolak') {
            $diklat->status = 'nonaktif';
        }
        $diklat->save();
        alert()->success('Berhasil', 'Status diklat berhasil diubah menjadi ' . $diklat->status . ' oleh ' . auth()->user()->name);
        return back()->with('success', 'Status diklat berhasil diubah');
    }
}
