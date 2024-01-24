@extends('main', ['title' => 'Notifikasi'])

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Notifikasi</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <div class="d-md-flex justify-content-between s-sm-block">
                <h4 class="m-0 font-weight-bold text-dark">Notifikasi {{auth()->user()->name}}</h4>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            <th scope="col">Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifikasis as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <div class=" d-flex align-items-center">
                                            <div class="mr-3">
                                                <div class="icon-circle {{ $item->status }}">
                                                    <i class="{{ $item->icon }} text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">{{ $item->pesan }}</span>
                                            </div>
                                        </div>
                                        <span class="small text-gray-500 ml-5">q
                                            {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, j F Y') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
        $(document).ready(function(){
            $('#dataTable').DataTable()
        })
    </script>
@endpush
