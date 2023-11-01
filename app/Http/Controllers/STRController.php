<?php

namespace App\Http\Controllers;



use Carbon\Carbon;
use App\Exports\STRExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Asn;
use App\Models\STR;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Dotenv\Util\Str as UtilStr;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class   STRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pegawai = Pegawai::where('jenis_tenaga', 'nakes')->with('str', function ($query) {
            $query->orderBy('masa_berakhir_str', 'desc');
        })->get();
        return view('pages.str.index', [
            'pegawai' => $pegawai,
            'i' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = Pegawai::where('status_tenaga', 'asn')->where('jenis_tenaga', 'nakes')->get();
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
            'tanggal_terbit_str' => $request->tanggal_terbit_str,
            'masa_berakhir_str' => $request->masa_berakhir_str,
            'link_str' => $request->link_str
        ]);
        // return $str;
        return redirect(route('str.index'))->with('success', 'str berhasil ditambahkan');
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
                'tanggal_terbit_str' => $request->tanggal_terbit_str,
                'masa_berakhir_str' => $request->masa_berakhir_str,
                'link_str' => $request->link_str
            ]);
            // return $str;
            return redirect(route('str.index'))->with('success', 'str berhasil ditambahkan');
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
    public function destroy(STR $sTR)
    {
        //
    }

    // history
    public function history(Pegawai $pegawai)
    {
        return view('pages.str.history', [
            'pegawai' => $pegawai
        ]);
    }
    
    private function dataLaporan($pegawais){
        $dataLaporan = [];
        foreach ($pegawais as $pegawai) { 
            $str = STR::where('pegawai_id' , $pegawai->id)->orderBy('masa_berakhir_str', 'desc')->first();
            array_push($dataLaporan, [
                'Nama Pegawai' => $pegawai->nama_lengkap ?? $pegawai->nama_depan,
                'Jabatan' => $pegawai->jabatan,
                'Ruangan' => $pegawai->ruangan,
                'Masa Berakhir' => $str->masa_berakhir_str ?? null,
                // 'Status' => ,
                'Status' =>  isset($str->masa_berakhir_str) ?( $str->masa_berakhir_str >= Carbon::parse(now())->format('Y-m-d') ? 'active' : 'expired') : null ,
                // 'Status' =>  $str->masa_berakhir_str ?? null,
                'Link STR' => $str->link_str ?? null
            ]);
        }
        $laporan = new STRExport([
            ['Nama Pegawai', 'Jabatan', 'Ruangan', 'Masa Berakhir', 'Status', 'Link STR'],
            [...$dataLaporan]
        ]);
        return Excel::download($laporan, 'order.xlsx');
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
                $data = $item->str->count() > 0 ? Carbon::parse($item->str[0]->masa_berakhir_str)->format('d-m-Y') : '-';
                return $data ?? '-';
            })
            ->rawColumns(['pesan', 'nama', 'masa_berakhr_str'])
            ->toJson();
            return  $dataPegawai;
        }
        return view('pages.dashboard.reminderstr');

    }
   
    


}
