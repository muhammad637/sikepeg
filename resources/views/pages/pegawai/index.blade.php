@extends('main', ['title' => 'Personal File'])
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
                    <a href="{{ route('admin.pegawai.index') }}"
                        class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Tampilkan
                        <i class="fas fa-globe"></i></a>
                    <!-- Example single danger button -->
                    <div class="btn-group mt-md-2 mt-sm-0">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#filterJenisKelamin" data-toggle="modal">Jenis Kelamin</a>
                            <a class="dropdown-item" href="#filterStatusPegawai" data-toggle="modal">Status Pegawai</a>
                            <a class="dropdown-item" href="#filterStatusTenaga" data-toggle="modal">Status Tenaga</a>
                            <a class="dropdown-item" href="#filterStatusTipe" data-toggle="modal">Status Tipe</a>
                            <a class="dropdown-item" href="#filterJenisTenaga" data-toggle="modal">Jenis Tenaga</a>
                            <a class="dropdown-item" href="#filterRuangan" data-toggle="modal">Ruangan</a>
                        </div>
                    </div>
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
                        {{-- @foreach ($pegawai as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nip_nippk }}</td>
                                <td>{{ $item->gelar_depan }} {{ $item->nama_depan }} {{ $item->nama_belakang }}
                                    ,{{ $item->gelar_belakang }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td> <span class="text-uppercase">{{ $item->ruangan ? $item->ruangan->nama_ruangan : '' }}</span></td>
                                <td>
                                    <button
                                        class="badge p-2 text-white bg-{{ $item->status_pegawai == 'aktif' ? 'success' : 'secondary' }} border-0">{{ $item->status_pegawai }} </button>
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.pegawai.show', ['pegawai' => $item->id]) }}"
                                        class="badge p-2 text-white bg-info mr-1"><i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('admin.pegawai.edit', ['pegawai' => $item->id]) }}"
                                        class="badge p-2 text-white bg-warning"><i class="fas fa-pen "></i></a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- modal filter --}}
    {{-- filter menurut jenis kelamin --}}
    <div class="modal fade" id="filterJenisKelamin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.pegawai.filter.jenisKelamin') }}" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pilih Jenis Kelamin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="jenis_kelamin" id="" class="form-control">
                            <option value="">Pilih</option>
                            <option value="laki-laki">Laki - Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- filter menurut status tenaga --}}
    <div class="modal fade" id="filterStatusTenaga" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.pegawai.filter.statusTenaga') }}" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pilih Status Tenaga</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="status_tenaga" id="" class="form-control">
                            <option value="">Pilih</option>
                            <option value="asn">ASN</option>
                            <option value="non asn">NON ASN</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- filter menurut tipe status --}}
    <div class="modal fade" id="filterStatusTipe" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.pegawai.filter.statusTipe') }}" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pilih Status Tipe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="status_tipe" id="" class="form-control">
                            <option value="">Pilih</option>
                            <option value="pns">PNS</option>
                            <option value="pppk">PPPK</option>
                            <option value="thl">THL</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="cubmit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- filter menurut jenis tenga --}}
    <div class="modal fade" id="filterJenisTenaga" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.pegawai.filter.jenisTenaga') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pilih Jenis Tenaga</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="jenis_tenaga" id="" class="form-control">
                            <option value="">Pilih</option>
                            <option value="umum">Umum / Administrasi</option>
                            <option value="nakes">Fungsional / Tenaga Kesehatan</option>
                            <option value="struktural">Struktural / Jabatan Pimpinan Tinggi</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- filter menurut status pegawai --}}
    <div class="modal fade" id="filterStatusPegawai" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.pegawai.filter.statuspegawai') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pilih Status Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="status_pegawai" id="" class="form-control">
                            <option value="">Pilih</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filterRuangan" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.pegawai.filter.statusTipe') }}" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pilih Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="nama_ruangan" id="" class="form-control">
                        <option value="">Pilih</option>
                        <option value="{{$ruangan->nama_ruangan}}"></option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="cubmit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
            ajax: "{{ Request::routeIs('admin.pegawai.index') ? route('admin.pegawai.index') : (Request::route('admin.pegawai.filter.jenisKelamin') ? route('admin.pegawai.filter.jenisKelamin') : (Request::route('admin.pegawai.filter.statuspegawai') ? route('admin.pegawai.filter.statuspegawai') : (Request::route('admin.pegawai.statusTenaga') ? route('admin.pegawai.statusTenaga') : (Request::route('admin.pegawai.statusTipe') ? route('admin.pegawai.statusTipe') : (Request::route('admin.pegawai.jenisTenaga') ? route('admin.pegawai.jenisTenaga') : null))))) }}",
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

                },
                {
                    data: 'status_pegawai',
                    name: 'status_pegawai',
                    searchable: false,
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
    </script>
@endpush
