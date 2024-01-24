@extends('main', ['title' => 'Golongan Master Data'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Master Data</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Daftar Golongan</h4>
                <a href="{{ route('admin.master-data.golongan.create') }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize">create <i class="fas fa-plus-square ml-1"></i></a>

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
                            <th scope="col">Nama Golongan</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($golongan as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }} </td>
                                <td>{{ $item->nama_golongan }} </td>
                                <td>{{ $item->jenis }} </td>
                                <td class="">
                                    <a href="{{ route('admin.master-data.golongan.edit', ['golongan' => $item->id]) }}"
                                        class="badge p-2 text-white bg-warning"><i class="fas fa-pen "></i></a>
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
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            const table = $('#dataTable').DataTable()
        })
    </script>
@endpush
