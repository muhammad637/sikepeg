@extends('main')
@section('content')
<h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Data Diklat</h1>
<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow-sm mb-4">
    <div class="card-header ">
        <div class="d-md-flex justify-content-between d-sm-block">
            <h2 class="m-0 font-weight-bold text-dark">Diklat</h2>
            <a href="{{ route('admin.diklat.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Create <i
                    class="fas fa-plus-square ml-1"></i></a>
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
                        <th scope="col">Penyelenggara</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Nomer Sertifikat</th>
                        <th scope="col">Sertifikat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $index => $item)
                    @if (count($item->diklat) > 0)
                    @php
                    $data = explode('view', $item->diklat[0]->link_sertifikat);
                    $i++;
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->nama_depan }}</td>
                        <td>{{ $item->diklat[0]->nama_diklat }}</td>
                        <td>{{ $item->diklat[0]->penyelenggara }}</td>
                        <td>{{ $item->diklat[0]->tahun }}</td>
                        <td>{{ $item->diklat[0]->no_sertifikat }}</td>
                        <td>
                            <a target="popup" onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                class="btn btn-primary" style="cursor: pointer">
                                <i class="fas fa-file-alt text-white"></i></a>


                        </td>
                        <td>
                            <a href="{{ route('admin.diklat.riwayat', ['pegawai' => $item->id]) }}"
                                class="btn btn-info text-white"><i class="fas fa-info-circle"></i></a>
                            <a href="{{ route('admin.diklat.edit', ['diklat' => $item->diklat[0]]) }}"
                                class="btn btn-warning text-white"><i class="fas fa-pen "></i></a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection