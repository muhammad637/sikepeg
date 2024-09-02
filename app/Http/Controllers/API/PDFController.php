<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class PDFController extends Controller
{

    public function download(Request $r)
    {
        $path = $r->path;
        $data = Gdrive::get($path);
        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="' . $data->filename . '"');
    }
    public function previewDokumen(Request $r)
    {
        try {
            //code...
            $path = $r->path;
            $dokumen = Gdrive::get($path);

            return response()->json([
                'status' => 'success',
                'title' => 'preview dokumen ',
                'message' => 'preview dokumen ',
                'file' => [
                    'content' => base64_encode($dokumen->file),
                    'type' => $dokumen->ext,
                    'path' => $r->path
                ],
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => 'error',
                'message' => 'data gagal di ambil : '. $th->getMessage(),
            ]);
        }
        
       
    }
    public function generateDokumenCuti(){}


}
