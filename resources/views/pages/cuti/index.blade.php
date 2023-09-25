@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Cuti</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Data Cuti Aktif</h2>
                <a href="{{ route('data-cuti-aktif.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">create <i
                        class="fas fa-plus-square ml-1"></i></a>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Cuti</th>
                            <th scope="col">Alasan</th>
                            <th scope="col">Mulai Cuti</th>
                            <th scope="col">Akhir Cuti</th>
                            <th scope="col">Surat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($pegawai as $index => $item) --}}
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Cuti Tahunan</td>
                            <td>Sakit Hati</td>
                            <td>17-09-2023</td>
                            <td>19-09-2023</td>
                            <td><a href="#" target="_blank" class="btn btn-primary"><i class="far fa-file-pdf"></i></a></td>
                            <td class="d-flex justify-content-center">
                                {{-- <a href="#"
                                    class="badge p-2 text-white bg-info mr-1"><i class="fas fa-info-circle"></i></a> --}}
                                <a href="{{ route('data-cuti-aktif.edit') }}" class="btn btn-warning"><i
                                        class="fas fa-pen "></i></a>
                            </td>
                            {{-- <td>{{ $loop->iteration }} </td>
                                <td>{{ Carbon\Carbon::parse($item->->tanggal)->format('d-m-Y') }} </td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="">
                                    <a href="{{ route('hariBesar.show', ['hariBesar' => $item->id]) }}"
                                        class="badge p-2 text-white bg-info"><i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('hariBesar.edit', ['hariBesar' => $item->id]) }}"
                                        class="badge p-2 text-white bg-warning"><i class="fas fa-pen "></i></a>
                                    <form action="{{ route('hariBesar.destroy', ['hariBesar' => $item->id]) }}"
                                        class="d-inline" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 badge p-2 text-white bg-danger"><i
                                                class="fas fa-trash "></i></button>
                                    </form>

                                </td> --}}
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
