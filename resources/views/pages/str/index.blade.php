@extends('main')

@section('content')
    <!-- Begin Page Content -->    
        <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Personal File</h1>
        <!-- tabel -->
        <div class="container-fluid">
            <div class="row mx-auto py-2" style="background-color: #d9d9d9;">
                <h3 class="col">DATA STR</h3>
                <a href="{{route('str.create')}}">
                    <button class="btn btn-primary mr-4">Tambah <i class="far fa-plus-square pl-1"></i></button>
                </a>
            </div>
            <div class="bg-white text-center rounded p-4">
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0 text-capitalize"
                        id="dataTable">
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
                                    <a href="{{route('str.show',['str' => $item->id])}}" class="btn btn-warning">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="" class="btn btn-success">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    <a href="{{route('str.edit',['str' => $item->id])}}" class="btn btn-info">
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