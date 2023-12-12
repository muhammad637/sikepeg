@extends('main', ['title' => 'Mutasi'])
@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Mutasi</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Mutasi Pegawai</h4>
                <div class="d-flex">
                    <a href="{{ route('admin.mutasi.create') }}"
                        class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-1">Tambah <i
                            class="fas fa-plus-square ml-1"></i></a>
                    <a href="#export-semua-jabatan" class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-1"
                        data-toggle="modal">Export Excel</a>
                </div>
                {{-- modal export --}}
                <div class="modal fade" role="dialog" id="export-semua-jabatan">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Export Rekap Mutasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.mutasi.export-excel') }}" method="get">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="pilih-tahun">Pilih Tahun</label>
                                        <select name="tahun" id="pilih-tahun" class="form-control">
                                            <option value="">Semua Tahun</option>
                                            @for ($year = date('Y'); $year >= 2000; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pilih-tahun" class="d-block">Pilih Ruangan Sebelumnya (Lama)</label>
                                        <select name="ruangan_awal" id="select-ruangan" class="form-control w-100"
                                            style="width: 100%">
                                            <option value="">Semua Ruangan</option>
                                            @foreach ($ruangans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pilih-tahun" class="d-block">Pilih Ruangan Tujuan (Baru)</label>
                                        <select name="ruangan_tujuan" id="select-ruangan" class="form-control w-100"
                                            style="width: 100%">
                                            <option value="">Semua Ruangan</option>
                                            @foreach ($ruangans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pilih-tahun">Pilih Jenis Mutasi</label>
                                        <select name="jenis_mutasi" id="pilih-tahun" class="form-control">
                                            <option value="">Semua Jenis Mutasi</option>
                                            <option value="internal" selected>Internal</option>
                                            <option value="eksternal">Eksternal</option>
                                        </select>
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
        </div>

        <div class="card-body">
            <div>
                <h2 class="" style="color:rgb(53, 45, 45);font-weight:bold;">Filter Mutasi </h2>
                <div class="row align-items-end">
                    <div class="col-sm-12 col-md-4">
                        <label for="filter-statusTipe" class="font-weight-bold">Jenis Mutasi</label>
                        <select name="status_tipe" id="jenis_mutasi" class="form-control filter">
                            <option value="">Semua Jenis</option>
                            <option value="internal">Internal</option>
                            <option value="eksternal">Eksternal</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="filter-statusTipe" class="font-weight-bold">Ruangan</label>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <span class="text-info">sebelumnya</span>
                                <select name="status_tipe" id="ruangan_awal" class="form-control filter">
                                    <option value="">Semua Ruangan</option>
                                    @foreach ($ruangans as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <span class="text-info">Baru</span>
                                <select name="status_tipe" id="ruangan_tujuan" class="form-control filter">
                                    <option value="">Semua Ruangan</option>
                                    @foreach ($ruangans as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable"
                    width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Mutasi</th>
                            <th scope="col">Tanggal Berlaku</th>
                            <th scope="col">Ruangan Sebelumnya</th>
                            <th scope="col">Ruangan Baru</th>
                            <th scope="col">Instansi Awal</th>
                            <th scope="col">Instansi Tujuan</th>
                            <th scope="col">No SK</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // $('#jenis_mutasi').select2()
            // $('#tahun').select2()
            // $('#ruangan_awal').select2()
            // $('#ruangan_tujuan').select2()
            let jenis_mutasi = $('#jenis_mutasi').val()
            let tahun = $('#tahun').val()
            let ruangan_awal = $('#ruangan_awal').val()
            let ruangan_tujuan = $('#ruangan_tujuan').val()
            const table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.mutasi.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.ruangan_awal = ruangan_awal
                        d.ruangan_tujuan = ruangan_tujuan
                        d.jenis_mutasi = jenis_mutasi
                        d.tahun = tahun
                        return d
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'jenis-mutasi',
                        name: 'jenis-mutasi',
                    },
                    {
                        data: 'tanggal-berlaku',
                        name: 'tanggal-berlaku',
                    },
                    {
                        data: 'ruangan-awal',
                        name: 'ruangan-awal',
                    },
                    {
                        data: 'ruangan-tujuan',
                        name: 'ruangan-tujuan',
                    },
                    {
                        data: 'instansi-awal',
                        name: 'instansi-awal',
                    },
                    {
                        data: 'instansi-tujuan',
                        name: 'instansi-tujuan',
                    },
                    {
                        data: 'no-sk',
                        name: 'no-sk',

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
            $('.filter').on('change', function() {
                 jenis_mutasi = $('#jenis_mutasi').val()
                 tahun = $('#tahun').val()
                 ruangan_awal = $('#ruangan_awal').val()
                 ruangan_tujuan = $('#ruangan_tujuan').val()
                // console.log(filter)
                console.log([jenis_mutasi, tahun, ruangan_awal, ruangan_tujuan])
                table.ajax.reload(null, false)
            })
        })
    </script>
@endpush
