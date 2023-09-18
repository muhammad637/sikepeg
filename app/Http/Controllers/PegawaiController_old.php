<?php

// namespace App\Http\Controllers;


// use App\Models\Asn;
// use App\Models\SIP;
// use App\Models\STR;
// use App\Models\Pegawai;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use App\Models\NonAsn;
// use App\Models\UmumStruktural;

// class PegawaiController extends Controller
// {
//     //

//     private $rulesPegawai = [
//         'status_tenaga' => 'required',
//     ];
//     private $rulesAsn = [
//         'jenis_tenaga' => 'required'
//     ];



//     public function index()
//     {
//         return Pegawai::where('status_tenaga', 'asn')->get();
//     }

//     // public function store(Request $request)
//     // {
//         $validatedPegawai = $request->validate($this->rulesPegawai);
//         $pegawai = Pegawai::create($validatedPegawai);
//         if ($pegawai->status_tenaga == 'non asn') {
//             $pegawai->update(['tipe_tenaga' => $request->status_tenaga]);
//             NonAsn::create([
//                 'pegawai_id' => $pegawai->id,
//             ]);

//             return "pegawai non asn";
//         }
//         $pegawai->update(['tipe_tenaga' => $request->tipe_tenaga]);
//         $validatedAsn = $request->validate($this->rulesAsn);
//         $pegawaiAsn = Asn::create(array_merge(['pegawai_id' => $pegawai->id], $validatedAsn));
//         // jika asn jenis ternaga == fungsional
//         if ($pegawaiAsn->jenis_tenaga == 'fungsional') {
//             # code...
//             if ($request->no_str  && $request->tanggal_terbit_str  && $request->masa_berakhir_str  && $request->link_str) {
//                 STR::create([
//                     'asn_id' => $pegawaiAsn->id,
//                 ]);
//             }
//             if ($request->no_sip  && $request->tanggal_terbit_sip  && $request->masa_berlaku_sip  && $request->link_sip) {
//                 SIP::create([
//                     'asn_id' => $pegawaiAsn->id,
//                 ]);
//             }
//             return 'asn jenis tenaga fungsional';
//         }
//         if ($pegawaiAsn->jenis_tenaga == 'administrasi') {
//             # code...  
//             UmumStruktural::create([
//                 'asn_id' => $pegawaiAsn->id,
//             ]);
//             return 'asn jenis tenaga administrasi';
//         } elseif ($pegawaiAsn->jenis_tenaga == 'jabatan pimpinan tinggi') {
//             return 'asn jenis tenaga jabatan pimpinan tinggi';
//         }
//         return "pegawai asn";
//     }
//     public function show(Pegawai $pegawai)
//     {
//         //    return $pegawai->asn;
//         if ($pegawai->asn) {
//             return $pegawai->asn;
//         } else {
//             return $pegawai->nonAsn;
//         }
//     }

//     public function edit(Pegawai $pegawai)
//     {
//         return $pegawai;
//     }

//     public function update(Pegawai $pegawai, Request $request)
//     {
//     }
// }
