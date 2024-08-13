<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class PDFController extends Controller
{
    

    public function downloadPDF(Request $request)
    {
        $validatedData = $request->validate([
            'namePath' => 'required',
            'namaFile' => 'required'
        ]);
        $url = 'dokumen/' . $request->namePath . '/' . $request->namaFile;
        $data = Gdrive::readStream($url);


        // return response()->stream(function () use ($data) {
        //     fpassthru($data->file);
        // }, 200, [
        //     'Content-Type' => $data->ext,
        //     'Content-disposition' => 'attachment; filename="' . $request->namaFile . '"', // force download?
        // ]);
        $data = Gdrive::get($url);
        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="'.$data->filename.'"');
       
    }
    

    public function download(Request $r){
        $path = 'dokumen/'.$r->folder.'/'.$r->namaFile;
        $data = Gdrive::get($path);
        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="' . $data->filename . '"');

    }

    public function generateDokumenCuti(){}


}
