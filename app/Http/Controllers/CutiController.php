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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                    // if ($item->tanggal_mulai >= $tanggal_saat_ini) {
                    //     $status = 'pending';
                    // }
                    // return 'tes';
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
        }
        return view('pages.cuti.data-cuti-aktif.index');
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
        // return $request->all();
        $validatedData = $request->validate([
            'jenis_cuti' => 'required',
            'alasan_cuti' => 'required',
            'mulai_cuti' => 'required',
            'selesai_cuti' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jumlah_hari' => 'required',
            'link_cuti' => 'required',
        ]);
        $mulai_cuti = $request->mulai_cuti;
        $selesai_cuti = $request->selesai_cuti;
        $pegawai = Pegawai::find($request->pegawai_id);
        $cuti = Cuti::where('pegawai_id', $pegawai->id)->orderBy('selesai_cuti', 'desc')->first();
        if ($cuti) {
            $dataCuti = Cuti::where('pegawai_id', $request->pegawai_id)
                ->where(function ($query) use ($mulai_cuti, $selesai_cuti) {
                    $query->whereBetween('mulai_cuti', [$mulai_cuti, $selesai_cuti])
                        ->orWhereBetween('selesai_cuti', [$mulai_cuti, $selesai_cuti]);
                })->get();
            $validasi = Carbon::parse($cuti->mulai_cuti) <= Carbon::parse($request->mulai_cuti) && Carbon::parse($cuti->selesai_cuti) >= Carbon::parse($request->selesai_cuti);
            // return ['data cuti' => $dataCuti, 'validasi' => $validasi, 'mulai cuti' => $mulai_cuti, 'selesai cuti' => $selesai_cuti];
            if ($dataCuti || $validasi) {
                alert()->error('gagal', 'periode cuti masih berlaku');
                return redirect()->back()->withInput()->with('toast_success', 'periode cuti masih berlaku');
            }
        }
        if ($request->jenis_cuti == 'cuti tahunan') {
            if ($pegawai->sisa_cuti_tahunan >= $request->jumlah_hari) {
                $pegawai->update(
                    [
                        'sisa_cuti_tahunan' => $pegawai->sisa_cuti_tahunan - $request->jumlah_hari
                    ]
                );
            } else {
                alert()->error('gagal', 'cuti tahunan pegawai ' . $pegawai->nama_lengkap ?? $pegawai->nama_depan . 'telah habis pada tahun ini');
                return redirect()->back()->with('error', 'cuti tahunan pegawai ' . $pegawai->nama_lengkap ?? $pegawai->nama_depan . 'telah habis pada tahun ini')->withInput();
            }
        }
        if ($request->jenis_cuti == 'cuti besar') {
            if ($pegawai->sisa_cuti_tahunan  == 0) {
                alert()->error('gagal', 'cuti tahunan pegawai' . $pegawai->nama_lengkap ?? $pegawai->nama_depan . 'telah habis pada tahun ini');
                return redirect()->back()->with('error', 'cuti tahunan pegawai' . $pegawai->nama_lengkap ?? $pegawai->nama_depan . 'telah habis pada tahun ini')->withInput();
            } else {
                $pegawai->update(
                    [
                        'sisa_cuti_tahunan' => 0
                    ]
                );
            }
        }
        $create = Cuti::create($request->all());
        // if (Carbon::parse($request->mulai_cuti) > Carbon::parse(now())) {
        //     $create->update(['status' => 'pending']);
        // } else if (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now()) && Carbon::parse($request->selesai_cuti) >= Carbon::parse(now())) {
        //     $create->update(['status' => 'aktif']);
        //     $pegawai->update(['status_pegawai' => 'nonaktif']);
        // } else {
        //     $create->update(['status' => 'nonaktif']);
        // }
        $notif = Notifikasi::notif('cuti', 'data cuti  pegawai ' . $pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-week');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawai->id);
        alert()->success('berhasil', 'data cuti pegawai berhasi dibuat oleh ' . auth()->user()->name);
        return redirect()->route('admin.cuti.data-cuti-aktif.index')->with('success', 'data cuti berhasi ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti)
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
    public function update(Request $request, Cuti $cuti)
    {
        // Mencari data pegawai yang akan diperbarui
        $pegawaiUpdate = Pegawai::find($request->pegawai_id);
        if (!$pegawaiUpdate) {
            return 'pegawai dengan id yang dimasukkan tidak ada';
        }

        // Validasi input dari pengguna
        $validatedData = $request->validate([
            'jenis_cuti' => 'required',
            'alasan_cuti' => 'required',
            'mulai_cuti' => 'required',
            'selesai_cuti' => 'required',
            'jumlah_hari' => 'required',
            'link_cuti' => 'required',
        ]);
        // try {
        //code...

        // Memeriksa apakah pegawai yang diperbarui sama dengan pegawai yang terkait dengan cuti
        if ($pegawaiUpdate != $cuti->pegawai) {

            // Mencari cuti sebelumnya untuk pegawai yang sama
            $cutiPegawai = Cuti::where('pegawai_id', $request->pegawai_id)->orderBy('selesai_cuti', 'desc')->first();

            // Memeriksa apakah periode cuti masih berlaku
            if ($cutiPegawai && $cutiPegawai->selesai_cuti >= $request->selesai_cuti) {
                Alert::alert('Data Cuti Gagal diupdate', 'data cuti masih ada, mohon periksa kembali data pegawai', 'error');
                return redirect()->back()->withInput()->with('toast_success', 'periode cuti masih berlaku');
            }
            // Menambahkan jumlah cuti ke sisa cuti tahunan pegawai
            $cuti->pegawai->update([
                'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan + $cuti->jumlah_hari,
                // 'status_pegawai' => 'aktif'
            ]);
            // Memeriksa jenis cuti dan mengurangkan sisa cuti tahunan jika memenuhi syarat
            if ($request->jenis_cuti == 'cuti tahunan' && $pegawaiUpdate->sisa_cuti_tahunan >= $request->jumlah_hari) {
                $pegawaiUpdate->update([
                    'sisa_cuti_tahunan' => $pegawaiUpdate->sisa_cuti_tahunan - $request->jumlah_hari
                ]);
            } elseif ($request->jenis_cuti == 'cuti tahunan' && $pegawaiUpdate->sisa_cuti_tahunan < $request->jumlah_hari) {
                return redirect()->back()->with('error', 'cuti tahunan pegawai ' . ($pegawaiUpdate->nama_lengkap ?? $pegawaiUpdate->nama_depan) . ' telah habis pada tahun ini')->withInput();
            }

            // Memeriksa jenis cuti besar dan mengatur sisa cuti tahunan menjadi 0 jika memenuhi syarat
            if ($request->jenis_cuti == 'cuti besar' && $pegawaiUpdate->sisa_cuti_tahunan == 0) {
                return redirect()->back()->with('error', 'cuti tahunan pegawai ' . ($pegawaiUpdate->nama_lengkap ?? $pegawaiUpdate->nama_depan) . ' telah habis pada tahun ini')->withInput();
            } elseif ($request->jenis_cuti == 'cuti besar' && $pegawaiUpdate->sisa_cuti_tahunan != 0) {
                $pegawaiUpdate->update(['sisa_cuti_tahunan' => 0]);
            }


            // Membuat data cuti baru
            $cuti->update($request->all());

            // Mengatur status cuti berdasarkan tanggal mulai dan selesai
            // if (Carbon::parse($request->mulai_cuti) > Carbon::parse(now())) {
            //     $cuti->update(['status' => 'pending']);
            // } elseif (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now()) && Carbon::parse($request->selesai_cuti) >= Carbon::parse(now())) {
            //     $cuti->update(['status' => 'aktif']);
            //     // $pegawaiUpdate->update(['status_pegawai' => 'nonaktif']);
            // } else {
            //     $cuti->update(['status' => 'nonaktif']);
            // }

            // Mengarahkan kembali ke halaman indeks data cuti aktif
            $notif = Notifikasi::notif('cuti', 'data cuti  pegawai ' . $pegawaiUpdate->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-week');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawaiUpdate->id);
            alert()->success('berhasil', 'data cuti pegawai berhasi dibuat oleh ' . auth()->user()->name);
            return redirect()->route('admin.cuti.data-cuti-aktif.index')->with('success', 'data cuti berhasil ditambahkan');
        }
        if ($request->jenis_cuti == $cuti->jenis_cuti && $request->jenis_cuti == 'cuti tahunan') {
            $cuti->pegawai->update([
                'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan + $cuti->jumlah_hari,
                // 'status_pegawai' => 'aktif'
            ]);
        } elseif ($request->jenis_cuti != $cuti->jenis_cuti && $cuti->jenis_cuti == 'cuti tahunan') {
            $cuti->pegawai->update([
                'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan + $cuti->jumlah_hari,
                // 'status_pegawai' => 'aktif'
            ]);
        } elseif ($request->jenis_cuti != $cuti->jenis_cuti && $cuti->jenis_cuti == 'cuti besar') {
            $cuti->pegawai->update([
                'sisa_cuti_tahunan' => 12,
                // 'status_pegawai' => 'aktif'
            ]);
        }

        // Memeriksa jenis cuti tahunan dan mengurangkan sisa cuti tahunan jika memenuhi syarat
        if ($request->jenis_cuti == 'cuti tahunan' && $cuti->pegawai->sisa_cuti_tahunan >= $request->jumlah_hari) {
            $cuti->pegawai->update(['sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan - $request->jumlah_hari]);
        } elseif ($request->jenis_cuti == 'cuti tahunan' && $cuti->pegawai->sisa_cuti_tahunan < $request->jumlah_hari) {
            return redirect()->back()->with('error', 'cuti tahunan pegawai kurang dari ' . $request->jumlah_hari . ', mohon masukkan kembali hari libur pegawai');
        }

        // Memeriksa jenis cuti besar dan mengatur sisa cuti tahunan menjadi 0 jika memenuhi syarat
        if ($request->jenis_cuti == 'cuti besar') {
            if ($cuti->pegawai->sisa_cuti_tahunan == 0) {
                return redirect()->back()->with('error', 'cuti tahunan pegawai ' . ($cuti->pegawai->nama_lengkap ?? $cuti->pegawai->nama_depan) . ' telah habis pada tahun ini');
            } else {
                $cuti->pegawai->update(['sisa_cuti_tahunan' => 0]);
            }
        }

        // Memperbarui data cuti
        $cuti->update($request->all());

        // Mengatur status cuti berdasarkan tanggal mulai
        // if (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now())) {
        //     $cuti->update(['status' => 'aktif']);
        // } else {
        //     $cuti->update(['status' => 'pending']);
        // }
        // if (Carbon::parse($request->mulai_cuti) > Carbon::parse(now())
        // ) {
        //     $cuti->update(['status' => 'pending']);
        // } else if (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now()) && Carbon::parse($request->selesai_cuti) >= Carbon::parse(now())) {
        //     $cuti->update(['status' => 'aktif']);
        //     // $cuti->pegawai->update(['status_pegawai' => 'nonaktif']);
        // } else {
        //     $cuti->update(['status' => 'nonaktif']);
        // }
        $notif = Notifikasi::notif('cuti', 'data cuti  pegawai ' . $pegawaiUpdate->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-week');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawaiUpdate->id);
        alert()->success('berhasil', 'data cuti pegawai berhasi dibuat oleh ' . auth()->user()->name);
        // Mengarahkan kembali ke halaman indeks data cuti aktif
        if ($request->has('histori_cuti')) {
            return redirect()->route('admin.cuti.histori-cuti.index')->with('success', 'data cuti berhasil diupdate');
        }
        return redirect()->route('admin.cuti.data-cuti-aktif.index')->with('success', 'data cuti berhasil diupdate');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return $th->getMessage();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        //
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
                ->rawColumns(['nama_pegawai', 'mulai_cuti', 'selesai_cuti', 'status_tombol', 'aksi'])
                ->toJson();
            // return $dataCuti;
        }
        return view('pages.cuti.histori-cuti.index', [
            'pegawai' => Pegawai::orderBy('nama_lengkap', 'asc')->get(),
            'ruangans' => Ruangan::orderBy('nama_ruangan', 'asc')->get()
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
    private function dataLaporan($cutis)
    {
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
            ['Nama Pegawai', 'Jenis cuti', 'Tanggal', 'Jumlah Hari', 'Alamat', 'No HP', 'Link Cuti'],
            [...$dataLaporan]
        ]);

        return Excel::download($laporan, 'cuti.xlsx');
    }

    public function exportAll(Request $request)
    {
        // return 'testing';
        $cuti = Cuti::orderBy('selesai_cuti', 'desc')->orderBy('pegawai_id', 'asc')->get();
        return $this->dataLaporan($cuti);
    }
    public function exportPertahun(Request $request)
    {
        // return 'testing';
        $cuti = Cuti::where('mulai_cuti', 'like', '%' . $request->year . '%')->orderBy('selesai_cuti', 'desc')->orderBy('pegawai_id', 'asc')->get();
        return $this->dataLaporan($cuti);
    }
}
