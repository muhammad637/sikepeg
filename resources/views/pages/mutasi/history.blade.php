@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">mutasi</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4"> 
        <h3 class="pt-2 mt-2 pl-5" style="color:black;font-weight:bold;">History mutasi {{$mutasi[0]->pegawai->nama_depan ?? $mutasi[0]->pegawai->nama_belakang}}</h3>       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            <th scope="col">Pegawai</th>
                            <th scope="col">Jenis Mutasi</th>
                         
                            
                            <th scope="col">Ruangan Awal</th>
                            <th scope="col">Ruangan Tujuan</th>
                            <th scope="col">Instansi Awal</th>
                            <th scope="col">Instansi Tujuan</th>
                            <th scope="col">Tanggal Berlaku</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mutasi as $item)     
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pegawai->nama_depan }}</td>
                                <td>{{ $item->jenis_mutasi }}</td>
                                <td>{{ $item->ruangan_awal }}</td>
                                <td>{{ $item->ruangan_tujuan }}</td>    
                                <td>{{ $item->instansi_awal}}</td>
                                <td>{{ $item->instansi_tujuan}}</td>
                                <td>
                                    {{ $item->tanggal_berlaku}}
                                </td>
                                <td>

                                    <a href="{{ route('mutasi.show', ['mutasi' => $item->id]) }}" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ $item->link_mutasi }}" class="btn btn-success" target="_blank">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    <a href="{{ route('mutasi.edit', ['mutasi' => $item->id]) }}" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- tabel End -->
    <!-- /.container-fluid -->
@endsection
