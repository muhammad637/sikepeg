@extends('main')

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
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
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
                                <td>{{ $item->masa_berakhir_str }}</td>
                                <td>
                                    <button
                                        class="btn rounded-3 py-0 {{ $item->masa_berakhir_str > now() ? 'btn-success' : 'btn-secondary' }}">{{ $item->masa_berakhir_str > now() ? 'active' : 'expired' }}</button>

                                </td>
                                <td>
                                   
                                    <a href="{{ route('str.show', ['str' => $item->id]) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{$item->link_str}}"
                                            class="btn btn-success" target="_blank">
                                            <i class="fas fa-link"></i>
                                        </a>
                                        <a href="{{ route('str.edit', ['str' => $item->id]) }}"
                                            class="btn btn-warning">
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
