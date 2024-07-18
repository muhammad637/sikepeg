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
use App\Models\PromosiDemosi;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PromosiDemosiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jabatan_terakhir = Pegawai::whereHas('promosiDemosi')->with(['promosiDemosi' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->get();
        if ($request->ajax()) {
            $promosi = PromosiDemosi::query()->where('type', 'demosi')->orderBy('created_at', 'desc');
            if ($request->input('type') != null) {
                $promosi->where('type', $request->type);
            }
            if ($request->input('ruangan_awal') != null) {
                $promosi->where('ruanganawal_id', $request->ruangan_awal);
            }
            if ($request->input('ruangan_baru') != null) {
                $promosi->where('ruanganbaru_id', $request->ruangan_baru);
            }
            if ($request->input('tahun') != null) {
                $promosi->where('tanggal_sk', 'like', '%' . $request->tahun . '%');
            }
            return DataTables::of($promosi)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($item) {
                    return $item->pegawai->nama_lengkap ?? $item->id;
                })
                ->addColumn('status_tombol', function ($item) use ($jabatan_terakhir) {
                    $data = 'nonaktif';
                    foreach ($jabatan_terakhir as $pegawai) {
                        if (isset($pegawai->promosiDemosi) &&  $pegawai->promosiDemosi[0]->id == $item->id) {
                            $data = 'aktif';
                            break;
                        }
                    }
                    $warna = $data == 'aktif' ? 'btn btn-success' : 'btn btn-secondary';
                    return "<div class='$warna'>$data</div>";
                })
                ->addColumn('ruangan_lama', function ($item) {
                    return $item->ruanganawal->nama_ruangan;
                })
                ->addColumn('ruangan_baru', function ($item) {
                    return $item->ruanganbaru->nama_ruangan;
                })
                ->addColumn('aksi', 'pages.promosiDemosi.part.aksi')
                ->rawColumns(['nama_lengkap', 'aksi', 'status_tombol', 'ruangan_lama', 'ruangan_baru'])
                ->make(true);
        }
        // return Ruangan::all();
        return view(
            'pages.promosiDemosi.index',
            [
                'ruangans' => Ruangan::orderBy('nama_ruangan', 'desc')->get(),
                'pegawais' => Pegawai::orderBy('nama_lengkap')->get()
            ]
        );
    }
    public function create()
    {
        return view(
            'pages.promosiDemosi.create',
            [
                'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get()
            ]
        );
    }
    public function store(Request $request)
    {
        // Cari pegawai berdasarkan pegawai_id yang diberikan
        $pegawai = Pegawai::find($request->pegawai_id);

        // Jika pegawai tidak ditemukan, tampilkan pesan error dan redirect ke halaman sebelumnya
        if (!$pegawai) {
            alert()->error('Mohon masukkan nama Pegawai');
            return redirect()->back();
        }

        // Update data pegawai dengan jabatan dan ruangan baru
        $pegawai->update([
            'jabatan' => $request->jabatan_selanjutnya,
            'ruangan_id' => $request->ruanganbaru_id
        ]);

        // Buat objek PromosiDemosi dengan data yang diberikan
        $promosiDemosi =  PromosiDemosi::create([
            'pegawai_id' => $request->pegawai_id,
            'ruanganawal_id' => $request->ruanganawal_id,
            'ruanganbaru_id' => $request->ruanganbaru_id,
            'jabatan_sebelumnya' => $request->jabatan_sebelumnya,
            'jabatan_selanjutnya' => $request->jabatan_selanjutnya,
            'tanggal_berlaku' => $request->tanggal_berlaku,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'link_sk' => $request->link_sk
        ]);

        // Buat notifikasi untuk tindakan promosi/demosi
        $notif = Notifikasi::notif(
            'jabatan',
            $promosiDemosi->type . ' pegawai ' . $promosiDemosi->pegawai->nama_lengkap . ' berhasil ditambahkan oleh ' . auth()->user()->name,
            'bg-success',
            'fas fa-compress-alt'
        );

        // Buat objek notifikasi
        $createNotif = Notifikasi::create($notif);

        // Asosiasikan notifikasi dengan admin dan pegawai terkait
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawai->id);

        // Tampilkan pesan sukses dan redirect ke halaman indeks jabatan
        alert()->success('Promosi/Demosi ' . $pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name);
        return redirect()->route('admin.jabatan.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function show(PromosiDemosi $promosiDemosi)
    {
        //
        return view(
            'pages.promosiDemosi.show',
            [
                'promosiDemosi' => $promosiDemosi
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function edit(PromosiDemosi $promosiDemosi)
    {
        return view('pages.promosiDemosi.edit', [
            'ruangans' => Ruangan::orderBy('nama_ruangan', 'desc')->get(),
            'promosiDemosi' => $promosiDemosi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromosiDemosi $promosiDemosi)
    {
        //
        // return $request->all();
        $pegawai = Pegawai::with(['promosiDemosi' => function ($item) {
            $item->orderBy('tanggal_berlaku', 'desc');
        }])->find($promosiDemosi->pegawai_id);
        if ($pegawai->promosiDemosi[0]->id == $promosiDemosi->id) {
            $pegawai->update([
                'jabatan'  => $request->jabatan_selanjutnya,
                'ruangan_id' => $request->ruanganbaru_id
            ]);
        }
        $promosiDemosi->update([
            'ruanganbaru_id' => $request->ruanganbaru_id,
            'jabatan_sebelumnya' => $request->jabatan_sebelumnya,
            'jabatan_selanjutnya' => $request->jabatan_selanjutnya,
            'tanggal_berlaku' => $request->tanggal_berlaku,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'link_sk' => $request->link_sk
        ]);
        $notif = Notifikasi::notif(
            'jabatan',
            $promosiDemosi->type . '  pegawai ' . $promosiDemosi->pegawai->nama_lengkap . ' berhasil  diedit oleh ' . auth()->user()->name,
            'bg-success',
            'fas fa-compress-alt'
        );
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawai->id);
        alert()->success('data berhasil diupdate');
        return redirect()->route('admin.jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromosiDemosi  $promosiDemosi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromosiDemosi $promosiDemosi)
    {
        //
        $pegawai = Pegawai::with(['promosiDemosi' => function ($item) {
            $item->orderBy('tanggal_berlaku', 'desc');
        }])->find($promosiDemosi->pegawai_id);
        if ($pegawai->promosiDemosi[0]->id == $promosiDemosi->id) {
            $pegawai->update(['jabatan', $promosiDemosi->jabatan_sebelumnya]);
        }
        $notif = Notifikasi::notif(
            'jabatan',
            $promosiDemosi->type . '  pegawai ' . $promosiDemosi->pegawai->nama_lengkap . ' berhasil  dihapus oleh ' . auth()->user()->name,
            'bg-success',
            'fas fa-compress-alt'
        );
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawai->id);
        $promosiDemosi->delete();
        alert()->success('data berhasil dihapus');
        return redirect()->route('admin.jabatan.index');
    }

    // promosi



    public function Riwayat(Request $request)
    {
        $jabatan_terakhir = Pegawai::whereHas('promosiDemosi')->with(['promosiDemosi' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->get();
        if ($request->ajax()) {
            $promosi = PromosiDemosi::query()->where('pegawai_id', $request->pegawai_id)->orderBy('created_at', 'desc');
            return DataTables::of($promosi)
                ->addIndexColumn()

                ->addColumn('status_tombol', function ($item) use ($jabatan_terakhir) {
                    $data = 'nonaktif';
                    foreach ($jabatan_terakhir as $pegawai) {
                        if (isset($pegawai->promosiDemosi) &&  $pegawai->promosiDemosi[0]->id == $item->id) {
                            $data = 'aktif';
                            break;
                        }
                    }
                    $warna = $data == 'aktif' ? 'btn btn-success' : 'btn btn-secondary';
                    return "<div class='$warna'>$data</div>";
                })

                ->addColumn('aksi', 'pages.promosiDemosi.promosi.part.aksi')
                ->rawColumns(['aksi', 'status_tombol'])
                ->make(true);
        }
        // return Ruangan::all();
        return view(
            'pages.promosiDemosi.promosi.index',
            [
                'ruangans' => Ruangan::orderBy('nama_ruangan', 'desc')->get(),
                'pegawais' => Pegawai::orderBy('nama_lengkap')->get()
            ]
        );
    }
    private function dataLaporan($promosiDemosi, $request)
    {
        $dataLaporan = [];
        foreach ($promosiDemosi as $item) {
            array_push($dataLaporan, [
                'Nama Pegawai' => $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan,
                'Tipe' => $item->type,
                'ruangan lama' => Ruangan::findo($item->ruanganawal_id),
                'ruangan baru' => Ruangan::findo($item->ruangabaru_id),
                'jabatan sebelumnya' => $item->jabatan_sebelumnya,
                'jabatan selanjutnya' => $item->jabatan_selanjutnya,
                'No SK' => $item->no_sk,
                'Tanggal Berlaku' => Carbon::parse($item->tanggal_berlaku)->format('d/m/Y'),
                'Tanggal SK' => Carbon::parse($item->tanggal_sk)->format('d/m/Y'),
                'link SK' => $item->link_sk ?? '-',
            ]);
        }
        // return $dataLaporan;
        $laporan = new Export([
            ['Data Rekap jabatan (Promosi Demosi)'],
            ['Nama Pegawai', 'TIpe', 'ruangan lama', 'ruangan baru', 'Jabatan Sebelumnya', 'Jabatan Selanjutnya', 'No SK', 'Tanggal Berlaku', 'Tanggal SK', 'Link SK'],
            [...$dataLaporan]
        ]);

        return Excel::download($laporan, 'jabatan.xlsx');
    }

    public function export_excel(Request $request)
    {
        // return $request->all();
        $promosiDemosi = PromosiDemosi::orderBy('tanggal_berlaku', 'desc')->orderBy('pegawai_id', 'asc');
        if ($request->input('year') != null) {
            $promosiDemosi->where('tanggal_sk', 'like', '%' . $request->year . '%');
        }
        if ($request->input('pegawai_id') != null) {
            $promosiDemosi->where('pegawai_id', $request->pegawai_id);
        }
        if ($request->input('type') != null) {
            $promosiDemosi->where('type', $request->type);
        }
        // return $promosiDemosi->get();
        return $this->dataLaporan($promosiDemosi->get(), $request);
    }
}
