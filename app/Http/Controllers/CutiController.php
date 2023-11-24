<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
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
            $cuti = Cuti::query()->where('status', 'aktif')->orWhere('status', 'pending');
            return  DataTables::of($cuti)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($item) {
                    return $item->pegawai->nama_lengkap;
                    // return 'testing';
                })
                ->addColumn('status_tombol', function ($item) {
                    // return 'tes';
                    return '<button class="badge p-2 text-white bg-' . ($item->status == 'aktif' ? 'success' : 'secondary') . ' border-0">' . $item->status . '</button>';
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

        $validatedData = $request->validate([
            'jenis_cuti' => 'required',
            'alasan_cuti' => 'required',
            'mulai_cuti' => 'required',
            'selesai_cuti' => 'required',
            'jumlah_hari' => 'required',
            'link_cuti' => 'required',
        ]);
        $mulai_cuti = $request->mulai_cuti;
        $selesai_cuti = $request->selesai_cuti;
        $pegawai = Pegawai::find($request->pegawai_id);
        $cuti = Cuti::where('pegawai_id',$pegawai->id)->orderBy('selesai_cuti','desc')->first();
        if ($cuti) {
            $dataCuti = Cuti::where('pegawai_id', $request->pegawai_id)
                ->where(function ($query) use ($mulai_cuti, $selesai_cuti) {
                    $query->whereBetween('mulai_cuti', [$mulai_cuti, $selesai_cuti])
                        ->orWhereBetween('selesai_cuti', [$mulai_cuti, $selesai_cuti]);
                })->get();
            $validasi = Carbon::parse($cuti->mulai_cuti) <= Carbon::parse($request->mulai_cuti) && Carbon::parse($cuti->selesai_cuti) >= Carbon::parse($request->selesai_cuti);
            // return ['data cuti' => $dataCuti, 'validasi' => $validasi, 'mulai cuti' => $mulai_cuti, 'selesai cuti' => $selesai_cuti];
            if($dataCuti || $validasi){
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
        if (Carbon::parse($request->mulai_cuti) > Carbon::parse(now())) {
            $create->update(['status' => 'pending']);
        } else if (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now()) && Carbon::parse($request->selesai_cuti) >= Carbon::parse(now())) {
            $create->update(['status' => 'aktif']);
            $pegawai->update(['status_pegawai' => 'nonaktif']);
        } else {
            $create->update(['status' => 'nonaktif']);
        }
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
                'status_pegawai' => 'aktif'
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
            if (Carbon::parse($request->mulai_cuti) > Carbon::parse(now())) {
                $cuti->update(['status' => 'pending']);
            } elseif (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now()) && Carbon::parse($request->selesai_cuti) >= Carbon::parse(now())) {
                $cuti->update(['status' => 'aktif']);
                $pegawaiUpdate->update(['status_pegawai' => 'nonaktif']);
            } else {
                $cuti->update(['status' => 'nonaktif']);
            }

            // Mengarahkan kembali ke halaman indeks data cuti aktif
            $notif = Notifikasi::notif('cuti', 'data cuti  pegawai ' . $pegawaiUpdate->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-week');
            $createNotif = Notifikasi::create($notif);
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawaiUpdate->id);
            alert()->success('berhasil', 'data cuti pegawai berhasi dibuat oleh ' . auth()->user()->name);
            return redirect()->route('admin.cuti.data-cuti-aktif.index')->with('success', 'data cuti berhasil ditambahkan');
        }
        if($request->jenis_cuti == $cuti->jenis_cuti && $request->jenis_cuti == 'cuti tahunan'){  
            $cuti->pegawai->update([
                'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan + $cuti->jumlah_hari,
                'status_pegawai' => 'aktif'
            ]);
        }elseif($request->jenis_cuti != $cuti->jenis_cuti && $cuti->jenis_cuti == 'cuti tahunan'){
            $cuti->pegawai->update([
                'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan + $cuti->jumlah_hari,
                'status_pegawai' => 'aktif'
            ]);
        } elseif ($request->jenis_cuti != $cuti->jenis_cuti && $cuti->jenis_cuti == 'cuti besar') {
            $cuti->pegawai->update([
                'sisa_cuti_tahunan' => 12,
                'status_pegawai' => 'aktif'
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
        if (Carbon::parse($request->mulai_cuti) > Carbon::parse(now())
        ) {
            $cuti->update(['status' => 'pending']);
        } else if (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now()) && Carbon::parse($request->selesai_cuti) >= Carbon::parse(now())) {
            $cuti->update(['status' => 'aktif']);
            $cuti->pegawai->update(['status_pegawai' => 'nonaktif']);
        } else {
            $cuti->update(['status' => 'nonaktif']);
        }
        $notif = Notifikasi::notif('cuti', 'data cuti  pegawai ' . $pegawaiUpdate->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-week');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($pegawaiUpdate->id);
        alert()->success('berhasil', 'data cuti pegawai berhasi dibuat oleh ' . auth()->user()->name);
        // Mengarahkan kembali ke halaman indeks data cuti aktif
        if($cuti->status == 'nonaktif'){
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
        // $pegawai = Pegawai::whereHas('cuti' , function ($q) {
        //     $q->where('status', 'nonaktif')->orderBy('mulai_cuti', 'desc');
        // })->with('cuti')->get();
        // return $pegawai;

        if ($request->ajax()) {
            $pegawai = Pegawai::query()->with(['cuti' => function($q){
                $q->where('status','nonaktif')->orderBy('selesai_cuti','desc');
            }])->whereHas('cuti', function ($q) {
                $q->where('status', 'nonaktif')->orderBy('selesai_cuti', 'desc');
                // $q->where('status', 'nonaktif')->sortByDesc('selesai_cuti');
            });
            return DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('jenis_cuti', function ($item) {
                    return $item->cuti[0]->jenis_cuti;
                })
                ->addColumn('alasan_cuti', function ($item) {
                    return $item->cuti[0]->alasan_cuti;
                })
                ->addColumn('jumlah_hari', function ($item) {
                    return $item->cuti[0]->jumlah_hari;
                })
                ->addColumn('mulai_cuti', function ($item) {
                    $mulai_cuti = Carbon::parse($item->cuti[0]->mulai_cuti)->format('d-M-Y');
                    return $mulai_cuti;
                })
                ->addColumn('selesai_cuti', function ($item) {
                    $selesai_cuti = Carbon::parse($item->cuti[0]->selesai_cuti)->format('d-M-Y');
                    return $selesai_cuti;
                })
                ->addColumn('aksi', 'pages.cuti.histori-cuti.part.aksi')
                ->rawColumns(['nama_lengkap', 'jenis_cuti', 'alasan_cuti', 'jumlah_hari', 'mulai_cuti', 'selesai_cuti', 'aksi'])
                ->toJson();
        }
        return view('pages.cuti.histori-cuti.index', [
            // 'historiCuti' => $histori
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
                    return '<button class="badge p-2 text-white bg-' . ($item->status == 'aktif' ? 'success' : 'secondary') . ' border-0">' . $item->status . '</button>';
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
}
