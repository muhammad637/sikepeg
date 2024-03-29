@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Mutasi</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <h4 class="pt-2 mt-2 pl-5" style="color:black;font-weight:bold;">History mutasi
            {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}</h4>
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
                        {{-- @foreach ($mutasi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pegawai->nama_depan }}</td>
                                <td>{{ $item->tanggal_berlaku }}</td>
                                <td>{{ $item->jenis_mutasi }}</td>
                                <td>{{ $item->ruanganAwal->nama_ruangan ?? '-' }}</td>
                                <td>{{ $item->ruanganTujuan->nama_ruangan ?? '-' }}</td>
                                <td>{{ $item->instansi_awal ?? '-' }}</td>
                                <td>{{ $item->instansi_tujuan ?? '-' }}</td>
                                <td>{{ $item->no_sk }}</td>
                                
                                <td>
                                    <a target="popup"
                                        onclick="window.open(`{{ $item->link_sk }}`,'name','width=600,height=400')"
                                        class="btn btn-primary" style="cursor: pointer">
                                        <i class="fas fa-file-alt text-white"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.mutasi.show', ['mutasi' => $item->id]) }}"
                                        class="btn btn-info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('admin.mutasi.edit', ['mutasi' => $item->id]) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- tabel End -->
    <!-- /.container-fluid -->
@endsection
@push('script')
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.mutasi.history',['pegawai' => $pegawai->id]) }}",
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
