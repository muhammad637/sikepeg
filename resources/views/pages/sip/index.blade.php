@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background-color: #d9d9d9;">
            <div class="d-md-flex justify-content-between s-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Data SIP</h2>
                <a href="{{ route('sip.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">
                    create <i class="fas fa-plus-square ml-1"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Tenaga</th>
                            <th scope="col">Ruangan</th>
                            <th scope="col">Masa Berlaku</th>
                            <th scope="col">Status</th>
                            <th scope="col">Surat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>NAKES</td>
                            <td>ICU</td>
                            <td>10-04-2023</td>
                            <td>
                                <a href="" class="btn btn-success rounded-3 py-0">active</a>
                            </td>
                            <td>
                                <a href="" class="btn bg-gradient-primary m-0">
                                    <i class="fas fa-file-alt text-white"></i>
                                </a>
                            </td>
                            <td>
                                <a href="" class="btn btn-warning">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="" class="btn btn-success">
                                    <i class="fas fa-link"></i>
                                </a>
                                <a href="" class="btn btn-info">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- tabel End -->
    <!-- /.container-fluid -->
@endsection
