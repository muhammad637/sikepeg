@extends('main',['title'=>'History STR'])

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">STR</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <h4 class="pt-2 pl-5" style="color:black;font-weight:bold;">History STR {{ $pegawai->nama_lengkap }}</h4>
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
    <!-- tabel End -->
    <!-- /.container-fluid -->
@endsection
@push('script')
    <script src="{{asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
 <script>
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('admin.str.riwayat',['pegawai' => $pegawai->id])}}",
        columns : [
            {
            data:'DT_RowIndex',
            name:'DT_RowIndex',
            searchable:false,
            orderable:false
        },
           
            {
            data:'no_str',
            name:'no_str',
        },
        {
            data:'tanggal-terbit-str',
            name:'tanggal-terbit-str',
           
        },
        {
            data:'masa-berakhir-str',
            name:'masa-berakhir-str',
           
        },
            {
            data:'status',
            name:'status',
          
        }, 
            {
            data:'aksi',
            name:'aksi',
            
        },
    ],
    })
 </script>
@endpush