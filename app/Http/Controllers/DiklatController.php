<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\STR;
use App\Models\Admin;
use App\Models\Diklat;
use App\Exports\Export;
use App\Models\Pegawai;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Maatwebsite\Excel\Facades\Excel;

class DiklatController extends Controller
{
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

        $dataPegawaiDiklat = $diklat->with('pegawai', 'ruangan')->get();

        return response()->json($dataPegawaiDiklat, 200);
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
            'ruangan_id' => 'required'
        ]);

        $diklat = Diklat::create($validatedData);

        $notif = Notifikasi::notif('diklat', 'Data diklat pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
        $createNotif = Notifikasi::create($notif);

        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($diklat->pegawai->id);

        return response()->json(['message' => 'Diklat berhasil ditambahkan', 'diklat' => $diklat], 201);
    }

    public function show(Diklat $diklat)
    {
        return response()->json($diklat, 200);
    }

    public function update(Request $request, Diklat $diklat)
    {
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

        $diklat->update($validatedData);

        $notif = Notifikasi::notif('diklat', 'data diklat  pegawai ' . $diklat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-chalkboard-teacher');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($diklat->pegawai->id);

        return response()->json(['message' => 'Diklat berhasil diperbarui', 'diklat' => $diklat], 200);
    }

    public function destroy(Diklat $diklat)
    {
        $diklat->delete();
        return response()->json(['message' => 'Diklat berhasil dihapus'], 200);
    }

    public function riwayat(Pegawai $pegawai, Request $request)
    {
        $diklat = Diklat::where('pegawai_id', $pegawai->id)->orderBy('tanggal_sertifikat', 'desc')->get();
        return response()->json($diklat, 200);
    }

    public function showRiwayat(Diklat $diklat)
    {
        return response()->json($diklat, 200);
    }

    public function editRiwayat(Diklat $diklat)
    {
        return response()->json($diklat, 200);
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

    public function exportAll(Request $request)
    {
        $diklats = Diklat::query()->orderBy('created_at', 'desc');
        if ($request->diklat != null) {
            $diklats->where('nama_diklat', $request->diklat);
        }

        if ($request->ruangan != null) {
            $diklats->where('ruangan_id', $request->ruangan);
        }

        return $this->dataLaporan($diklats->with('pegawai')->get(), $request);
    }

    public function exportYear(Request $request)
    {
        $diklats = Diklat::query()->orderBy('created_at', 'desc');

        if ($request->diklat != null) {
            $diklats->where('nama_diklat', $request->diklat);
        }

        if ($request->ruangan != null) {
            $diklats->where('ruangan_id', $request->ruangan);
        }

        if ($request->tahun != null) {
            $diklats->whereYear('tanggal_selesai', $request->tahun);
        }

        return $this->dataLaporan($diklats->with('pegawai')->get(), $request);
    }

    public function exportYearRange(Request $request)
    {
        $diklats = Diklat::query()->orderBy('created_at', 'desc');

        if ($request->diklat != null) {
            $diklats->where('nama_diklat', $request->diklat);
        }

        if ($request->ruangan != null) {
            $diklats->where('ruangan_id', $request->ruangan);
        }

        if ($request->tahun_mulai != null && $request->tahun_selesai != null) {
            $diklats->whereBetween('tanggal_selesai', [$request->tahun_mulai, $request->tahun_selesai]);
        }

        return $this->dataLaporan($diklats->with('pegawai')->get(), $request);
    }
}
