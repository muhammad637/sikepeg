@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Cuti</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h3 class="m-0 font-weight-bold text-dark">Data Cuti Aktif Pegawai</h3>
                <a href="{{ route('admin.data-cuti-aktif.create') }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize">create <i class="fas fa-plus-square ml-1"></i></a>

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
                            <th scope="col">Surat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuti as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pegawai->nama_lengkap ?? $item->pegawai->nama_depan }}</td>
                                <td>{{ $item->jenis_cuti }}</td>
                                <td>{{ $item->alasan_cuti }}</td>
                                <td>{{ $item->mulai_cuti }}</td>
                                <td>{{ $item->selesai_cuti }}</td>
                                <td>
                                    <a target="popup"
                                        onclick="window.open(`{{ $item->link_cuti }}`,'name','width=600,height=400')"
                                        class="btn btn-primary" style="cursor: pointer">
                                        <i class="fas fa-file-alt text-white"></i></a>
                                </td>
                                <td>
                                    <button class="btn btn-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                        {{ $item->status }}</button>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('admin.data-cuti-aktif.edit', ['cuti' => $item->id]) }}"
                                        class="btn btn-warning"><i class="fas fa-pen "></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
