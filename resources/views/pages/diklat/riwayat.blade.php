@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Data Diklat</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Riwayat Diklat</h2>
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
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Nama Diklat</th>
                            <th scope="col">Jumlah Jam</th>
                            <th scope="col">Penyelenggara</th>
                            <th scope="col">Tempat</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">No STTPP</th>
                            <th scope="col">Tanggal STTPP</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diklat as $index => $item)
                            
                                @php
                                    $data = explode('view', $item->link_sttpp);
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai->nama_depan }}</td>
                                    <td>{{ $item->nama_diklat }}</td>
                                    <td>{{ $item->jumlah_jam }}</td>
                                    <td>{{ $item->penyelenggara }}</td>
                                    <td>{{ $item->tempat }}</td>
                                    <td>{{ $item->tahun}}</td>
                                    <td>{{ $item->no_sttpp}}</td>
                                    <td>{{ $item->tanggal_sttpp}}</td>
                                    <td>
                                        <a  target="popup" onclick="window.open(`{{$data[0]}}`,'name','width=600,height=400')" class="btn btn-primary" style="cursor: pointer"> 
                                            <i class="fas fa-file-alt text-white"></i></a>
                                            
                                        <div class="modal fade bd-example-modal-lg" id="modal_sttpp_link-{{ $item->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="modal_sttpp_link-{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="modal_sttpp_link-{{ $item->id }}Label">Preview Dokumen
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <iframe src="{{ $data[0] }}preview" class="w-100"
                                                            style="height: 40em"></iframe>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    </td>
                

                                    {{-- <td>{{$loop->iteration}}</td> --}}


                                    {{-- <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_depan ?? null}} </td>
                                <td>{{ $item->mutasi[count($item->mutasi) -1]->jenis_mutasi}}</td>
                                <td>{{ $item->mutasi[count($item->mutasi) -1]->tanggal_berlaku }}</td>
                                <td>{{ $item->mutasi[count($item->mutasi) -1]->ruangan_awal }}</td>
                                <td>{{ $item->mutasi[count($item->mutasi) -1]->ruangan_tujuan }}</td>
                                <td>{{ $item->mutasi[count($item->mutasi) -1]->instansi_awal }}</td>
                                <td>{{ $item->mutasi[count($item->mutasi) -1]->instansi_tujuan }}</td>
                                <td>{{ $item->mutasi[0]->no_sk}}</td>
                                <td><!-- Button trigger modal preview-->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
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
                               
                                <td>
                                    <a href="{{ route('mutasi.show', ['mutasi' => $item->id]) }}"
                                        class="badge p-2 text-white bg-info"><i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('mutasi.edit', ['mutasi' => $item->mutasi[count($item->mutasi) -1]]) }}"
                                        class="badge p-2 text-white bg-warning"><i class="fas fa-pen "></i></a>
                                </td> --}}
                                </tr>
                
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
