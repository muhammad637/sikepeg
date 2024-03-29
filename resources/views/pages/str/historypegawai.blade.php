@extends('mainpegawai')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">STR</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <h3 class="pt-2 pl-5" style="color:black;font-weight:bold;">History STR {{ $pegawai->nama_lengkap }}</h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            {{-- <th scope="col">Nama</th> --}}
                            {{-- <th scope="col">No Registrasi</th>
                            <th scope="col">Kompetensi</th> --}}
                            <th scope="col">Nomor Surat</th>
                            <th scope="col">Tanggal Terbit</th>
                            <th scope="col">Masa Berakhir</th>
                            
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai->str as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td></td> --}}
                                {{-- <td>16 02 5 2 2 23-4767590 </td> --}}
                                {{-- <td>Ahli Madya Kebidanan</td> --}}
                                <td>{{ $item->no_str }}</td>
                                <td>{{ $item->tanggal_terbit_str }}</td>
                                <td>Seumur Hidup</td>
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
        $(document).ready(function() {
            $('#dataTable').DataTable(); 
        })
    </script>
@endpush
