@extends('main', ['title' => 'Cuti Pegawai Master Data'])
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Master Data</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Data Cuti Pegawai</h4>
                <form action="{{ route('admin.master-data.cuti-pegawai.update') }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                {{-- <a href="{{ route('admin.master-data.cuti-pegawa') }}"
                    class="btn btn-primary mt-0 mt-sm-2 text-capitalize">update <i class="fas fa-plus-square ml-1"></i></a> --}}

            </div>
        </div>
        <div class="card-body">

            {{-- @if (session()->has('success'))
                {{ session()->get('success') }}
            @endif --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Sisa Cuti Tahun</th>
                            <th scope="col">Tahun</th>
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
                serverside: true,
                processing: true,
                ajax: "{{ route('admin.master-data.cuti-pegawai.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'sisa_cuti_tahunan',
                        name: 'sisa_cuti_tahunan'
                    },
                    {
                        data: 'tahun_cuti',
                        name: 'tahun_cuti'
                    },
                ]
            })
        })
    </script>
@endpush
