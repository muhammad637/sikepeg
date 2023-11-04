@extends('main', ['title'=>'Kenaikan Pangkat'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Kenaikan Pangkat</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Kenaikan Pangkat Pegawai</h4>
                <a href="{{ route('admin.kenaikan-pangkat.create') }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Create <i class="fas fa-plus-square ml-1"></i></a>
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
                            <th scope="col">Ruangan</th>
                            <th scope="col">Pangkat</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">No SK</th>
                            <th scope="col">Penerbit SK</th>
                            <th scope="col">SK</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $index => $item)
                            @if (count($item->kenaikanpangkat) > 0)
                                @php
                                    $data = explode('view', $item->kenaikanpangkat[0]->link_sk);
                                    $i++;
                                @endphp

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->nama_lengkap ?? $item->nama_depan }}</td>
                                    <td>{{ $item->ruangan->nama_ruangan }}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->pangkat->nama_pangkat  ?? '-'}}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->golongan->nama_golongan }}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->no_sk }}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->penerbit_sk }}</td>
                                    <td>
                                        <a target="popup"
                                            onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                            class="badge bg-primary p-2" style="cursor: pointer">
                                            <i class="fas fa-file-alt text-white"></i></a> 
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kenaikan-pangkat.show', ['kenaikan_pangkat' => $item->kenaikanpangkat[0]->id]) }}"
                                            class="badge p-2 text-white bg-info"><i class="fas fa-info-circle"></i></a>
                                        <a href="{{ route('admin.kenaikan-pangkat.edit', ['kenaikan_pangkat' => $item->kenaikanpangkat[0]->id]) }}"
                                            class="badge p-2 text-white bg-warning"><i class="fas fa-pen "></i></a>
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
@push('script')
    <script src="{{asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
 <script>
    $(document).ready(function(){
        $('#dataTable').DataTable()
    })
 </script>
@endpush
