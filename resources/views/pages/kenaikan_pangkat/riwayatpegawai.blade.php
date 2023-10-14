@extends('mainpegawai')

@section('content')
<h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Data Kenaikan Pangkat</h1>
<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow-sm mb-4">
    <div class="card-header ">
        <div class="d-md-flex justify-content-between d-sm-block">
            <h2 class="m-0 font-weight-bold text-dark">Riwayat Kenaikan Pangkat</h2>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                cellspacing="0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Pangkat</th>
                        <th scope="col">Golongan</th>
                        <th scope="col">Nama Jabatan Fungsional</th>
                        <th scope="col">TMT Pangkat</th>
                        <th scope="col">NO SK Pejabat</th>
                        <th scope="col">Tanggal SK</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kenaikanpangkat as $index => $item)
                    @php
                    $data = explode('view', $item->link_sk);
                    @endphp


                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pegawai->nama_depan }}</td>
                        <td>{{ $item->pangkat->nama_pangkat }}</td>
                        <td>{{ $item->golongan->nama_golongan }}</td>
                        <td>{{ $item->nama_jabatan_fungsional }}</td>
                        <td>{{ $item->tmt_pangkat_dari }} / {{$item->tmt_pangkat_sampai}}</td>
                        <td>{{ $item->no_sk}}</td>
                        <td>{{ $item->tanggal_sk}}</td>
                        <td>
                            <a target="popup" onclick="window.open(`{{$data[0]}}`,'name','width=600,height=400')"
                                class="btn btn-primary" style="cursor: pointer">
                                <i class="fas fa-file-alt text-white"></i></a>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection