@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4"> 
        <h3 class="pt-2 mt-2 pl-5" style="color:black;font-weight:bold;">History SIP {{$sip[0]->pegawai->nama_lengkap ?? $sip[0]->pegawai->nama_depan}}</h3>       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            <th scope="col">Pegawai</th>
                            <th scope="col">Jenis Mutasi</th>
                            <th scope="col">Ruangan Awal</th>
                            <th scope="col">Ruangan Tujuan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sip as $item)     
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_sip }}</td>
                                <td>{{ $item->no_str }}</td>
                                <td>{{ $item->tanggal_terbit_sip }}</td>
                                <td>{{ $item->masa_berakhir_sip }}</td>
                                <td>
                                    <button
                                        class="btn rounded-3 py-0 {{ $item->masa_berakhir_sip > now() ? 'btn-success' : 'btn-secondary' }}">{{ $item->masa_berakhir_sip > now() ? 'active' : 'expired' }}</button>

                                </td>
                                <td>

                                    <a href="{{ route('sip.show', ['sip' => $item->id]) }}" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ $item->link_sip }}" class="btn btn-success" target="_blank">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    <a href="{{ route('sip.edit', ['sip' => $item->id]) }}" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
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
