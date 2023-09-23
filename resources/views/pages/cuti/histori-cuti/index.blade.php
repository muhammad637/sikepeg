@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Cuti</h1>
 
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Histori Cuti</h2>
                <a href="{{ route('data-cuti-aktif.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">create <i
                        class="fas fa-plus-square ml-1"></i></a>
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
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Cuti Tahunan</td>
                            <td>Sakit Hati</td>
                            <td>17-09-2023</td>
                            <td>19-09-2023</td>
                            <td>3</td>
                            <td>9</td>
                            <td class="d-flex justify-content-center">
                                <a href="#" class="btn btn-info">
                                    Lihat</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
