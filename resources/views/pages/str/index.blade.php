@extends('main', ['title' => 'STR'])

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">STR</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <div class="d-md-flex justify-content-between s-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data STR Pegawai</h4>
                <div class="d-flex">
                    <a href="{{ route('admin.str.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-2">
                        Tambah <i class="fas fa-plus-square ml-1"></i>
                    </a>
                    <a href="{{ route('admin.str.export') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">
                        Export Excel <i class="fa fa-download ml-1"></i>
                    </a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Ruangan</th>
                            <th scope="col">Masa Berakhir</th>
                            <th scope="col">Status</th>
                            <th scope="col">Surat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- tabel End -->
    <!-- /.container-fluid -->
@endsection
@push('script')
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.str.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'nama_lengkap' ?? 'nama_depan',
                    name: 'nama_lengkap',
                },
                {
                    data: 'jabatan',
                    name: 'jabatan',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'nama-ruangan',
                    name: 'nama-ruangan',
                },
                {
                    data: 'tanggal-berakhir-str',
                    name: 'tanggal-berakhir-str',

                },
                {
                    data: 'status',
                    name: 'status',

                },

                {
                    data: 'surat',
                    name: 'surat',

                },
                {
                    data: 'aksi',
                    name: 'aksi',

                },
            ],
        })
    </script>
@endpush
