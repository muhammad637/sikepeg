@extends('main', ['title' => 'Personal File'])
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
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Personal File </h1>
    {{-- <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Personal File</h1> --}}
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block align-items-center">
                <h4 class=" font-weight-bold text-dark">Daftar Pegawai {{ $heading ?? null }}</h4>

                {{-- <h2 class=" font-weight-bold text-dark"></h2> --}}
                <div class="mt-md-0 mt-sm-2">
                    <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Tambah
                        <i class="fas fa-plus-square ml-1"></i></a>
                    <a href="{{ route('admin.pegawai.index') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize"
                        data-toggle="modal" data-target="#importExcel">import<i class="fas fa-plus-square ml-1"></i></a>
                   
                </div>
            </div>
        </div>
        <!-- Import Excel -->
        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('admin.import_excel') }}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <label>Pilih file excel</label>
                            <div class="form-group">
                                <input type="file" name="file" required="required">
                            </div>
                            <div>
                                download template import pegawai
                                <div class="row">
                                    <div class="col-sm-12 col-md-4"><a
                                            href="{{ asset('download_template/template_ASN_PNS.xlsx') }}"
                                            class="btn btn-info w-100" download>PNS <i class="fas fa-file-export"></i></a>
                                    </div>
                                    <div class="col-sm-12 col-md-4"><a
                                            href="{{ asset('download_template/template_ASN_PPPK.xls') }}"
                                            class="btn btn-info w-100">PPPK <i class="fas fa-file-export"></i></a></div>
                                    <div class="col-sm-12 col-md-4"><a
                                            href="{{ asset('download_template/template_Non_ASN.xlsx') }}"
                                            class="btn btn-info w-100">THL <i class="fas fa-file-export"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <h2 class="" style="color:rgb(53, 45, 45);font-weight:bold;">Filter Pegawai </h2>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <label for="filter-statusTipe" class="font-weight-bold">Status Tipe</label>
                    <select name="status_tipe" id="filter-statusTipe" class="form-control filter">
                        <option value="">Pilih Status Tipe</option>
                        <option value="pns">PNS</option>
                        <option value="pppk">PPPK</option>
                        <option value="thl">THL</option>
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
                <table class="table table-striped table-bordered text-center " id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">NIP/NIPPK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Ruangan</th>
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
        $(document).ready(function() {
             let status_tipe = $('#filter-statusTipe').val()
                let jenis_tenaga = $('#filter-jenisTenaga').val()
                let ruangan = $('#filter-ruangan').val()
            const table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{ route('admin.pegawai.index') }}",
                    type : 'GET',
                    data : function(d){
                        d.ruangan = ruangan;
                        d.jenis_tenaga = jenis_tenaga;
                        d.status_tipe = status_tipe;
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
                        data: 'nip_nippk',
                        name: 'nip_nippk',

                    },
                    {
                        data: 'nama_lengkap' ?? 'nama_depan',
                        name: 'nama_lengkap',

                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',

                    },
                    {
                        data: 'ruangan',
                        name: 'ruangan',
                        orderable: false,
                    },
                    {
                        data: 'status_pegawai',
                        name: 'status_pegawai',
                        orderable: false,
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                    },


                ]
            })
            $('#filter-ruangan').select2({
                height: '30px'
            })
            $('.filter').on('change', function() {
                 status_tipe = $('#filter-statusTipe').val()
                 jenis_tenaga = $('#filter-jenisTenaga').val()
                ruangan = $('#filter-ruangan').val()
                console.log([status_tipe,jenis_tenaga,ruangan])
                table.ajax.reload(null, false)
            })
        })
    </script>
@endpush
