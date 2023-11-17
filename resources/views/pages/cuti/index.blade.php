@extends('main', ['title' => 'Data Cuti'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Cuti</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Cuti Pegawai : {{$pegawai->nama_lengkap ?? $pegawai->nama_depan}}</h4>
                <h4>Sisa Cuti Tahunan : {{$pegawai->sisa_cuti_tahunan}}</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            {{-- <th scope="col">Nama</th> --}}
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
            ajax: "{{ route('admin.cuti.riwayat-cuti-pegawai',['id' => $id] )}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
               
                {
                    data: 'jenis_cuti',
                    name: 'jenis_cuti',

                },
                {
                    data: 'alasan_cuti',
                    name: 'alasan_cuti',

                },
                {
                    data: 'mulai_cuti',
                    name: 'mulai_cuti',

                },
                {
                    data: 'selesai_cuti',
                    name: 'selesai_cuti',

                },

                {
                    data: 'surat',
                    name: 'surat',
                    searchable: false,
                    orderable: false,
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
