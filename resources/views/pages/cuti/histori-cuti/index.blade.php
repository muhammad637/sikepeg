@extends('main', ['title' => 'History Cuti'])
@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
@endpush
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Cuti</h1>

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Histori Cuti Pegawai</h4>
                <div class="dropdown mt-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export Excel
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('admin.cuti.histori-cuti.export-all') }}">Semua</a>
                        <a class="dropdown-item" href="#export-perTahun" data-toggle="modal">Pertahun</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="export-perTahun">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Tahun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.cuti.histori-cuti.export-year') }}" method="get">
                        @csrf
                        <div class="modal-body">
                            <select name="year" id="" class="form-control">
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h2 class="" style="color:rgb(53, 45, 45);font-weight:bold;">Filter Cuti</h2>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <label for="filter-statusTipe" class="font-weight-bold">Pegawai</label>
                    <select name="status_tipe" id="filter-pegawai" class="form-control filter">
                        <option value="">Pilih Pegawai</option>
                        @foreach ($pegawai as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
               
                <div class="col-sm-12 col-md-4">
                    <label for="filter-tahun" class="font-weight-bold">Tahun</label>
                    <select id="filter-tahun" class="form-control filter">
                        <option value="">Pilih Tahun</option>
                        @for ($year = date('Y'); $year >= 2000; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="filter-jenisCuti" class="font-weight-bold">Jenis Cuti</label>
                    <select id="filter-jenisCuti" class="form-control filter">
                        <option value="">Pilih Jenis Cuti</option>
                        <option value="cuti tahunan">Cuti Tahunan</option>
                        <option value="cuti besar">Cuti Besar</option>
                        <option value="cuti melahirkan">Cuti Melahirkan</option>
                        <option value="cuti sakit">Cuti Sakit</option>
                        <option value="cuti alasan penting">Cuti Alasan Penting</option>
                        
                    </select>
                </div>

            </div>
            <hr>
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
                            <th scope="col">Jumlah hari</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script>
        $('#dataTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{ route('admin.cuti.histori-cuti.index') }}",
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
                    data: 'jumlah_hari',
                    name: 'jumlah_hari',
                },
                {
                    data: 'sisa_cuti_tahunan',
                    name: 'sisa_cuti_tahunan',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                },
            ]
        })
        console.log('testing')
    </script> --}}
    <script>
        $('#filter-pegawai').select2()
        $(document).ready(function() {
            let pegawai = $('#filter-pegawai').val()
            let tahun = $('#filter-tahun').val()
            let jenis_cuti = $('#filter-jenisCuti').val()
            const table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{ route('admin.cuti.histori-cuti.index') }}",
                    type : "GET",
                    data : function(d){
                        d.pegawai = pegawai;
                        d.tahun = tahun;
                        d.jenis_cuti = jenis_cuti;
                        return d;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai',

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
                        data: 'jumlah_hari',
                        name: 'jumlah_hari',
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
            $('.filter').on('change', function() {
                pegawai = $('#filter-pegawai').val()
                tahun = $('#filter-tahun').val()
                jenis_cuti = $('#filter-jenisCuti').val()
                console.log([pegawai,tahun,jenis_cuti])
                table.ajax.reload(null, false)
            })
        })
    </script>
@endpush
