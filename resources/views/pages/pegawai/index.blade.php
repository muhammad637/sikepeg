@extends('main')
@section('content')
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header px-3">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Personal File</h2>
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">create <i
                        class="fas fa-plus-square ml-1"></i></a>

            </div>
        </div>
        <div class="card-body">

            @if (session()->has('success'))
                {{ session()->get('success') }}
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">NIP/NIPPK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Ruangan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nip_nippk }}</td>
                                <td>{{ $item->nama_depan }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->ruangan }}</td>
                                <td>
                                    <button class="badge p-2 text-white bg-info border-0">aktif</button>
                                </td>
                                <td>
                                    <a href="#"
                                        class="badge p-2 text-white bg-info"><i class="fas fa-pen"></i></a>
                                    <a href="{{ route('pegawai.edit', ['pegawai' => $item->id]) }}" class="badge p-2 text-white bg-warning"><i
                                            class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
