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
    public function index(Request $request)
    {
        // $pegawai = Pegawai::where('status_tenaga', 'asn')->with(['diklat' => function ($query) {
        //     $query;
        // }])->whereHas('diklat', function ($query) {
        //     $query->orderBy('created_at', 'desc');
        // })->get();

        // return $pegawai;
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
            if ($request->input('tahun') != null) {
                $diklat->where('tanggal_selesai', 'like', '%' . $request->tahun . '%');
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
                // ->addColumn('aksi', function($item){
                //     $show = "<a href='" . route('admin.diklat.riwayat', ['pegawai' => $item->id]) . "'
                //                             class='badge p-2 text-white bg-info mr-1'><i class='fas fa-info-circle'></i></a>";
                //     $edit = "<a href='" . route('admin.diklat.edit', ['diklat' => $item->diklat[0]->id]) . "'
                //                             class='badge p-2 text-white bg-warning mr-1'><i class='fas fa-pen'></i></a>";
                //     return "<div class='d-flex'>$show $edit</div>";
                // })
                ->addColumn('aksi', 'pages.diklat.part.aksi-index')
                ->rawColumns(['nama', 'nama_diklat', 'nama_ruangan', 'penyelenggara', 'tahun', 'no_sertifikat', 'surat', 'aksi'])
                ->toJson();
            return $dataPegawaiDiklat;
        }
        return view('pages.diklat.index', [
            'ruangans' => Ruangan::orderBy('nama_ruangan', 'asc')->get(),
            'dataNamaDiklat' => $dataNamaDiklat
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
            $diklat->update(
                [
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
                ]
            );
            $notif = Notifikasi::notif('diklat', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($diklat->pegawai->id);
            alert()->success('berhasil', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name);
            if (isset($request->riwayat)) {
                return redirect(route('admin.diklat.riwayat', ['pegawai' => $request->pegawai_id]))->with('success', 'diklat berhasil diupdate');
            }
            return redirect(route('admin.diklat.index'))->with('success', 'diklat berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }


    public function store(Request $request)
    {
        // try {
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
            'ruangan_id' => 'required'
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
            'ruangan_id' => $request->ruangan_id
        ]);

        $notif = Notifikasi::notif('diklat', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($diklat->pegawai->id);
        alert()->success('berhasil', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name);
        return redirect()->route('admin.diklat.index')->with('success', 'diklat berhasil ditambahkan');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return $th->getMessage();
        // }
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
    private function dataLaporan($diklats)
    {
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
            ['Nama Pegawai', 'Nama Diklat', 'Tanggal', 'Jumlah Hari', 'Jumlah Jam', 'Penyelenggara', 'Tempat', 'No Sertifikat', 'Tanggal Sertifikat', 'Link Sertifikat'],
            [...$dataLaporan]
        ]);

        return Excel::download($laporan, 'diklat.xlsx');
    }

    public function export_excel(Request $request)
    {
        // return 'testing';
        $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('str', function ($query) {
            $query->orderBy('masa_berakhir_str', 'desc');
        })->get();
        return $this->dataLaporan($pegawai);
    }

    public function exportAll(Request $request)
    {
        $diklats = Diklat::query()->orderBy('created_at','desc');
        if ($request->input('diklat') != null) {
            $diklats->where('nama_diklat', $request->diklat);
        }
        if ($request->input('ruangan') != null) {
            $diklats->where('ruangan_id', $request->ruangan);
        }
        if ($request->input('tahun') != null) {
            $diklats->where('tahun', $request->tahun);
        }
        // return $request->all();
        // return $diklats->get();
        return $this->dataLaporan($diklats->get());
    }

    public function exportYear(Request $request)
    {
        $diklats = Diklat::where('tahun', $request->year)->orderBy('created_at', 'desc')->get();
        return $this->dataLaporan($diklats);
    }
    public function exportYearRange(Request $request)
    {
        if ($request->yearAwal > $request->yearAkhir) {
            alert()->error('mohon masukan rentang tahun dengan baik dan benar');
            return redirect()->back();
        }
        $diklats = Diklat::whereBetween('tahun', [$request->yearAwal, $request->yearAkhir])->orderBy('created_at', 'desc')->get();
        return $this->dataLaporan($diklats);
    }
}
