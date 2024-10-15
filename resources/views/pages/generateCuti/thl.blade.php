<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .download-container {
            text-align: center;
            margin-top: 50px;
        }

        #content-to-download {
            margin: 15px auto;
            padding: 10px 5px;
            width: 90%;
            /* max-width: 600px; */
            /* border: 2px solid #000; */
            /* display: none; */
            /* Menambahkan border hitam */
            /* border-radius: 10px; */
            /* Menambahkan sudut tumpul pada border */
        }

        .download-link,
        .download-button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .download-button {
            border: none;
            cursor: pointer;
        }

        .download-link:hover,
        .download-button:hover {
            background-color: #0056b3;
        }

        @media print {
            #content-to-download {
                border: 2px solid #000;

            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>

<body>

    <div class="content-container" id="content-to-download">
        <div align="center"
            style="margin-top:0; margin-right:0; margin-bottom:8pt; margin-left:0; font-size:11pt; font-family:'Calibri',sans-serif;">
            <table style="width:503pt; border-collapse:collapse; border:none;">
                <tbody>
                    <tr>
                        <td style="width:225.4pt; padding:0 5.4pt; vertical-align:top;">
                            <p style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal;">
                                <span style="font-family:'Times New Roman',serif;">&nbsp;</span>
                            </p>
                        </td>
                        <td style="width:277.6pt; padding:0 5.4pt; vertical-align:top;">
                            <p style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal;">
                                <span style="font-family:'Times New Roman',serif;">
                                    Banyuwangi,..........{{ Carbon\Carbon::parse($data->mulai_cuti)->format('d F Y') }}.
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:225.4pt; padding:0 5.4pt; vertical-align:top;">
                            <p style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal;">
                                <span style="font-family:'Times New Roman',serif;">&nbsp;</span>
                            </p>
                        </td>
                        <td style="width:277.6pt; padding:0 5.4pt; vertical-align:top;">
                            <p style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal;">
                                <span style="font-family:'Times New Roman',serif;">&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:225.4pt; padding:0 5.4pt; vertical-align:top;">
                            <p style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal;">
                                <span style="font-family:'Times New Roman',serif;">&nbsp;</span>
                            </p>
                        </td>
                        <td style="width:277.6pt; padding:0 5.4pt; vertical-align:top;">
                            <p style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal;">
                                <span style="font-family:'Times New Roman',serif;">Kepada</span>
                            </p>
                            <p style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal;">
                                <span style="font-family:'Times New Roman',serif;">Yth. Direktur RSUD Blambangan
                                    Banyuwangi</span>
                            </p>
                            <p
                                style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal; margin-left:24.2pt;">
                                <span style="font-family:'Times New Roman',serif;">di.</span>
                            </p>
                            <p
                                style="margin:0; font-size:11pt; font-family:'Calibri',sans-serif; line-height:normal; margin-left:38.4pt;">
                                <u><span style="font-family:'Times New Roman',serif;">BANYUWANGI</span></u>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style='margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;'
            align="center">
            <span style='font-size:16px;font-family:"Times New Roman",serif;'>FORMULIR PERMINTAAN DAN PEMBERIAN
                CUTI</span>
        </p>
         <div align="center"
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <table style="width:503.0pt;border-collapse:collapse;border:none;">
                <tbody>
                    <tr>
                        <td colspan="4"
                            style="width: 503pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>I. DATA PEGAWAI</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 63.4pt; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; vertical-align: middle;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Nama</span></p>
                        </td>
                        <td
                            style="width: 46.4977%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>{{ $data->pegawai->nama_lengkap }}</span></p>
                        </td>
                        <td
                            style="width: 16.0395%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>NIP</span></p>
                        </td>
                        <td
                            style="width: 23.6028%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Times New Roman",sans-serif;line-height:  normal;'>
                                {{$data->pegawai->nip_nippk}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 63.4pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Jabatan</span></p>
                        </td>
                        <td
                            style="width: 46.4977%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Times New Roman",sans-serif;line-height:  normal;'>
                                {{$data->pegawai->jabatan}}</p>
                        </td>
                        <td
                            style="width: 16.0395%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Masa kerja</span></p>
                        </td>
                        <td
                            style="width: 23.6028%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                 <span
                                    style='font-family:"Times New Roman",serif;'>&nbsp;{{ $data->pegawai->status_tipe == 'pns' ? date_diff(date_create($data->pegawai->tmt_pns), date_create('now'))->y : ($data->pegawai->status_tipe == 'pppk' ? date_diff(date_create($data->pegawai->tmt_pppk), date_create('now'))->y : date_diff(date_create($data->pegawai->tanggal_masuk), date_create('now'))->y) }}
                                    Tahun</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 63.4pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Unit kerja</span></p>
                        </td>
                        <td colspan="3"
                            style="width: 439.6pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;{{$data->pegawai->ruangan->nama_ruangan}}</span></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
        <div align="center"
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <table style="width:503.0pt;border-collapse:collapse;border:none;">
                <tbody>
                    <tr>
                        <td colspan="4"
                            style="width: 503pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>II. JENIS CUTI YANG DIAMBIL **</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 148.6pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>1. Cuti Tahunan</span>
                            </p>
                        </td>
                        <td
                            style="width: 3cm;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp; @if (strpos($data->jenis_cuti, 'tahunan'))
                                        &#10003;
                                    @endif
                                </span>
                            </p>
                        </td>
                        <td
                            style="width: 177.2pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>3. Cuti Sakit</span>
                            </p>
                        </td>
                        <td
                            style="width: 92.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp; @if (strpos($data->jenis_cuti, 'sakit'))
                                        &#10003;
                                    @endif
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 177.2pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>3. Cuti Melahirkan</span>
                            </p>
                        </td>
                        <td
                            style="width: 92.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp; @if (strpos($data->jenis_cuti, 'melahirkan'))
                                        &#10003;
                                    @endif
                                </span>
                            </p>
                        </td>
                        <td
                            style="width: 177.2pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:10.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>4. Cuti Karena Alasan Penting</span>
                            </p>
                        </td>
                        <td
                            style="width: 92.15pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height: normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp; @if (strpos($data->jenis_cuti, 'penting'))
                                        &#10003;
                                    @endif
                                </span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
        <div align="center"
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <table style="width:503.0pt;border-collapse:collapse;border:none;">
                <tbody>
                    <tr>
                        <td style="width: 503pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>III. ALASAN CUTI&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 503pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 41.3pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;
                                    {{ $data->alasan_cuti }}</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
        <div align="center"
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <table style="width:503.0pt;border-collapse:collapse;border:none;">
                <tbody>
                    <tr>
                        <td colspan="6"
                            style="width: 99.25pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>IV. LAMANYA CUTI</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 44.5pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Selama</span>
                            </p>
                        </td>
                        <td
                            style="width: 124.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:10.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>{{ $data->jumlah_hari }}
                                    Hari/<s>Bulan/Tahun<s> *</span>
                            </p>
                        </td>
                        <td
                            style="width: 79.1pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:10.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Mulai Tanggal</span>
                            </p>
                        </td>
                        <td
                            style="width: 99.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span
                                    style='font-family:"Times New Roman",serif;'>&nbsp;{{ Carbon\Carbon::parse($data->mulai_cuti)->format('d/m/Y') }}</span>
                            </p>
                        </td>
                        <td
                            style="width: 1cm;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>s/d</span>
                            </p>
                        </td>
                        <td
                            style="width: 99.25pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span
                                    style='font-family:"Times New Roman",serif;'>&nbsp;{{ Carbon\Carbon::parse($data->selesai_cuti)->format('d/m/Y') }}</span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
        <div align="center"
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <table style="width:503.0pt;border-collapse:collapse;border:none;">
                <tbody>
                    <tr>
                        <td colspan="5"
                            style="width: 503pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>V. CATATAN CUTI ***</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="width: 184.05pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>1. CUTI TAHUNAN</span>
                            </p>
                        </td>
                        <td
                            style="width: 44.6046%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>2. CUTI SAKIT</span>
                            </p>
                        </td>
                        <td
                            style="width: 14.8589%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;
                                    {{ $data->formLanjutan['cutiSakit'] ?? '' }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 49.4pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Tahun</span>
                            </p>
                        </td>
                        <td
                            style="width: 63.75pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Sisa</span>
                            </p>
                        </td>
                        <td
                            style="width: 70.9pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Keterangan</span>
                            </p>
                        </td>
                        <td
                            style="width: 44.6046%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>3. CUTI MELAHIRKAN</span>
                            </p>
                        </td>
                        <td
                            style="width: 14.8589%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;
                                    {{ $data->formLanjutan['cutiMelahirkan'] ?? '-' }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 49.4pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>N</span>
                            </p>
                        </td>
                        <td
                            style="width: 63.75pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;
                                    {{ $data->formLanjutan['n']['sisa'] ?? '' }}</span>
                            </p>
                        </td>
                        <td
                            style="width: 70.9pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span
                                    style='font-family:"Times New Roman",serif;'>&nbsp;{{ $data->formLanjutan['n']['keterangan'] ?? '' }}</span>
                            </p>
                        </td>
                        <td
                            style="width: 44.6046%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>4. CUTI KARENA ALASAN PENTING</span>
                            </p>
                        </td>
                        <td
                            style="width: 14.8589%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;
                                    {{ $data->formLanjutan['cutiKarenaAlasanPenting'] ?? '' }}</span>
                            </p>
                        </td>
                    </tr>

                </tbody>
            </table>


        </div>
        <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
        <div align="center"
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <table style="width:503.0pt;border-collapse:collapse;border:none;">
                <tbody>
                    <tr>
                        <td colspan="3"
                            style="width: 503pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>VI. ALAMAT SELAMA MENJALANKAN
                                    CUTI</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 162.8pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Alamat Lengkap</span>
                            </p>
                        </td>
                        <td
                            style="width: 127.55pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Telepon</span>
                            </p>
                        </td>
                        <td rowspan="7"
                            style="width: 212.65pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif; text-align:center;'>Hormat
                                    Saya</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp; </span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span
                                    style='font-family:"Times New Roman",serif;'>(<u>{{ $data->pegawai->nama_lengkap }}</u>)<br>&nbsp;NIP.
                                    {{ $data->pegawai->nip_nippk }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 162.8pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: none;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.95pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp; </span>
                            </p>
                        </td>
                        <td
                            style="width: 127.55pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.95pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp; </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 162.8pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: none;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;
                                    {{ $data->alamat ?? '-' }}</span>
                            </p>
                        </td>
                        <td
                            style="width: 127.55pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;
                                    {{ $data->no_hp ?? '-' }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 162.8pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: none;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 127.55pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 162.8pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: none;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 127.55pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 162.8pt;border-top: none;border-left: 1pt solid windowtext;border-bottom: none;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 127.55pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="width: 162.8pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 127.55pt;border-top: none;border-left: none;border-bottom: 1pt solid windowtext;border-right: 1pt solid windowtext;padding: 0cm 5.4pt;height: 7.85pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- <p
            style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p> --}}
        <div align="center"
            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
            <table style="width:503.0pt;border-collapse:collapse;border:none;">
                <tbody>
                    <tr>
                        <td colspan="6"
                            style="width: 503pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>VII. PERTIMBANGAN ATASAN LANGSUNG
                                    **</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="width: 15.2012%; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>DISETUJUI</span>
                            </p>
                        </td>
                        <td
                            style="width: 22.059%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>PERUBAHAN ****</span>
                            </p>
                        </td>
                        <td
                            style="width: 26.4228%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>DITANGGUHKAN ****</span>
                            </p>
                        </td>
                        <td
                            style="width: 35.8723%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>TIDAK DISETUJUI ****</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="width: 15.2012%; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 22.059%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 26.4228%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 35.8723%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="width: 15.2012%; border: none; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td style="width: 22.059%; border: none; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 26.4228%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 35.8723%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span
                                    style='font-family:"Times New Roman",serif;'>......................................................</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span
                                    style='font-family:"Times New Roman",serif;'>(<u>......................................................</u>)<br>&nbsp;NIP..............................................</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="width: 15.2012%; border-top: none; border-right: none; border-left: none; border-image: initial; border-bottom: 1pt solid windowtext; padding: 0cm 5.4pt; height: 7.95pt; vertical-align: top;">
                            {{-- <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p> --}}
                        </td>
                        <td
                            style="width: 22.059%; border-top: none; border-right: none; border-left: none; border-image: initial; border-bottom: 1pt solid windowtext; padding: 0cm 5.4pt; height: 7.95pt; vertical-align: top;">
                            {{-- <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p> --}}
                        </td>
                        <td
                            style="width: 26.4228%; border-top: none; border-right: none; border-left: none; border-image: initial; border-bottom: 1pt solid windowtext; padding: 0cm 5.4pt; height: 7.95pt; vertical-align: top;">
                            {{-- <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p> --}}
                        </td>
                        <td
                            style="width: 35.8723%; border-top: none; border-right: none; border-left: none; border-image: initial; border-bottom: 1pt solid windowtext; padding: 0cm 5.4pt; height: 7.95pt; vertical-align: top;">
                            {{-- <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p> --}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"
                            style="width: 503pt;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-left: 1pt solid windowtext;border-image: initial;border-top: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>VIII. KEPUTUSAN PEJABAT YANG
                                    BERWENANG
                                    MEMBERIKAN CUTI **</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="width: 15.2012%; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>DISETUJUI</span>
                            </p>
                        </td>
                        <td
                            style="width: 22.059%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>PERUBAHAN ****</span>
                            </p>
                        </td>
                        <td
                            style="width: 26.4228%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>DITANGGUHKAN ****</span>
                            </p>
                        </td>
                        <td
                            style="width: 35.8723%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <span style='font-family:"Times New Roman",serif;'>TIDAK DISETUJUI ****</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="width: 15.2012%; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 22.059%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 26.4228%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                        <td
                            style="width: 35.8723%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"
                            style="width: 63.8296%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <strong><u><span
                                            style='font-family:"Times New Roman",serif;'>Catatan</span></u></strong>
                            </p>
                        </td>
                        <td rowspan="8"
                            style="width: 35.8723%; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:16.15pt;font-size:9.0pt;font-family:"Calibri",sans-serif;text-indent:-16.15pt;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>a.n DIREKTUR RSUD BLAMBANGAN
                                    KABUPATEN
                                    BANYUWANGI<br>Wakil Dikrekur Umum Dan Keuangan</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
                            </p>
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:center;line-height:normal;'>
                                <u><span style='font-family:  "Times New Roman",serif;'>(BUDI PRIYAMBODO,
                                        S.STP)</span></u><span
                                    style='font-family:"Times New Roman",serif;'><br>&nbsp;NIP
                                    19801024 19992 1 002</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="width: 55.25pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>*</span>
                            </p>
                        </td>
                        <td colspan="3"
                            style="width: 49.6717%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Coret yang tidak perlu</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="width: 55.25pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>**</span>
                            </p>
                        </td>
                        <td colspan="3"
                            style="width: 49.6717%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Pilih salah satu dengan memberi tanda
                                    centang (v)</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="width: 55.25pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>***</span>
                            </p>
                        </td>
                        <td colspan="3"
                            style="width: 49.6717%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Di isi oleh pejabat yang menagani
                                    bidang
                                    kepegawaian sebelum pegawai Non PNS mengajukan cuti</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="width: 55.25pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>****</span>
                            </p>
                        </td>
                        <td colspan="3"
                            style="width: 49.6717%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Diberi tanda centang dan alasan
                                    nya</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 35.2pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>N</span>
                            </p>
                        </td>
                        <td style="width: 20.05pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>=</span>
                            </p>
                        </td>
                        <td colspan="3"
                            style="width: 49.6717%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Cuti tahun berjalan</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 35.2pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>N-1</span>
                            </p>
                        </td>
                        <td style="width: 20.05pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>=</span>
                            </p>
                        </td>
                        <td colspan="3"
                            style="width: 49.6717%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Sisa cuti 1 tahun sebelumnya</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 35.2pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>N-2</span>
                            </p>
                        </td>
                        <td style="width: 20.05pt;border: none;padding: 0cm 5.4pt;vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>=</span>
                            </p>
                        </td>
                        <td colspan="3"
                            style="width: 49.6717%; border-top: none; border-bottom: none; border-left: none; border-image: initial; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; vertical-align: top;">
                            <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:.0001pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;line-height:  normal;'>
                                <span style='font-family:"Times New Roman",serif;'>Sisa cuti 2 tahun sebelumnya</span>
                            </p>
                        </td>
                    </tr>
                    {{-- <tr>
                            <td style="border:none;"><br></td>
                            <td style="border:none;"><br></td>
                            <td style="border: none; width: 1.0432%;"><br></td>
                            <td style="border: none; width: 22.059%;"><br></td>
                            <td style="border: none; width: 26.4228%;"><br></td>
                            <td style="border: none; width: 35.8723%;"><br></td>
                        </tr> --}}
                </tbody>
            </table>
        </div>

    </div>
   <div class="download-container">
        <!-- Link untuk mendownload PDF -->

        <!-- Tombol untuk mendownload PDF -->
        <button id="download" class="download-button">Download PDF</button>
    </div>

    <script>
        document.getElementById('download').addEventListener('click', () => {
            // Mengatur border hanya untuk PDF
            const contentContainer = document.querySelector('.content-container');
            contentContainer.style.border = '2px solid #000'; // Menambahkan border
            // contentContainer.style.borderRadius = '10px'; // Menambahkan border-radius

            // Mengonfigurasi html2pdf
            const element = contentContainer;
            const opt = {
                margin: 0, // Margin di sekeliling PDF dalam satuan cm
                filename: 'SuratCuti.pdf', // Nama file PDF
                image: {
                    type: 'jpeg',
                    quality: 0.98
                }, // Jenis dan kualitas gambar
                html2canvas: {
                    scale: 2
                }, // Skala rendering HTML ke canvas
                jsPDF: {
                    unit: 'cm',
                    format: [21, 33],
                    orientation: 'portrait'
                } // Ukuran kertas F4: 21cm x 33cm
            };

            // Mengunduh PDF
            html2pdf().set(opt).from(element).save().then(() => {
                // Mengembalikan gaya elemen setelah unduhan selesai
                contentContainer.style.border = 'none'; // Menghapus border
                // contentContainer.style.borderRadius = '0'; // Menghapus border-radius
            });
        });

        function downloadPDF() {
            // Pilih elemen HTML yang ingin diunduh sebagai PDF
            const element = document.getElementById('content-to-download');



            // Menggunakan html2pdf dengan konfigurasi khusus untuk F4
            const opt = {
                margin: 0, // Margin di sekeliling PDF dalam satuan cm
                filename: 'SuratCuti.pdf', // Nama file PDF
                image: {
                    type: 'jpeg',
                    quality: 0.98
                }, // Jenis dan kualitas gambar
                html2canvas: {
                    scale: 2
                }, // Skala rendering HTML ke canvas
                jsPDF: {
                    unit: 'cm',
                    format: [21, 33],
                    orientation: 'portrait'
                } // Ukuran kertas F4: 21cm x 33cm
            };

            // Menghasilkan dan menyimpan PDF
            html2pdf().set(opt).from(element).save();

            // html2pdf().set(opt).from(element).save().then(() => {
            //     // Mengembalikan elemen ke tampilan semula setelah unduhan selesai
            //     document.querySelector('#content-to-download').style.border = '2px solid #000';
            // });
        }
    </script>

</body>

</html>
