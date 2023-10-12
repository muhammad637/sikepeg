@extends('mainpegawai')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <h3 class="pt-2 mt-2 pl-5" style="color:black;font-weight:bold;">History SIP
            {{ $pegawai->nama_depan ?? $pegawai->nama_belakang }}</h3>
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
                            <th scope="col">Tanggal Terbit</th>
                            <th scope="col">Masa Berlaku SIP</th>
                            <td>Status</td>
                  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sip as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_sip }}</td>
                                <td>{{ $item->no_str }}</td>
                                <td>{{$item->tanggal_terbit_sip}}</td>
                                <td>{{ $item->tanggal_terbit_sip }}</td>
                                <td>{{ $item->masa_berakhir_sip }}</td>
                                <td>
                                    <button
                                        class="btn rounded-3 py-0 {{ $item->masa_berakhir_sip > now() ? 'btn-success' : 'btn-secondary' }}">{{ $item->masa_berakhir_sip > now() ? 'active' : 'expired' }}</button>

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
