<?php

namespace App\Http\Controllers;



use Carbon\Carbon;
use App\Models\Asn;
use App\Models\STR;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Exports\STRExport;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Dotenv\Util\Str as UtilStr;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;

class   STRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('str', function ($query) {
            $query->orderBy('created_at', 'desc');
        })->whereHas('str', function($q){
            $q->orderBy('created_at', 'desc');
        })->get();
        // return $pegawai;
        if($request->ajax()){
            $pegawai = Pegawai::query()
            ->where('jenis_tenaga', 'nakes')->with('str', function ($query) {
                $query->orderBy('created_at', 'desc');
            })->whereHas('str', function ($q) {
                $q->orderBy('created_at', 'desc');
            });
            return DataTables::of($pegawai)
            ->addIndexColumn()
            ->addColumn('tanggal-berakhir-str', function($item){
                return ($item->str[0]->masa_berakhir_str);
            })
            ->addColumn('status', function($item){
                $data =($item->str[0]->masa_berakhir_str);
                // dd($data);
                $status = $data ? 'aktif' : 'nonaktif';
                $warna = $data == true ? 'btn-success' : 'btn-secondary';
                return "<button class='btn ".$warna."'>$status</button>";
            })
            ->addColumn('nama-ruangan',function($item){
                return $item->ruangan->nama_ruangan;
            })
            ->addColumn('aksi', 'pages.str.part.aksi-index')
            ->addColumn('surat', 'pages.surat.str-index')
            ->rawColumns(['surat','tanggal-berakhir-str','status','aksi','nama-ruangan'])
            ->toJson();
        }
        return view('pages.str.index', [
            // 'pegawai' => $pegawai,
            // 'i' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = Pegawai::where('status_tenaga', 'asn')->where('jenis_tenaga', 'nakes')->doesntHave('str')->get();
        // return auth()->user();
        return view('pages.str.create', [
            'results' => $results
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
        // return $request->all();
        $validatedData = $request->validate([
            'no_str' => 'required',
            'penerbit_str' => 'required',
            'tanggal_terbit_str' => 'required',
            'no_sertikom' => 'required',
            'kompetensi' => 'required',
            'masa_berakhir_str' => 'required',
            'link_str' => 'required',
        ]);

        $str = STR::create([
            'pegawai_id' => $request->pegawai_id,
            'no_str' => $request->no_str,
            'no_sip' => $request->no_sip,
            'no_sertikom' => $request->no_sertikom,
            'kompetensi' => $request->kompetensi,
            'penerbit_str' => $request->penerbit_str,
            'tanggal_terbit_str' => $request->tanggal_terbit_str,
            'masa_berakhir_str' => $request->masa_berakhir_str,
            'link_str' => $request->link_str
        ]);
        // return $str; 
        $notif = Notifikasi::notif('str', 'data STR pegawai ' . $str->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($str->pegawai->id);
        alert()->success('berhasil', 'data STR pegawai ' . $str->pegawai->nama_lengkap . ' berhasil  dibuat oleh ' . auth()->user()->name);
        return redirect(route('admin.str.index'))->with('success', 'str berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function show(STR $str)
    {

        // return $str;
        // return $results;
        return view('pages.str.show', [
            'str' => $str,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function edit(STR $str)
    {
        $results = Pegawai::where('status_tenaga', 'asn')->where('jenis_tenaga', 'nakes')->get();

        return view('pages.str.edit', [
            'str' => $str,
            'results' => $results

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, STR $str)
    {
        // return $request->all();
        //
        // try {
            //code...
            $validatedData = $request->validate([
                'no_str' => 'required',
                'penerbit_str' => 'required',
                'kompetensi' => 'required',
                'no_sertikom' => 'required',
                'tanggal_terbit_str' => 'required',
                'masa_berakhir_str' => 'required',
                'link_str' => 'required',
            ]);
            $strUpdate = $str->update([
                'pegawai_id' => $request->pegawai_id,
                'no_str' => $request->no_str,
                'no_sip' => $request->no_sip,
                'kompetensi' => $request->kompetensi,
                'no_sertikom' => $request->no_sertikom,
                'penerbit_str' => $request->penerbit_str,
                'tanggal_terbit_str' => $request->tanggal_terbit_str,
                'masa_berakhir_str' => $request->masa_berakhir_str,
                'link_str' => $request->link_str
            ]);
        // return $str;
        $notif = Notifikasi::notif('str', 'data STR pegawai ' . $str->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name, 'bg-success', 'fas fa-folder-plus');
        $createNotif = Notifikasi::create($notif);
        $createNotif->admin()->sync(Admin::adminId());
        $createNotif->pegawai()->attach($str->pegawai->id);
        alert()->success('berhasil', 'data STR pegawai ' . $str->pegawai->nama_lengkap . ' berhasil  diupdate oleh ' . auth()->user()->name);
        if($request->riwayat){
            return redirect(route('admin.str.riwayat',['pegawai'=> $str->pegawai_id]))->with('success', 'str berhasil ditambahkan');
        }
            return redirect(route('admin.str.index'))->with('success', 'str berhasil ditambahkan');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return $th->getMessage();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function destroy(STR $str)
    {
        //
        alert()->success('data str pegawai '.$str->pegawai->nama_lengkap.' berhasil di hapus');
        $str->delete();
        return redirect()->back();
    }

    // history
    public function riwayat(Pegawai $pegawai, Request $request)
    {
        $dataSTR = STR::query()->where('pegawai_id' , $pegawai->id)
        ->orderBy('masa_berakhir_str','desc');
        if($request->ajax()){
            return DataTables::of($dataSTR)
            ->addIndexColumn()
            ->addColumn('surat','pages.surat.str-riwayat')
            ->addColumn('aksi','pages.str.part.aksi-riwayat')
            ->addColumn('status',function($q){
                // $data_warna = 'btn-secondary';
                // $data_status = 'nonaktif';
                // if($q->masa_berakhir_str > now()){
                //     $data_warna = 'btn-success';
                //     $data_status = 'aktif';
                // }
                return "<button class='btn btn-success'> Aktif </button>";
            })
            ->addColumn('tanggal-terbit-str', function($item){
                $tanggal = Carbon::parse($item->tanggal_terbit)->format('d-m-Y');
                return $tanggal;
            })
            ->addColumn('masa-berakhir-str', function($item){
                return $item->masa_berakhir_str;
            })
            ->rawColumns(['surat','aksi','status','tanggal-terbit-str', 'masa-berakhir-str'])
            ->toJson();
        }
        return view('pages.str.riwayat.index', [
            'pegawai' => $pegawai
        ]);
    }
    public function showRiwayat(STR $str){

        return view('pages.str.riwayat.show',[
            'str'=>$str]);
    }
    public function editRiwayat(STR $str){
        $results = Pegawai::where('status_tenaga', 'asn')->where('jenis_tenaga', 'nakes')->get();

        return view('pages.str.riwayat.edit', [
            'str' => $str,
            'results' => $results
        ]);
    }
    
    private function dataLaporan($pegawais){
        $dataLaporan = [];
        foreach ($pegawais as $pegawai) { 
            $str = STR::where('pegawai_id' , $pegawai->id)->orderBy('masa_berakhir_str', 'desc')->first();
            array_push($dataLaporan, [
                'Nama Pegawai' => $pegawai->nama_lengkap ?? $pegawai->nama_depan,
                'Jabatan' => $pegawai->jabatan,
                'Ruangan' => $pegawai->ruangan->nama_ruangan,
                'Masa Berakhir' => $str->masa_berakhir_str ?? null,
                // 'Status' => ,
                'Status' =>  isset($str->masa_berakhir_str) ?( $str->masa_berakhir_str >= Carbon::parse(now())->format('Y-m-d') ? 'active' : 'expired') : null ,
                // 'Status' =>  $str->masa_berakhir_str ?? null,
                'Link STR' => $str->link_str ?? null,
                'Penerbit' => $str->penerbit_str ?? null,
                'Tanggal Terbit' => $str->tanggal_terbit_str ?? null
            ]);
        }
        $laporan = new STRExport([
            ['Data Rekap STR'],
            ['Nama Pegawai', 'Jabatan', 'Ruangan', 'Masa Berakhir', 'Status', 'Link STR', 'Penerbit', 'Tanggal Terbit'],
            [...$dataLaporan]
        ]);
        return Excel::download($laporan, 'STR.xlsx');
    }

    public function export_excel(){
        // return 'testing';
        $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('str', function ($query) {
            $query->orderBy('masa_berakhir_str', 'desc');
        })->get();
        return $this->dataLaporan($pegawai);
    }


    public function reminderSTR(Request $request){
        $currentDate = Carbon::now();
        $sixMonthsFromNow = $currentDate->addMonths(6);
        if($request->ajax()){
            $reminderSTR = Pegawai::query()->where('jenis_tenaga', 'nakes')->with(['str' => function ($query) {
                $query->orderBy('masa_berakhir_str', 'desc');
            }])->whereHas(
                'str',
                function ($query) use ($currentDate, $sixMonthsFromNow) {
                    $query->whereDate(
                        'tanggal_terbit_str',
                        '<=',
                        $currentDate
                    )
                        ->whereDate('masa_berakhir_str', '>', $currentDate)
                        ->whereDate('masa_berakhir_str', '>', $sixMonthsFromNow);
                },
                '=',
                0
            )->get();
            $dataPegawai = DataTables::of($reminderSTR)
            ->addIndexColumn()
            ->addColumn('nama', function ($item) {
                return $item->nama_lengkap ?? $item->nama_depan;
            })
            ->addColumn('pesan', function ($item) {
                $nowa = $item->no_wa;
                if (substr(trim($nowa), 0, 1) == '0') {
                    $nowa = '62' . substr(trim($nowa), 1);
                }
                $tanggal =  $item->str->count() > 0 ? Carbon::parse($item->str[0]->masa_berkahir_str)->format('d-m-Y') : null;
                $nama = $item->nama_lengkap ?? $item->nama_depan;
                $pesan = "https://wa.me/$nowa/?text=SIKEP%0Auntuk :$nama %0A STR anda  $tanggal, mohon hubungi kepegawaian untuk mengurusi STR anda";
                return '<a href="' . $pesan . '" target="_blank" class="btn btn transparent"><i
                                            class="fab fa-whatsapp fa-2x text-success"></i> </a>';
            })
            ->addColumn('masa_berakhir_str', function ($item) {
                $data = $item->str->count() > 0 ? Carbon::parse($item->str[0]->masa_berakhir_str)->format('d-m-Y') : 'belum memiliki STR';
                return $data ?? '-';
            })
            ->rawColumns(['pesan', 'nama', 'masa_berakhr_str'])
            ->toJson();
            return  $dataPegawai;
        }
        return view('pages.dashboard.reminderstr');

    }
   
    


}
