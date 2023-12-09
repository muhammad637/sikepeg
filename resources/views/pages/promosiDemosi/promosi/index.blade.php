@extends('main', ['title' => 'Data Demosi'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Promosi</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Promosi Aktif Pegawai</h4>
                <a href="{{ route('admin.jabatan.promosi.create') }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Tambah <i class="fas fa-plus-square ml-1"></i></a>

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
                            <th scope="col">Ruangan</th>
                            <th scope="col">Jabatan Sebelumnya</th>
                            <th scope="col">Jabatan Baru</th>
                            <th scope="col">tanggalSK</th>
                            <th scope="col">Status</th>
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
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.jabatan.promosi.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },

                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap',

                },
                {
                    data: 'ruangan',
                    name: 'ruangan',

                },
                {
                    data: 'jabatan_sebelumnya',
                    name: 'jabatan_sebelumnya',

                },
                {
                    data: 'jabatan_selanjutnya',
                    name: 'jabatan_selanjutnya',

                },
                {
                    data: 'tanggal_sk',
                    name: 'tanggal_sk',

                },


                {
                    data: 'status_tombol',
                    name: 'status_tombol',
                   
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    searchable: false,
                    orderable: false,

                },


            ]
        })
    </script>
@endpush
