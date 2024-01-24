<?php

namespace App\Http\Controllers;


use App\Models\Pegawai;
use Illuminate\Http\Request;

class PersonalFileController extends Controller
{
    public function index()
    {
        //
        // return $pegawai;
        $pegawai = auth()->guard('pegawai')->user();
        return view('pages.pegawai.detailpegawai', [
            'pegawai' => $pegawai
        ]);
    }
    //
}
