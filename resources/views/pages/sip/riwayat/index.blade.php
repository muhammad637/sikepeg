@extends('main', ['title' => 'History SIP'])

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <h4 class="pt-2 mt-2 pl-3" style="color:black;font-weight:bold;">History SIP
            {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}</h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            <th scope="col">No SIP</th>
                            <th scope="col">No STR</th>
                            <th scope="col">No Rekomendasi</th>
                            <th scope="col">Tanggal berakhir SIP</th>
                            <th scope="col">Masa Terbit</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($sip as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_sip }}</td>
                                <td>{{ $item->no_str }}</td>
                                <td>{{ $item->no_rekomendasi }}</td>
                                <td>{{ $item->masa_berakhir_sip }}</td>
                                <td>
                                    <button
                                        class="btn rounded-3 py-0 {{ $item->masa_berakhir_sip > now() ? 'btn-success' : 'btn-secondary' }}">{{ $item->masa_berakhir_sip > now() ? 'active' : 'expired' }}</button>
                                </td>
                                <td>
                                    <a href="{{ route('admin.sip.show', ['sip' => $item->id]) }}" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ $item->link_sip }}" class="btn btn-success" target="_blank">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    <a href="{{ route('admin.sip.edit', ['sip' => $item->id]) }}" class="btn btn-warning">
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
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.sip.riwayat', ['pegawai' => $pegawai->id]) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },

                {
                    data: 'no_sip',
                    name: 'no_sip',
                },
                {
                    data: 'no_str',
                    name: 'no_str',
                },
                {
                    data: 'no_rekomendasi' ?? '-',
                    name: 'no_rekomendasi',

                },
                {
                    data: 'masa-berakhir-sip',
                    name: 'masa-berakhir-sip',

                },
                {
                    data: 'status',
                    name: 'status',

                },
                {
                    data: 'aksi',
                    name: 'aksi',

                },
            ],
        })
    </script>
@endpush
