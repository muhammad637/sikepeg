<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SIP;
use App\Models\STR;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\PangkatGolongan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    // Function untuk login
    public function loginHandler(Request $request)
    {
        $request->validate([
            'nip_nippk' => 'required|exists:pegawais,nip_nippk',
            'password' => 'required',
        ]);

        $credentials = $request->only('nip_nippk', 'password');

        if (Auth::guard('pegawai')->attempt($credentials)) {
            $pegawai = Pegawai::where('nip_pppk', $request->nip_pppk)->first();
            return redirect()->route('pegawai.dashboard')->with('success', 'Login berhasil');
            return response()->json([
                'message' => 'Login berhasil', 
                'data' => $pegawai,
                'token' => 'token'
            ], 200);
        } else {
            return back()->withErrors(['message' => 'Login gagal, data yang anda masukkan salah']);
            return response()->json(['message' => 'Login gagal, data yang anda masukkan salah'], 401);
        }
    }

    // Function untuk logout
    public function logoutHandler()
    {
        Auth::guard('pegawai')->logout();
        return redirect()->route('auth.pegawai.login')->with('success', 'Logout berhasil');
        return response()->json(['message' => 'Logout berhasil'], 200);
    }

    // Menampilkan daftar Pegawai
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pegawai = Pegawai::query();

            if ($request->has('ruangan')) {
                $pegawai->where('ruangan_id', $request->ruangan);
            }

            if ($request->has('jenis_tenaga')) {
                $pegawai->where('jenis_tenaga', $request->jenis_tenaga);
            }

            if ($request->has('status_tipe')) {
                $pegawai->where('status_tipe', $request->status_tipe);
            }

            $pegawai->orderByDesc('created_at');

            return DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('jenis_kelamin', function ($item) {
                    return in_array(strtolower($item->jenis_kelamin), ['laki-laki', 'perempuan']) ? $item->jenis_kelamin : 'tidak diketahui';
                })
                ->addColumn('aksi', 'pages.pegawai.part.aksi')
                ->addColumn('ruangan', function ($item) {
                    return $item->ruangan ? "<span class='text-uppercase'>" . $item->ruangan->nama_ruangan . "</span>" : '-';
                })
                ->addColumn('status_pegawai', function ($item) {
                    $statusClass = $item->status_pegawai == 'aktif' ? 'success' : 'secondary';
                    return "<button class='btn btn-$statusClass border-0'>$item->status_pegawai</button>";
                })
                ->filterColumn('ruangan', function ($query, $keyword) {
                    $query->whereHas('ruangan', function ($query) use ($keyword) {
                        $query->where('nama_ruangan', 'like', '%' . $keyword . '%');
                    });
                })
                ->filterColumn('status_pegawai', function ($query, $keyword) {
                    $query->where('status_pegawai', 'like', '%' . $keyword . '%');
                })
                ->rawColumns(['aksi', 'ruangan', 'status_pegawai', 'jenis_kelamin'])
                ->toJson();
        }

        $pegawais = Pegawai::all();
        $ruangans = Ruangan::all();
        return view('pages.pegawai.index', compact('pegawais', 'ruangans'));
        return response()->json($pegawais);
    }

    public function create()
    {
        return view('pages.pegawai.create');
    }

    // Menyimpan data Pegawai
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:pegawais,nik',
            'nip_nippk' => 'required|unique:pegawais,nip_nippk',
            'gelar_depan' => 'nullable|string|max:10',
            'gelar_belakang' => 'nullable|string|max:10',
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'agama' => 'required|string',
            'no_wa' => 'required|string',
            'status_pegawai' => 'required|string',
            'tahun_pensiun' => 'required|numeric',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_lulus' => 'required|date',
            'status_tenaga' => 'required|string',
            'no_ijazah' => 'required|string',
            'jabatan' => 'required|string|max:50',
        ]);

        $usia = Carbon::parse($request->tanggal_lahir)->age;
        $password = Hash::make(Carbon::parse($request->tanggal_lahir)->format('dmY'));
        $nama_lengkap = trim($request->gelar_depan . ' ' . $request->nama_depan . ' ' . $request->nama_belakang . ' ' . $request->gelar_belakang);
        $ruangan_id = $request->ruangan_id;

        if ($request->ruangan_id == 'ruangan_lainnya') {
            $request->validate([
                'nama_ruangan' => 'required|unique:ruangans,nama_ruangan',
            ]);
            $ruangan = Ruangan::create(['nama_ruangan' => strtolower($request->nama_ruangan)]);
            $ruangan_id = $ruangan->id;
        }

        $data = $request->all();
        $data['nama_lengkap'] = $nama_lengkap;
        $data['ruangan_id'] = $ruangan_id;
        $data['password'] = $password;
        $data['usia'] = $usia;

        $pegawai = Pegawai::create($data);

        if ($request->status_tenaga == 'non asn') {
            // Process for non-ASN
            // Handle specific validations and additional data storage
        } elseif ($request->status_tipe == 'pns') {
            // Process for ASN
            // Handle specific validations and additional data storage
        }

        return response()->json(['message' => 'Data pegawai berhasil ditambahkan', 'data' => $pegawai], 201);
    }

    // Menampilkan detail Pegawai
    public function show($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan'], 404);
        }

        return response()->json($pegawai);
    }

    // Mengupdate data Pegawai
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan'], 404);
        }

        $request->validate([
            'nik' => ['required', Rule::unique('pegawais')->ignore($pegawai->id)],
            'nip_nippk' => ['required', Rule::unique('pegawais')->ignore($pegawai->id)],
            'gelar_depan' => 'nullable|string|max:10',
            'gelar_belakang' => 'nullable|string|max:10',
            'nama_depan' => 'required|string|max:50',
            'nama_belakang' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'agama' => 'required|string',
            'no_wa' => 'required|string',
            'status_pegawai' => 'required|string',
            'tahun_pensiun' => 'required|numeric',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_lulus' => 'required|date',
            'status_tenaga' => 'required|string',
            'no_ijazah' => 'required|string',
            'jabatan' => 'required|string|max:50',
        ]);

        $data = $request->all();
        $nama_lengkap = trim($request->gelar_depan . ' ' . $request->nama_depan . ' ' . $request->nama_belakang . ' ' . $request->gelar_belakang);
        $ruangan_id = $request->ruangan_id;

        if ($request->ruangan_id == 'ruangan_lainnya') {
            $request->validate([
                'nama_ruangan' => 'required|unique:ruangans,nama_ruangan',
            ]);
            $ruangan = Ruangan::create(['nama_ruangan' => strtolower($request->nama_ruangan)]);
            $ruangan_id = $ruangan->id;
        }

        $data['nama_lengkap'] = $nama_lengkap;
        $data['ruangan_id'] = $ruangan_id;

        $pegawai->update($data);

        return response()->json(['message' => 'Data pegawai berhasil diperbarui', 'data' => $pegawai], 200);
    }

    // Menghapus data Pegawai
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Data pegawai tidak ditemukan'], 404);
        }

        $pegawai->delete();

        return response()->json(['message' => 'Data pegawai berhasil dihapus'], 200);
    }
}

