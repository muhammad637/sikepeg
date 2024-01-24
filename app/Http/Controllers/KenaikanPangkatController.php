<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Exports\Export;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Golongan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\KenaikanPangkat;
use App\Models\PangkatGolongan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class KenaikanPangkatController extends Controller
{
    public function index(Request $request)
    {
        // return KenaikanPangkat::all();
        $data = KenaikanPangkat::orderBy('tanggal_sk', 'desc')->first();
        // return [$data,$data->pegawai];
        $tahun = $data ? Carbon::parse($data->tanggal_sk)->format('Y') : date('Y');
        if ($request->ajax()) {
            $kenaikanPangkat = KenaikanPangkat::query()
            ->orderBy('tmt_pangkat_dari', 'desc')
            ->orderBy('pegawai_id', 'desc')
            ->orderBy('id', 'desc');
            if ($request->input('status_tipe') != null) {
                $kenaikanPangkat->where('status_tipe', $request->status_tipe);
            }
            if ($request->input('tahun') != null) {
                $kenaikanPangkat->where('tanggal_sk', 'like', '%' . $request->tahun . '%');
            }
            if ($request->input('ruangan') != null) {
                $kenaikanPangkat->where('ruangan_id', $request->ruangan);
            }
            $dataKenaikanPangkat = DataTables::of($kenaikanPangkat)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($item) {
                    return $item->pegawai ? $item->pegawai->nama_lengkap : '-';
                })
                ->addColumn('ruangan', function ($item) {
                    return $item->ruangan->nama_ruangan;
                })
                ->addColumn('pangkat_golongan_sebelumnya', function ($item) {
                    return $item->pangkatGolonganSebelumnya->nama ;
                })
                ->addColumn('pangkat_golongan', function ($item) {
                    return $item->pangkatGolongan->nama;
                })
                ->addColumn('no_sk', function ($item) {
                    return $item->no_sk;
                })
                ->addColumn('status', function ($item) {
                    $tanggal_mulai = Carbon::parse($item->tmt_pangkat_dari)->format('Ymd');
                    $tanggal_selesai = Carbon::parse($item->tmt_pangkat_sampai)->format('Ymd');
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
                    return '<button class="btn  text-white btn-' . ($status == 'aktif' ? 'success' : ($status == 'pending' ? 'secondary'  : 'secondary')) . ' border-0">' . $status . '</button>';
                })
                ->filterColumn('nama_lengkap', function ($query, $keyword) {
                    $query->wherHas('pegawai', function ($item) use ($keyword) {
                        $item->where('nama_lengkap', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('penerbit_sk', function ($item) {
                    return $item->penerbit_sk;
                })
                ->addColumn('tmt_terbit', function ($item) {
                    return Carbon::parse($item->tmt_pangkat_dari)->format('d-m-Y');
                })
                ->addColumn('tmt_sampai', function ($item) {
                    return Carbon::parse($item->tmt_pangkat_sampai)->format('d-m-Y');
                })
                ->addColumn('sk', 'pages.surat.kenaikanpangkat')
                ->addColumn('aksi', 'pages.kenaikan_pangkat.part.aksi-index')
                ->rawColumns(['status', 'nama_lengkap', 'ruangan', 'no_sk', 'tmt_terbit', 'tmt_sampai', 'penerbit_sk', 'sk', 'aksi', 'pangkat_golongan_sebelumnya', 'pangkat_golongan'])
                ->toJson();
            return $dataKenaikanPangkat;
        }
        return view(
            'pages.kenaikan_pangkat.index',
            [
                // 'KenaikanPangkat' => $kenaikanpangkat,
                'i' => 0,
                'data' => $tahun,
                'ruangans' => Ruangan::orderBy('nama_ruangan', 'desc')->get(),
            ]
        );
    }


    public function create()
    {
        $pegawai = Pegawai::where('status_tenaga', 'asn')->get();
        return view('pages.kenaikan_pangkat.create', ['pegawai' => $pegawai,]);
    }

    public function createriwayat(Pegawai $pegawai)
    {
        if ($pegawai->status_tenaga == 'non asn') {
            alert()->error('pegawai bukan merupakan PNS ataupun PPPK');
            return redirect()->route('admin.dashboard.index');
        }
        $status_tipe = $pegawai->status_tipe;
        $pegawai_select = Pegawai::where('status_tenaga', 'asn')->get();
       
        // return $pegawai;
        return view('pages.kenaikan_pangkat.riwayat.create', [
            'pegawai' => $pegawai,
            'pegawai_select' => $pegawai_select,
           
            'status' => $status_tipe,
        ]);
    }


    public function store(Request $request)
    {
        try {
            // Cari pegawai berdasarkan pegawai_id yang diberikan
            $pegawai = Pegawai::find($request->pegawai_id);

            // Jika pegawai tidak ditemukan, kembalikan pesan error
            if (!$pegawai) {
                return 'Pegawai tidak ditemukan';
            }

            // Inisialisasi variabel pangkat_golongan_id dari request
            $pangkat_golongan_id = $request->pangkat_golongan_id;

            // Jika pangkat_golongan_id memiliki nilai 'lainnya'
            if ($pangkat_golongan_id == 'lainnya') {
                // Validasi input nama untuk pangkat golongan baru
                $request->validate([
                    'nama' => 'required|unique:pangkat_golongans,nama'
                ], [
                    'nama.unique' => 'Nama pangkat golongan sudah ada.'
                ]);

                // Buat objek PangkatGolongan baru
                $pangkat_golongan = PangkatGolongan::create([
                    'nama' => $request->nama,
                    'nama_kecil' => strtolower($request->nama),
                    'jenis' => $request->status_tipe
                ]);

                // Dapatkan id pangkat_golongan yang baru dibuat
                $pangkat_golongan_id = $pangkat_golongan->id;
            }

            // Validasi data input untuk kenaikan pangkat
            $validatedData = $request->validate([
                'pegawai_id' => '',
                'tmt_pangkat_dari' => 'required|date',
                'tmt_pangkat_sampai' => 'required|date',
                'no_sk' => 'required',
                'tanggal_sk' => 'required',
                'penerbit_sk' => 'required'
            ]);

            // Buat objek KenaikanPangkat
            $kenaikanpangkat = KenaikanPangkat::create([
                'pegawai_id' => $request->pegawai_id,
                'ruangan_id' => $request->ruangan_id,
                'status_tipe' => $request->status_tipe,
                'pangkat_golongan_id' => $pangkat_golongan_id,
                'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
                'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'penerbit_sk' => $request->penerbit_sk,
                'link_sk' => $request->link_sk,
                'pangkat_golongan_sebelumnya_id' => $request->pangkat_golongan_sebelumnya_id,
                'tmt_sebelumnya' => $pegawai->tmt_pangkat_terakhir,
            ]);

            // Hitung status TMT pangkat untuk menentukan apakah aktif atau tidak
            $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('Ymd') <= date('Ymd') && Carbon::parse($request->tmt_pangkat_sampai)->format('Ymd') >= date('Ymd') ? 'aktif' : '-';

            // Jika status TMT pangkat aktif, update data pegawai
            if ($tmt_pangkat == 'aktif') {
                $pegawai->update([
                    'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                    'pangkat_golongan_id' => $pangkat_golongan_id,
                ]);
            }

            // Buat notifikasi untuk kenaikan pangkat
            $notif = Notifikasi::notif('kenaikan pangkat', 'Data kenaikan pangkat pegawai ' . $pegawai->nama_lengkap . ' berhasil dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-day');
            $createNotif = Notifikasi::create($notif);

            // Asosiasikan notifikasi dengan admin dan pegawai terkait
            $createNotif->admin()->sync(Admin::adminId());
            $createNotif->pegawai()->attach($pegawai->id);

            // Tampilkan pesan sukses dan arahkan ke halaman indeks kenaikan pangkat
            alert()->success('Berhasil', 'Data kenaikan pangkat pegawai berhasil dibuat oleh ' . auth()->user()->name);

            // Jika terdapat riwayat kenaikan pangkat, arahkan ke halaman riwayat
            if ($request->has('riwayat')) {
                return redirect()->route('admin.kenaikan-pangkat.riwayat', ['pegawai' => $request->pegawai_id]);
            }

            // Kembali ke halaman indeks kenaikan pangkat
            return redirect()->route('admin.kenaikan-pangkat.index');
        } catch (\Throwable $th) {
            // Tangani kesalahan dan kembalikan ke halaman sebelumnya dengan input
            alert()->error($th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.edit', [
            'kenaikan_pangkat' => $kenaikan_pangkat,
            'pegawai' => Pegawai::all(),
        ]);
    }

    public function show(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.show', [
            'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }
    public function update(Request $request, KenaikanPangkat $kenaikan_pangkat)
    {
        // return $request->all();

        $pegawaiUpdate = Pegawai::find($kenaikan_pangkat->pegawai->id);

        $validatedData = $request->validate([
            'pegawai_id' => '',
            'tmt_pangkat_dari' => 'required',
            'tmt_pangkat_sampai' => 'required',
            'no_sk' => 'required',
            'tanggal_sk' => 'required',
            'penerbit_sk' => 'required',
            'link_sk' => 'required'
        ]);
        $request->validate([
            'pangkat_golongan_id' => 'required',
        ], [
            'pangkat_golongan_id.required' => 'pangkat golongan id masih kosong',
        ]);

        $pangkat_golongan_id = $request->pangkat_golongan_id;
        //    return  $request->pangkat_golongan_id == 'lainnya' ? $request->nama_pangkat_golongan : 'hmm';
        if ($request->pangkat_golongan_id == 'lainnya') {
            // return $pangkat_golongan_id;
            $request->validate([
                'nama' => 'required|unique:pangkat_golongans'
            ], [
                'nama.required' => 'nama_pangkat_gologan pangkat golongan masih kosong',
                'nama.unique' => 'nama_pangkat pangkat golongan sudah ada'
            ]);
            $pangkat_golongan = PangkatGolongan::create([
                'nama' => $request->nama,
                'jenis' => $request->status_tipe,
                'nama_kecil' => strtolower($request->nama),
            ]);
            $pangkat_golongan_id = $pangkat_golongan->id;
        }
        $tmt_pangkat =  Carbon::parse($request->tmt_pangkat_dari)->format('Ymd') <= date('Ymd') && Carbon::parse($request->tmt_pangkat_sampai)->format('Ymd') >= date('Ymd') ? 'aktif' : '-';
        if ($tmt_pangkat == 'aktif') {
            $pegawaiUpdate->update([
                'tmt_pangkat_terakhir' => $request->tmt_pangkat_dari,
                'pangkat_golongan_id' => $pangkat_golongan_id,
            ]);
        }
        $kenaikan_pangkat->update([
            'pegawai_id' => $request->pegawai_id,
            'pangkat_golongan_id' => $pangkat_golongan_id,
            'status_tipe' => $request->status_tipe,
            'tmt_pangkat_dari' => $request->tmt_pangkat_dari,
            'tmt_pangkat_sampai' => $request->tmt_pangkat_sampai,
            'no_sk' => $request->no_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'penerbit_sk' => $request->penerbit_sk,
            'link_sk' => $request->link_sk,
        ]);
        $notif = Notifikasi::notif('kenaikan pangkat', 'data kenaikan pangkat  pegawai ' . $kenaikan_pangkat->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-calendar-day');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($kenaikan_pangkat->pegawai->id);
        alert()->success('berhasil', 'data kenaikan pangkat berhasi dupdate oleh ' . auth()->user()->name);
        if ($request->riwayat) {
            return redirect()->route('admin.kenaikan-pangkat.riwayat', ['pegawai' => $request->pegawai_id])->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
        }
        return redirect()->route('admin.kenaikan-pangkat.index')->with('success', 'kenaikan pangkat pegawai berhasil diupdate');
    }


    public function riwayat(Pegawai $pegawai, KenaikanPangkat $kenaikan_pangkat, Request $request)
    {
        $kenaikan_pangkat = KenaikanPangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_sampai', 'desc')->get();
        if ($request->ajax()) {
            $kp = KenaikanPangkat::query()->where('pegawai_id', $pegawai->id)->orderBy('tmt_pangkat_sampai', 'desc');
            $dataKp = DataTables::of($kp)
                ->addIndexColumn()
                ->addColumn('pangkat_golongan', function ($item) {
                    // return 'tes';
                    return $item->pangkatGolonganSebelumnya->nama . " --> " . $item->pangkatGolongan->nama;
                })
                ->addColumn('aksi', 'pages.kenaikan_pangkat.part.aksi-riwayat')
                ->rawColumns(['pangkat_golongan', 'aksi'])
                ->toJson();
            return $dataKp;
        }
        return view('pages.kenaikan_pangkat.riwayat.index', [
            'pegawai' => $pegawai,
            // 'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }
    public function editRiwayat(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.riwayat.edit', [
            'kenaikan_pangkat' => $kenaikan_pangkat,
            'pegawai' => Pegawai::all(),
        ]);
    }

    public function lihatRiwayat(KenaikanPangkat $kenaikan_pangkat)
    {
        return view('pages.kenaikan_pangkat.riwayat.show', [
            'kenaikan_pangkat' => $kenaikan_pangkat
        ]);
    }

    public function destroy(KenaikanPangkat $kenaikan_pangkat)
    {

        $tanggal_mulai = Carbon::parse($kenaikan_pangkat->tmt_pangkat_dari)->format('Ymd');
        $tanggal_selesai = Carbon::parse($kenaikan_pangkat->tmt_pangkat_sampai)->format('Ymd');
        $tanggal_saat_ini = now()->format('Ymd');
        $status = null;
        if ($tanggal_mulai <= $tanggal_saat_ini && $tanggal_selesai >= $tanggal_saat_ini) {
            $status = 'aktif';
        } elseif ($tanggal_mulai >= $tanggal_saat_ini) {
            $status = 'pending';
        } else {
            $status = 'nonaktif';
        }
        if ($status == 'aktif') {
            $kenaikan_pangkat->pegawai->update([
                'tmt_pangkat_terakhir' => $kenaikan_pangkat->tmt_sebelumnya,
                'pangkat_id' => $kenaikan_pangkat->pangkat_id_sebelumnya,
                'golongan_id' => $kenaikan_pangkat->golongan_id_sebelumnya,
            ]);
        }
        $kenaikan_pangkat->delete();
        alert()->success('data berhasil dihapus');
        return redirect()->back();
    }
    //

    private function dataLaporan(
        $kenaikan_pangkat
    ) {
        $dataLaporan = [];
        foreach ($kenaikan_pangkat as $item) {
            array_push($dataLaporan, [
                'Nama Pegawai' => $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan,
                'Status Tipe' => $item->status_tipe,
                'Ruangan' => $item->ruangan->nama_ruangan ?? '-',
                'Pangkat_golongan' => $item->pangkatGolongan->nama ,
                'No SK' => $item->no_sk,
                'Tanggal Mulai Terhitung' => Carbon::parse($item->tmt_pangkat_dari)->format('d/m/Y') . ' - ' . Carbon::parse($item->tmt_pangkat_dari)->format('d/m/Y'),
                'Penerbit SK' => $item->penerbit_sk,
            ]);
        }
        // return $dataLaporan;
        $laporan = new Export([
            ['Nama Pegawai', 'Status Tipe', 'Ruangan', 'Pangkat', 'Golongan', 'No SK', 'Tanggal Mulai Terhitung', 'Penerbit SK'],
            [...$dataLaporan]
        ]);
        // return $dataLaporan;
        return Excel::download($laporan, 'kenaikan-pangkat.xlsx');
    }

    public function export_excel(Request $request)
    {
        // return 'testing';
        $kenaikan_pangkat = KenaikanPangkat::orderBy('tmt_pangkat_dari', 'desc')->orderBy('pegawai_id', 'asc');
        if ($request->input('status_tipe') != null) {
            $kenaikan_pangkat->where('status_tipe', $request->status_tipe);
        }
        if ($request->input('ruangan') != null) {
            $kenaikan_pangkat->where('ruangan_id', $request->ruangan);
        }
        if ($request->input('tahun') != null) {
            $kenaikan_pangkat->where('tmt_pangkat_dari', 'like', '%' . $request->tahun . '%');
        }
        // return $mutasi->get();
        return $this->dataLaporan($kenaikan_pangkat->get());
    }
}
