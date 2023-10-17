@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Cuti</h1>

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Histori Cuti</h2>
               
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Cuti</th>
                            <th scope="col">Alasan</th>
                            <th scope="col">Mulai Cuti</th>
                            <th scope="col">Akhir Cuti</th>
                            <th scope="col">Jumlah hari</th>
                            <th scope="col">Sisa Cuti dalam setahun</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historiCuti as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan }}</td>
                                <td>{{ $item->jenis_cuti }}</td>
                                <td>{{ $item->alasan_cuti }}</td>
                                <td>{{ Carbon\Carbon::parse($item->mulai_cuti)->format('d-M-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($item->selesai_cuti)->format('d-M-Y') }}</td>
                                <td>{{ $item->jumlah_hari }}</td>
                                <td>{{ $item->pegawai->sisa_cuti_tahunan }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-info">
                                        Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
