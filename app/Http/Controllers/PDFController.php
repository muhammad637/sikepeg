<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yaza\LaravelGoogleDriveStorage\Gdrive;


class PDFController extends Controller
{
    public function index(){
        return 'testing';
    }
    public function previewDokumenCuti(Request $r)
    {
        return $r->all();
        $path = 'dokumen/'.$r->folder.'/'.$r->namaFile; 
        // Ambil data file dari Google Drive berdasarkan nama file yang ada di model Post
        // $data = Gdrive::get('image/' . $cuti->image_name);
        $dokumen = Gdrive::get($path);

        // Buat respons dengan file yang diambil dari Google Drive dan atur header Content-Type
        // $fileResponse = response($data->file, 200)
        //     ->header('Content-Type', $data->ext);
        $dokResponse = response($dokumen->file, 200)
            ->header('Content-Type', $dokumen->ext);

        // Kembalikan respons JSON dengan data file dan judul cuti
        return view('pages.previewDokumen', [
            'title' => 'preview dokumen '  ,
            'file' => [
                'content' => base64_encode($dokumen->file),
                'type' => $dokumen->ext,
                'name' => 'tes'
            ],
        ]);
        
    }
}
