@extends('main', ['title' => 'Dashboard'])

@section('content')
    <h1 class="" style="color:626262;font-weight:bold;margin:2rem 0 2rem;">Dashboard / Reminder SIP</h1>
    <!-- Page Heading -->
    <!-- data table -->
    <div class="card shadow-sm mb-1">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover text-center text capitalize w-100">
                    <thead style="background-color: #2d7430; color: white;">
                        <tr>
                            <th>no</th>
                            <th>nama</th>
                            <th>Masa Berakhir SIP</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="text-right mt-4">
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-warning px-5">kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end data table -->
@endsection
@push('script')
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.reminder.sip.index') }}",
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
                    data: 'masa_berakhir_sip',
                    name: 'masa_berakhir_sip',
                },
                {
                    data: 'pesan',
                    name: 'pesan',
                }
            ]
        });
    </script>
@endpush
