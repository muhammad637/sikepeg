@extends('main', ['title' => 'Diklat'])
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
    <script>
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
    </script>
@endpush
