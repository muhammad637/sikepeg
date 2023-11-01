@extends('main',['title'=>'Mutasi'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Mutasi</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Mutasi Pegawai</h4>
                <a href="{{ route('admin.mutasi.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Create <i
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
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Mutasi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Ruangan Awal</th>
                            <th scope="col">Ruangan Tujuan</th>
                            <th scope="col">Instansi Awal</th>
                            <th scope="col">Instansi Tujuan</th>
                            <th scope="col">No SK</th>
                            <th scope="col">Surat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $index => $item)
                            @php
                                $data = explode('view', $item->mutasi[0]->link_sk);
                            @endphp
                            <tr>
                                {{-- <td>{{$loop->iteration}}</td> --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap ?? $item->nama_depan }} </td>
                                <td>{{ $item->mutasi[0]->jenis_mutasi }}</td>
                                <td>{{ Carbon\carbon::parse($item->mutasi[0]->tanggal_berlaku)->format('d/m/Y') }}</td>
                                <td>{{ $item->mutasi[0]->ruanganAwal->nama_ruangan ?? '-'}}</td>
                                <td>{{ $item->mutasi[0]->ruanganTujuan->nama_ruangan ?? ' - ' }}</td>
                                <td>{{ $item->mutasi[0]->instansi_awal ?? ' - ' }}</td>
                                <td>{{ $item->mutasi[0]->instansi_tujuan ??' - '}}</td>
                                <td>{{ $item->mutasi[0]->no_sk }}</td>
                                <td>
                                    <a target="popup"
                                        onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                        class="btn btn-primary" style="cursor: pointer">
                                        <i class="fas fa-file-alt text-white"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.mutasi.show', ['mutasi' => $item->mutasi[0]]) }}"
                                        class="btn btn-info text-white "><i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('admin.mutasi.edit', ['mutasi' => $item->mutasi[0]]) }}"
                                        class="btn btn-warning text-white"><i class="fas fa-pen "></i></a>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endpush
