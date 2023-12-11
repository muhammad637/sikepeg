@extends('main', ['title' => 'Diklat'])
@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #ruangan {
            z-index: 999999;
            width: 100% !important;
        }
    </style>
@endpush
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Diklat</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Diklat Pegawai</h4>
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.diklat.create') }}"
                        class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-2">Tambah <i
                            class="fas fa-plus-square ml-1"></i></a>
                    <div class="dropdown mt-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Export Excel
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('admin.diklat.export-all')}}">Semua</a>
                            <a class="dropdown-item" href="#export-perTahun" data-toggle="modal">Pertahun</a>
                            <a class="dropdown-item" href="#export-rentangTahun" data-toggle="modal">Rentang Tahun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h2 class="" style="color:rgb(53, 45, 45);font-weight:bold;">Filter Diklat </h2>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <label for="filter-statusTipe" class="font-weight-bold">Nama Diklat</label>
                    <select name="nama_diklat" id="filter-statusTipe" class="form-control filter">
                        <option value="">Pilih Nama Diklat</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="filter-ruangan" class="font-weight-bold">Ruangan</label>
                    <select  id="filter-ruangan" class="form-control filter">
                        <option value="">Pilih Ruangan</option>
                        @foreach ($ruangans as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="filter-jenisTenaga" class="font-weight-bold">Jenis Tenaga</label>
                    <select name="jenis_tenaga" id="filter-jenisTenaga" class="form-control filter">
                        <option value="">Pilih Jenis Tenaga</option>
                        <option value="struktural">Struktural</option>
                        <option value="nakes">Tenaga Kesehatan</option>
                        <option value="umum">Umum</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">NO</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Nama Diklat</th>
                            <th scope="col">Nama Ruangan</th>
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
        <div class="modal fade" tabindex="-1" role="dialog" id="export-perTahun">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Tahun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin.diklat.export-year')}}" method="get">
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
        <div class="modal fade" tabindex="-1" role="dialog" id="export-rentangTahun">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Rentang Tahun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin.diklat.export-range')}}" method="get">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="yearAwal" id="yearAwal" class="form-control">
                                        @for ($year = date('Y'); $year >= 2000; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="yearAkhir" id="yearAkhir" class="form-control">
                                        @for ($year = date('Y'); $year >= 2000; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
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
            ajax: "{{ route('admin.diklat.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_diklat',
                    name: 'nama_diklat'
                },
                {
                    data: 'penyelenggara',
                    name: 'penyelenggara'
                },
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'no_sertifikat',
                    name: 'no_sertifikat'
                },
                {
                    data: 'surat',
                    name: 'surat'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ],
        })
    </script> --}}
      <script>
        $(document).ready(function() {
            $('#ruangan').select2()
            $('#pegawai').select2()
            $('#select-pegawai').select2()
            let pegawai = $('#pegawai').val()
            let ruangan = $('#ruangan').val()
            let tahun = $('#tahun').val()
            const table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ route('admin.jabatan.demosi.index') }}",
                ajax: {
                    url: "{{ route('admin.diklat.index') }}",
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
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_diklat',
                    name: 'nama_diklat'
                },
                {
                    data: 'nama_ruangan',
                    name: 'nama_ruangan'
                },
                {
                    data: 'penyelenggara',
                    name: 'penyelenggara'
                },
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'no_sertifikat',
                    name: 'no_sertifikat'
                },
                {
                    data: 'surat',
                    name: 'surat'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ],
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
