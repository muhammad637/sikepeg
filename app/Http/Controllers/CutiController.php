<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $cuti = Cuti::where('status', 'aktif')->orWhere('status', 'pending')->get();
        return view('pages.cuti.index', [
            'cuti' => $cuti,
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
        return view('pages.cuti.create', [
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
        //
        $validatedData = $request->validate([
            'jenis_cuti' => 'required',
            'alasan_cuti' => 'required',
            'mulai_cuti' => 'required',
            'selesai_cuti' => 'required',
            'jumlah_hari' => 'required',
            'link_cuti' => 'required',
        ]);
        $cuti = Cuti::where('pegawai_id', $request->pegawai_id)->orderBy('selesai_cuti', 'desc')->first();
        $pegawai = Pegawai::find($request->pegawai_id);
        if ($cuti) {
            if (  Carbon::parse($cuti->mulai_cuti) >= Carbon::parse($request->mulai_cuti) && Carbon::parse($cuti->selesai_cuti) >= Carbon::parse($request->selesai_cuti)) {
                Alert::alert('gagal create cuti', 'periode cuti masih berlaku', 'error');
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
                return redirect()->back()->with('error', 'cuti tahunan pegawai' . $pegawai->nama_lengkap ?? $pegawai->nama_depan . 'telah habis pada tahun ini')->withInput();
            }
        }
        if ($request->jenis_cuti == 'cuti besar') {
            if ($pegawai->sisa_cuti_tahunan  == 0) {
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
        if(!$pegawaiUpdate){
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
                Alert::alert('Data Cuti Gagal diupdate', 'data cuti masih ada, mohon periksa kembali data pegawai','error');
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
            return redirect()->route('admin.cuti.data-cuti-aktif.index')->with('success', 'data cuti berhasil ditambahkan');
        }
        $cuti->pegawai->update([
            'sisa_cuti_tahunan' => $cuti->pegawai->sisa_cuti_tahunan + $cuti->jumlah_hari,
            'status_pegawai' => 'aktif'
        ]);
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
        if (Carbon::parse($request->mulai_cuti) <= Carbon::parse(now())) {
            $cuti->update(['status' => 'aktif']);
        } else {
            $cuti->update(['status' => 'pending']);
        }

        // Mengarahkan kembali ke halaman indeks data cuti aktif
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
    public function historiCuti()
    {
        $histori = Cuti::where('status', 'nonaktif')->get();
        return view('pages.cuti.histori-cuti.index', [
            'historiCuti' => $histori
        ]);
    }
}
