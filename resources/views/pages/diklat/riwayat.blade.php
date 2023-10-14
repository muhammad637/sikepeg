@extends('main')
@section('content')
<h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Data Diklat</h1>
<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow-sm mb-4">
    <div class="card-header ">
        <div class="d-md-flex justify-content-between d-sm-block">
            <h2 class="m-0 font-weight-bold text-dark">Riwayat Diklat</h2>
        </div>
    </div>

    <div class="card-body">

        {{-- @if (session()->has('success'))
        {{ session()->get('success') }}
        @endif --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                cellspacing="0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Nama Diklat</th>
                        <th scope="col">Jumlah Jam</th>
                        <th scope="col">Penyelenggara</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">No Sertifikat</th>
                        <th scope="col">Tanggal Sertifikat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diklat as $index => $item)

                    @php
                    $data = explode('view', $item->link_sertifikat);
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pegawai->nama_depan }}</td>
                        <td>{{ $item->nama_diklat }}</td>
                        <td>{{ $item->jumlah_jam }}</td>
                        <td>{{ $item->penyelenggara }}</td>
                        <td>{{ $item->tempat }}</td>
                        <td>{{ $item->tahun}}</td>
                        <td>{{ $item->no_sertifikat}}</td>
                        <td>{{ $item->tanggal_sertifikat}}</td>
                        <td>
                            <a target="popup" onclick="window.open(`{{$data[0]}}`,'name','width=600,height=400')"
                                class="btn btn-primary" style="cursor: pointer">
                                <i class="fas fa-file-alt text-white"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection