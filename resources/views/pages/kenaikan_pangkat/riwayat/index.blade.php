@extends('main', ['title' => 'Riwayat Kenaikan Pangkat'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Kenaikan Pangkat</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Riwayat Kenaikan Pangkat Pegawai {{ $pegawai->nama_lengkap }}</h2>
            </div>
            <a href="{{ route('admin.kenaikan-pangkat.createriwayat', ['pegawai' => $pegawai->id]) }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Tambah <i class="fas fa-plus-square ml-1"></i></a>
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
                            {{-- <th scope="col">Nama Pegawai</th> --}}
                            <th scope="col">Pangkat / Golongan</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">TMT Pangkat</th>
                            <th scope="col">NO SK Pejabat</th>
                            <th scope="col">Tanggal SK</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($kenaikan_pangkat as $index => $item)
                            @php
                                $data = explode('view', $item->link_sk);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pegawai->nama_lengkap }}</td>
                                <td>{{ $item->pangkat 
                                    ? $item->pangkat->nama_pangkat . ' / ' . $item->golongan->nama_golongan
                                    : $item->golongan->nama_golongan }}
                                </td>
                                <td>{{ $item->pegawai->jabatan }}</td>
                                <td>{{ $item->tmt_pangkat_dari }} / {{ $item->tmt_pangkat_sampai }}</td>
                                <td>{{ $item->no_sk }}</td>
                                <td>{{ $item->tanggal_sk }}</td>
                                <td>
                                    <a target="popup"
                                        onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                        class="btn btn-primary" style="cursor: pointer">
                                        <i class="fas fa-file-alt text-white"></i></a>
                                    <a href="{{ route('admin.kenaikan-pangkat.show', ['kenaikan_pangkat' => $item->id]) }}"
                                        class="btn text-white btn-info"><i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('admin.kenaikan-pangkat.edit', ['kenaikan_pangkat' => $item->id]) }}"
                                        class="btn text-white btn-warning"><i class="fas fa-pen "></i></a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                serverside :true,
                processing :true,
                ajax : "{{route('admin.kenaikan-pangkat.riwayat',['pegawai' => $pegawai->id])}}",
                columns : [
                    {
                        data:"DT_RowIndex",
                        name:"DT_RowIndex",
                    },
                    {
                        data:"pangkat_golongan",
                        name:"pangkat_golongan",
                    },
                    {
                        data:"jabatan",
                        name:"jabatan",
                    },
                    {
                        data:"tmt_pangkat_dari",
                        name:"tmt_pangkat_dari",
                    },
                    {
                        data:"no_sk",
                        name:"no_sk",
                    },
                    {
                        data:"tanggal_sk",
                        name:"tanggal_sk",
                    },
                    {
                        data:"aksi",
                        name:"aksi",
                    },
                ]
            })
        })
    </script>
@endpush
