@extends('main', ['title' => 'Kenaikan Pangkat'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Kenaikan Pangkat</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Kenaikan Pangkat Pegawai</h4>
                <div class="d-flex">
                    <a href="{{ route('admin.kenaikan-pangkat.create') }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-1">Tambah <i class="fas fa-plus-square ml-1"></i></a>
                <a href="#export-semua-jabatan" class="btn btn-primary mt-0 mt-sm-2 text-capitalize mr-1"
                        data-toggle="modal">Export Excel</a>
                </div>
                <div class="modal fade" role="dialog" id="export-semua-jabatan">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Export Rekap Kenaikan Pangkat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.kenaikan-pangkat.export-excel') }}" method="get">
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
                                        <label for="pilih-tahun" class="d-block">Pilih Ruangan</label>
                                        <select name="nama_ruangan" id="select-ruangan" class="form-control w-100"
                                            style="width: 100%">
                                            <option value="">Semua Ruangan</option>
                                            @foreach ($ruangans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pilih-tahun">Pilih Status Pegawai</label>
                                        <select name="status_tipe" id="pilih-tahun" class="form-control">
                                            <option value="">Semua Status Pegawai</option>
                                            <option value="pns">Pegawai PNS</option>
                                            <option value="pppk">Pegawai PPPK</option>
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
                <h2 class="" style="color:rgb(53, 45, 45);font-weight:bold;">Filter Kenaikan Pangkat </h2>
                <div class="row align-items-end">
                    <div class="col-sm-12 col-md-4">
                        <label for="filter-statusTipe" class="font-weight-bold">Status Pegawai</label>
                        <select name="status_tipe" id="status_tipe" class="form-control filter">
                            <option value="">Semua Pegawai</option>
                            <option value="pns">Pegawai PNS</option>
                            <option value="pppk">Pegawai PPPK</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="filter-statusTipe" class="font-weight-bold">Ruangan</label>
                        <select name="ruangan" id="ruangan" class="form-control filter">
                            <option value="">Semua Ruangan</option>
                            @foreach ($ruangans as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="tahun" class="font-weight-bold">Tahun SK</label>
                        <select name="tahun" id="tahun" class="form-control filter">
                            <option value="">Pilih Tahun</option>
                            @for ($date = $data ; $date >= 2000; $date--)
                                <option value="{{ $date }}">{{ $date }}</option>
                            @endfor

                        </select>
                    </div>
                </div>
                <hr>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Nama Ruangan</th>
                            <th scope="col">Pangkat</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">No SK</th>
                            <th scope="col">Tanggal Mulai Terhitung</th>
                            <th scope="col">Penerbit SK</th>
                            <th scope="col">status</th>
                            <th scope="col">SK</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($pegawai as $index => $item)
                            @if (count($item->kenaikanpangkat) > 0)
                                @php
                                    $data = explode('view', $item->kenaikanpangkat[0]->link_sk);
                                    $i++;
                                @endphp

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->nama_lengkap ?? $item->nama_depan }}</td>
                                    <td>{{ $item->ruangan->nama_ruangan }}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->pangkat->nama_pangkat  ?? '-'}}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->golongan->nama_golongan }}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->no_sk }}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->tmt_pangkat_dari}}</td>
                                    <td>{{ $item->kenaikanpangkat[0]->penerbit_sk }}</td>
                                    <td>
                                        <a target="popup"
                                            onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                            class="btn btn-primary" style="cursor: pointer">
                                            <i class="fas fa-file-alt text-white"></i></a> 
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kenaikan-pangkat.show', ['kenaikan_pangkat' => $item->kenaikanpangkat[0]->id]) }}"
                                            class="btn  text-white btn-info"><i class="fas fa-info-circle"></i></a>
                                        <a href="{{ route('admin.kenaikan-pangkat.edit', ['kenaikan_pangkat' => $item->kenaikanpangkat[0]->id]) }}"
                                            class="btn  text-white btn-warning"><i class="fas fa-pen "></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach --}}
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
            let status_tipe = $('#status_tipe').val()
            let ruangan = $('#ruangan').val();
            let tahun = $('#tahun').val();
            const table = $('#dataTable').DataTable({
                serverside: true,
                processing: true,
                ajax: {
                    url: "{{ route('admin.kenaikan-pangkat.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.status_tipe = status_tipe;
                        d.ruangan = ruangan;
                        d.tahun = tahun;
                        return d;
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                    },

                    {
                        data: "nama_lengkap",
                        name: "nama_lengkap",
                    },
                    {
                        data: "ruangan",
                        name: "ruangan",
                    },
                    {
                        data: "pangkat",
                        name: "pangkat",
                    },
                    {
                        data: "golongan",
                        name: "golongan",
                    },
                    {
                        data: "no_sk",
                        name: "no_sk",
                    },
                    {
                        data: "tmt",
                        name: "tmt",
                    },
                    {
                        data: "penerbit_sk",
                        name: "penerbit_sk",
                    },
                    {
                        data: "status",
                        name: "status",
                    },
                    {
                        data: "sk",
                        name: "sk",
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                    },

                ]
            })
            $('.filter').on('change', function() {
                status_tipe = $('#status_tipe').val()
                ruangan = $('#ruangan').val();
                tahun = $('#tahun').val();
                table.ajax.reload(null, false)
            })
        })
    </script>
@endpush
