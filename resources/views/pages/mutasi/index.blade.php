@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Mutasi</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h3 class="m-0 font-weight-bold text-dark">Data Mutasi Pegawai</h3>
                <a href="{{ route('admin.mutasi.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">Create <i
                        class="fas fa-plus-square ml-1"></i></a>
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
                            <th scope="col">Jenis Mutasi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Ruangan Awal</th>
                            <th scope="col">Ruangan Tujuan</th>
                            <th scope="col">Instansi Awal</th>
                            <th scope="col">Instansi Tujuan</th>
                            <th scope="col">No SK</th>
                            <th scope="col">Surat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $index => $item)
                            @php
                                $data = explode('view', $item->mutasi[0]->link_sk);
                            @endphp
                            <tr>
                                {{-- <td>{{$loop->iteration}}</td> --}}


                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_depan ?? null }} </td>
                                <td>{{ $item->mutasi[0]->jenis_mutasi }}</td>
                                <td>{{ $item->mutasi[0]->tanggal_berlaku }}</td>
                                <td>{{ $item->mutasi[0]->ruangan_awal }}</td>
                                <td>{{ $item->mutasi[0]->ruangan_tujuan }}</td>
                                <td>{{ $item->mutasi[0]->instansi_awal }}</td>
                                <td>{{ $item->mutasi[0]->instansi_tujuan }}</td>
                                <td>{{ $item->mutasi[0]->no_sk }}</td>
                                <td><!-- Button trigger modal preview-->
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal_str_link-{{ $item->id }}">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="modal_str_link-{{ $item->id }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="modal_str_link-{{ $item->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="modal_str_link-{{ $item->id }}Label">Preview Dokumen
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe
                                                        src="{{$data[0]}}preview"
                                                        class="w-100" style="height: 40em"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div></td>
                                --}}
                                    <a target="popup"
                                        onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                        class="btn btn-primary" style="cursor: pointer">
                                        <i class="fas fa-file-alt text-white"></i></a>
                                <td>
                                    <a href="{{ route('admin.mutasi.show', ['mutasi' => $item->mutasi[0]]) }}"
                                        class="badge p-2 text-white bg-info"><i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('admin.mutasi.edit', ['mutasi' => $item->mutasi[0]]) }}"
                                        class="badge p-2 text-white bg-warning"><i class="fas fa-pen "></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
