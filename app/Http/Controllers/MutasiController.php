<?php

namespace App\Http\Controllers;

use App\Models\mutasi;
use Carbon\Carbon;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MutasiController extends Controller
{
    //
    public function index()
    {
        $mutasi = Mutasi::orderBy('tanggal_sk', 'desc')->with('pegawai')->get();
        $pegawai =  Pegawai::with(['mutasi' => function ($q) {
            $q->orderBy('tanggal_sk', 'desc');
        }])->whereHas('mutasi')->get();
        return view(
            'pages.mutasi.index',
            [
                'pegawai' => $pegawai,
                'i' => 0,
            ]
        );
    }
    public function create()
    {

        $pegawai = Pegawai::all();
        return view('pages.mutasi.create', ['pegawai' => $pegawai]);
    }

    public function store(Request $request)
    {
        try {
            $pegawai = Pegawai::find($request->pegawai_id);

            $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->first();
            $validatedData = '';
            if ($request->jenis_mutasi == 'internal') {
                if ($mutasi) {
                    Carbon::parse($mutasi->tanggal_sk) < Carbon::parse($request->tanggal_sk) ? $pegawai->update(['ruangan' => $request->ruangan_tujuan]) : null;
                } else {
                    $pegawai->update(['ruangan' => $request->ruangan_tujuan]);
                }
                $validatedData =   $request->validate(
                    [
                        'pegawai_id' => '',
                        'tanggal_berlaku' => 'required|date',
                        'no_sk' => 'required',
                        'tanggal_sk' => 'required|date',
                        'link_sk' => 'required',
                        'ruangan_awal' => 'required',
                        'ruangan_tujuan' => 'required',
                    ]
                );
            } else {
                $pegawai->update(['status_pegawai' => 'nonaktif']);
                $validatedData =   $request->validate(
                    [
                        'pegawai_id' => '',
                        'tanggal_berlaku' => 'required|date',
                        'no_sk' => 'required',
                        'tanggal_sk' => 'required|date',
                        'link_sk' => 'required',
                        'instansi_awal' => 'required',
                        'instansi_tujuan' => 'required'
                    ]
                );
            }
            $mutasi = Mutasi::create(request()->all());
            return redirect(route('mutasi.index'))->with('success', 'data mutasi pegawai berhasil ditambahkan');

            //code...
        } catch (\Throwable $th) {
            return $th->getMessage();            //throw $th;
        }
    }



    public function edit(Mutasi $mutasi)
    {
        return view('pages.mutasi.edit', [
            'mutasi' => $mutasi
        ]);
    }

    public function show(Mutasi $mutasi)
    {
        return view('pages.mutasi.show', [
            'mutasi' => $mutasi
        ]);
    }


    public function history(Pegawai $pegawai)
    {
        $mutasi = Mutasi::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sk', 'desc')->get();
        return view('pages.mutasi.history', [
            'pegawai' => $pegawai,
            'mutasi' => $mutasi
        ]);
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        //   return request()->all();
        try {
            $pegawai = Pegawai::find($mutasi->pegawai_id);
            $validatedData = '';
            if ($request->jenis_mutasi == 'internal') {
                $pegawai->update(['ruangan' => $request->ruangan_tujuan]);
                $validatedData =   $request->validate(
                    [
                        'tanggal_berlaku' => 'required|date',
                        'no_sk' => 'required',
                        'tanggal_sk' => 'required|date',
                        'link_sk' => 'required',
                        'ruangan_awal' => 'required',
                        'ruangan_tujuan' => 'required',
                    ]
                );
                $mutasi->update([

                    'tanggal_berlaku' => $request->tanggal_berlaku,
                    'no_sk' => $request->no_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'link_sk' => $request->link_sk,
                    'ruangan_awal' => $request->ruangan_awal,
                    'ruangan_tujuan' => $request->ruangan_tujuan,
                    'instansi_awal' => null,
                    'intansi_tujuan' => null
                ]);
            } else {
                $pegawai->update(['status_pegawai' => 'nonaktif']);
                $validatedData =   $request->validate(
                    [
                        'pegawai_id' => '',
                        'tanggal_berlaku' => 'required|date',
                        'no_sk' => 'required',
                        'tanggal_sk' => 'required|date',
                        'link_sk' => 'required',
                        'instansi_awal' => 'required',
                        'instansi_tujuan' => 'required'
                    ]
                );
                $mutasi->update([

                    'tanggal_berlaku' => $request->tanggal_berlaku,
                    'no_sk' => $request->no_sk,
                    'tanggal_sk' => $request->tanggal_sk,
                    'link_sk' => $request->link_sk,
                    'ruangan_awal' => null,
                    'ruangan_tujuan' => null,
                    'instansi_awal' => $request->instansi_awal,
                    'instansi_tujuan' => $request->instansi_tujuan
                ]);
            }


            return redirect('mutasi.index')->with('success', 'data mutasi pegawai berhasil diupdate');

            //code...
        } catch (\Throwable $th) {
            return $th->getMessage();            //throw $th;
        }
    }
}
