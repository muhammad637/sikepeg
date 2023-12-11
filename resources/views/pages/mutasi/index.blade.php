@extends('main', ['title' => 'Mutasi'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Mutasi</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Mutasi Pegawai</h4>
                <a href="{{ route('admin.mutasi.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Tambah <i
                        class="fas fa-plus-square ml-1"></i></a>
                <a href="#export-semua-jabatan" class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-1"
                    data-toggle="modal">Export Excel</a>
                {{-- modal export --}}
                <div class="modal fade" role="dialog" id="export-semua-jabatan">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Export Rekap Promosi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.jabatan.export-semua-jabatan') }}" method="get">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="pilih-tahun">Pilih Tahun</label>
                                        <select name="year" id="pilih-tahun" class="form-control">
                                            <option value="">Semua Tahun</option>
                                            @for ($year = date('Y'); $year >= 2000; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pilih-tahun" class="d-block">Pilih Ruangan Tujuan (Baru)</label>
                                        <select name="ruangan_tujuan" id="select-ruangan" class="form-control w-100"
                                            style="width: 100%">
                                            <option value="">Semua Ruangan</option>
                                            @foreach ($ruangans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pilih-tahun">Pilih Tipe</label>
                                        <select name="type" id="pilih-tahun" class="form-control">
                                            <option value="">Semua tipe</option>
                                            <option value="promosi" selected>Promosi</option>
                                            <option value="demosi">Demosi</option>
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
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Mutasi</th>
                            <th scope="col">Tanggal Berlaku</th>
                            <th scope="col">Ruangan Awal</th>
                            <th scope="col">Ruangan Tujuan</th>
                            <th scope="col">Instansi Awal</th>
                            <th scope="col">Instansi Tujuan</th>
                            <th scope="col">No SK</th>
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
@endsection
@push('script')
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.mutasi.index') }}",
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
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                    },
                ]
            })
        })
    </script>
@endpush
