@extends('main', ['title' => 'Data Demosi'])
@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Promosi</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Promosi Jabatan Pegawai</h4>
                <div class="d-flex">
                    <a href="{{ route('admin.jabatan.promosi.create') }}"
                        class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-1">Tambah <i
                            class="fas fa-plus-square ml-1"></i></a>
                    <a href="{{ route('admin.jabatan.promosi.create') }}"
                        class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Expport Excel <i
                            class="fas fa-plus-square ml-1"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h2 class="" style="color:rgb(53, 45, 45);font-weight:bold;">Filter Promosi </h2>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <label for="filter-statusTipe" class="font-weight-bold">Pegawai</label>
                    <select name="status_tipe" id="pegawai" class="form-control filter">
                        <option value="">Pilih Pegawai</option>
                        @foreach ($pegawais as $item)
                            <option value="{{$item->id}}">{{$item->nama_lengkap}} - {{$item->ruangan->nama_ruangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="filter-statusTipe" class="font-weight-bold">Ruangan</label>
                    <select name="status_tipe" id="ruangan" class="form-control filter">
                        <option value="">Pilih Ruangan</option>
                        @foreach ($ruangans as $item)
                            <option value="{{$item->id}}">{{$item->nama_ruangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="tahun" class="font-weight-bold">tahun</label>
                    <select name="tahun" id="tahun" class="form-control filter">
                        <option value="">Pilih Tahun</option>
                        @for ($date = date('Y'); $date >= 2000; $date--)
                            <option value="{{ $date }}">{{ $date }}</option>
                        @endfor

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#ruangan').select2()
            $('#pegawai').select2()
            let pegawai = $('#pegawai').val()
            let ruangan = $('#ruangan').val()
            let tahun = $('#tahun').val()
            const table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ route('admin.jabatan.promosi.index') }}",
                ajax: {
                    url: "{{ route('admin.jabatan.promosi.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.ruangan = ruangan;
                        d.pegawai = pegawai;
                        d.tahun = tahun;
                        return d
                    }
                },
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
            $('.filter').on('change', function() {
                pegawai = $('#pegawai').val()
                ruangan = $('#ruangan').val()
                tahun = $('#tahun').val()
                table.ajax.reload(null, false)
            })
        })
    </script>
@endpush
