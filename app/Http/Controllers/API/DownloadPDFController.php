<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
// use Google\Service\Storage;
use Illuminate\Support\Facades\Storage;

class DownloadPDFController extends Controller
{

    // public function uploadTes(){
    //     Storage::disk('google')->put('testing/filename.png', public_path('image/logo.png'));
    //     // Gdrive::put('testing/filename.png',public_path('image/logo.png'));
    //     return response()->json('data berhasil dikirim');
    // }
 
    //
    public function downloadStr(){
        // return 'testing';
        $data = Gdrive::get('dokumen/str');
        
        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="'.$data->filename.'"');

    }

    public function downloadSip(){
        $data = Gdrive::get('dokumen/sip');

        return response($data->file, 200)
        ->header('Content-Type', $data->ext)
        ->header('Content-disposition', 'attachment; filename="'. $data->filename. '"');
    }

    public function downloadDiklat(){
        $data = Gdrive::get('dokumen/diklat');

        return response($data->file, 200)
        ->header('Content-Type', $data->ext)
        ->header('Content-disposition', 'attachment; filename="'. $data->filename. '"');
    }

    public function downloadCuti(){
        $data = Gdrive::get('dokumen/diklat');

        return response($data->file, 200)
        ->header('Content-Type', $data->ext)
        ->header('Content-disposition', 'attachment; filename="'. $data->filename. '"');
    }


}
