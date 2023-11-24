@extends('main', ['title' => 'Diklat'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Diklat</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Diklat Pegawai</h4>
                <a href="{{ route('admin.diklat.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Tambah <i
                        class="fas fa-plus-square ml-1"></i></a>
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
                            <th scope="col">Nama Diklat</th>
                            <th scope="col">Penyelenggara</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Nomer Sertifikat</th>
                            <th scope="col">Sertifikat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
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
        $('#dataTable').DataTable({
            serverSide:true,
            processing:true,
            ajax : "{{route('admin.diklat.index')}}",
            columns : [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable : false,
                    orderable: false,
                },
                {
                    data:'nama',
                    name:'nama'
                },
                {
                    data:'nama_diklat',
                    name:'nama_diklat'
                },
                {
                    data:'penyelenggara',
                    name:'penyelenggara'
                },
                {
                    data:'tahun',
                    name:'tahun'
                },
                {
                    data:'no_sertifikat',
                    name:'no_sertifikat'
                },
                {
                    data:'surat',
                    name:'surat'
                },
                {
                    data:'aksi',
                    name:'aksi'
                },
            ],
        })
    </script>
@endpush
