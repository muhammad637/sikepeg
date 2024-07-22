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
        $data = Gdrive::readStream('dokumen/' . $request->namePath . '/' . $request->namaFile);


        return response()->stream(function () use ($data) {
            fpassthru($data->file);
        }, 200, [
            'Content-Type' => $data->ext,
            'Content-disposition' => 'attachment; filename="' . $request->namaFile . '"', // force download?
        ]);
       
    }
    public function tes()
    {
        $fileName = 'biodata.pdf';
        $filePath = public_path($fileName); // Menggunakan public_path() untuk mendapatkan path lengkap

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }


}
