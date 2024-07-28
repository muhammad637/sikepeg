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
    //
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
                ->addColumn('status_diklat', function ($item){
                    return $item->status_diklat;
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
                'status_diklat' => 'required|in:pending,disetujui,ditolak',
            ]);

            $status_diklat = $request->input('status_diklat');

            // Update diklat
            $diklat->update([
                'status_diklat' => $status_diklat,
            ]);

            // Notify about the update
            $notif = Notifikasi::notif(
                'diklat',
                'Status diklat ' . $diklat->nama_diklat . ' berhasil diupdate oleh ' . auth()->user()->name,
                'bg-success',
                'fas fa-chalkboard-teacher'
            );
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);
            alert()->success('Berhasil', 'Status diklat ' . $diklat->nama_diklat . ' berhasil diupdate oleh ' . auth()->user()->name);

            return redirect(route('admin.diklat.index'))->with('success', 'Status diklat berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    


    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_diklat' => 'required',
            'jumlah_jam' => 'required|integer',
            'penyelenggara' => 'required',
            'tempat' => 'required',
            'tahun' => 'required',
            'ruangan_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'jumlah_hari' => 'required|integer',
        ]);

        // Membuat objek Diklat dengan menggunakan data yang valid
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
            'status_diklat' => 'pending',
            'ruangan_id' => $request->ruangan_id,
        ]);

        // Membuat notifikasi untuk tindakan tambah data diklat
        $notif = Notifikasi::notif('diklat', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
        $createNotif = Notifikasi::create($notif);

        // Mengasosiasikan notifikasi dengan admin dan pegawai terkait
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($diklat->pegawai->id);

        // Menampilkan pesan sukses dan mengarahkan ke halaman indeks diklat
        alert()->success('Berhasil', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name);
        return redirect()->route('admin.diklat.index')->with('success', 'Diklat berhasil ditambahkan');
    }




    public function show(Diklat $diklat)
    {
        return view('pages.diklat.show', [
            'diklat' => $diklat,
        ]);
    }

    public function riwayat(Pegawai $pegawai, Request $request)
    {
        if ($request->ajax()) {
            $diklat = Diklat::query()->where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc');

            $dataPegawaiDiklat = DataTables::of($diklat)
                ->addIndexColumn()
                ->addColumn('nama', function ($item) {
                    return $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan;
                })
                ->addColumn('nama_diklat', function ($item) {
                    return $item->nama_diklat;
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
                ->addColumn('surat', 'pages.surat.diklat-riwayat')
                ->addColumn('aksi', 'pages.diklat.part.aksi-riwayat')
                ->rawColumns(['nama', 'nama_diklat', 'penyelenggara', 'tahun', 'no_sertifikat', 'surat', 'aksi'])
                ->toJson();
            return $dataPegawaiDiklat;
        }
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc')->get();
        return view('pages.diklat.riwayat.index', [
            'pegawai' => $pegawai,
            'diklat' => $diklat
        ]);
    }

    public function showRiwayat(Diklat $diklat)
    {
        return view('pages.diklat.riwayat.show', [
            'diklat' => $diklat
        ]);
    }

    public function editRiwayat(Diklat $diklat)
    {
        return view('pages.diklat.riwayat.edit', [
            'diklat' => $diklat,
            'results' => Pegawai::all()
        ]);
    }

    public function destroy(Diklat $diklat)
    {
        $diklat->delete();
        alert()->success('data diklat berhasil dihapus');
        return redirect()->back();
    }
    private function dataLaporan($diklats, $request)
    {
       
       
        $namaDiklat = $request->diklat != null ?  $request->diklat : 'semua nama diklat';
        $ruangan = $request->ruangan != null ?  Ruangan::find($request->ruangan)->nama_ruangan : 'semua ruangan';
        $bulan = $request->bulan != null ?  $this->bulan[$request->bulan] : 'semua bulan';
        $tahun = $request->tahun != null ?  $request->tahun : 'semua tahun';
        $dataLaporan = [];
        foreach ($diklats as $diklat) {
            array_push($dataLaporan, [
                'Nama Pegawai' => $diklat->pegawai->nama_lengkap ?? $diklat->pegawai->nama_depan,
                'nama_diklat' => $diklat->nama_diklat,
                'Tanggal' => Carbon::parse($diklat->tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($diklat->tanggal_selesai)->format('d/m/Y'),
                'jumlah_hari' => $diklat->jumlah_hari . ' hari',
                'jumlah_jam' => $diklat->jumlah_jam . ' jam',
                'penyelenggara' => $diklat->penyelenggara,
                'tempat' => $diklat->tempat,
                'no_sertifikat' => $diklat->no_sertifikat,
                'tanggal_sertifikat' => $diklat->tanggal_sertifikat,
                'link_sertifikat' => $diklat->link_sertifikat
            ]);
        }
        // return $dataLaporan;
        $laporan = new Export([
            ["Rekapan Data Diklat"],
            ["Diklat : $namaDiklat"],
            ["Bulan : $bulan"],
            ["Tahun : $tahun"],
            ["Ruangan: $ruangan"],
            ['Nama Pegawai', 'Nama Diklat', 'Tanggal', 'Jumlah Hari', 'Jumlah Jam', 'Penyelenggara', 'Tempat', 'No Sertifikat', 'Tanggal Sertifikat', 'Link Sertifikat'],
            [...$dataLaporan]
        ]);

        return Excel::download($laporan, 'diklat.xlsx');
    }

    // public function export_excel(Request $request)
    // {
    //     // return 'testing';
    //     $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('str', function ($query) {
    //         $query->orderBy('masa_berakhir_str', 'desc');
    //     })->get();
    //     return $this->dataLaporan($pegawai);
    // }

    public function exportAll(Request $request)
    {
        $diklats = Diklat::query()->orderBy('created_at', 'desc');
        if ($request->input('diklat') != null) {
            $diklats->where('nama_diklat', $request->diklat);
        }
        if ($request->input('ruangan') != null) {
            $diklats->where('ruangan_id', $request->ruangan);
        }
        if ($request->input('bulan') != null) {
            $diklats->whereMonth('tanggal_mulai', $request->bulan);
        }
        if ($request->input('tahun') != null) {
            $diklats->where('tahun', $request->tahun);
        }
        // return $request->all();
        // return $diklats->get();
        return $this->dataLaporan($diklats->get(), $request);
    }

    public function exportYear(Request $request)
    {
        $diklats = Diklat::where('tahun', $request->year)->orderBy('created_at', 'desc')->get();
        return $this->dataLaporan($diklats, $request);
    }
    public function exportYearRange(Request $request)
    {
        if ($request->yearAwal > $request->yearAkhir) {
            alert()->error('mohon masukan rentang tahun dengan baik dan benar');
            return redirect()->back();
        }
        $diklats = Diklat::whereBetween('tahun', [$request->yearAwal, $request->yearAkhir])->orderBy('created_at', 'desc')->get();
        return $this->dataLaporan($diklats, $request);
    }
}
