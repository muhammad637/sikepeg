<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;



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
        $path = $r->path;
        $dokumen = Gdrive::get($path);
        $dokResponse = response($dokumen->file, 200)
            ->header('Content-Type', $dokumen->ext);
        return view('pages.previewDokumen', [
            'title' => 'preview dokumen ',
            'file' => [
                'content' => base64_encode($dokumen->file),
                'type' => $dokumen->ext,
                'path' => $r->path
            ],
        ]);
    }




    // public function generateDok(Cuti $cuti)
    // {
    //     // Path ke file Word template di folder publik
    //     $templatePath = public_path('pppk.docx');

    //     // Memastikan template file ada
    //     if (!file_exists($templatePath)) {
    //         abort(404, 'Template not found.');
    //     }

    //     // Membaca file template Word
    //     $templateProcessor = new TemplateProcessor($templatePath);

    //     // Mengisi placeholder dengan data dari cuti
    //     $templateProcessor->setValue('nama', $cuti->id);
    //     $templateProcessor->setValue('jabatan', $cuti->jumlah_hari);
    //     $templateProcessor->setValue('tanggal', $cuti->jenis_cuti);

    //     // Simpan hasil ke file sementara
    //     $filledDocxPath = storage_path('app/temp_filled.docx');
    //     $templateProcessor->saveAs($filledDocxPath);

    //     // Konversi file Word yang telah diisi ke HTML
    //     $phpWord = IOFactory::load($filledDocxPath);
    //     $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    //     $htmlFilePath = storage_path('app/temp.html');
    //     $htmlWriter->save($htmlFilePath);

    //     // Konversi HTML ke PDF menggunakan Dompdf
    //     $dompdf = new Dompdf();
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isPhpEnabled', true);
    //     $dompdf->setOptions($options);

    //     $dompdf->loadHtml(file_get_contents($htmlFilePath));
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Output PDF ke browser
    //     $pdfContent = $dompdf->output();

    //     // Hapus file sementara
    //     unlink($htmlFilePath);
    //     unlink($filledDocxPath);

    //     return response()->stream(
    //         function () use ($pdfContent) {
    //             echo $pdfContent;
    //         },
    //         200,
    //         [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' => 'attachment; filename="document.pdf"',
    //         ]
    //     );
    // }


    public function generateDok(Cuti $cuti)
    {
        // return $cuti->pegawai->status_tipe;
        // $html = view('pages.generateCuti.thl', ['data' => $cuti])->render();
        if($cuti->pegawai->status_tipe == 'thl'){
            $html = view('pages.generateCuti.thl', ['data' => $cuti])->render();
        }else{
            $html = view('pages.generateCuti.pppk', ['data' => $cuti])->render();

        }
        return response($html, 200)
            ->header('Content-Type', 'text/html');
        // $html = view('pages.generateCuti.thl', ['data' => $cuti])->render();
        $mpdf->WriteHTML($html);

       
    }
}
