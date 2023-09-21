@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">sip</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background-color: #d9d9d9;">
            <div class="d-md-flex justify-content-between s-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Data sip</h2>
                <a href="{{ route('sip.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">
                    create <i class="fas fa-plus-square ml-1"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sipiped table-bordered text-center text-capitalize" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">no</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Ruangan</th>
                            <th scope="col">Masa Berakhir</th>
                            <th scope="col">Status</th>
                            <th scope="col">Surat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $index => $item)
                            @if (count($item->sip) > 0)
                                @php
                                    $data = explode('view', $item->sip[0]->link_sip);
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->nama_depan }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->ruangan }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->sip[0]->masa_berakhir_sip)->format('d-M-Y') }}</td>
                                    <td>
                                        <button
                                            class="btn rounded-3 py-0 {{ $item->sip[0]->masa_berakhir_sip > now() ? 'btn-success' : 'btn-secondary' }}">{{ $item->sip[0]->masa_berakhir_sip > now() ? 'active' : 'expired' }}
                                        </button>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal preview-->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal_sip_link-{{ $item->id }}">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-lg" id="modal_sip_link-{{ $item->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="modal_sip_link-{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="modal_sip_link-{{ $item->id }}Label">Preview Dokumen
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
                                    <td>
                                        <a href="{{ route('sip.show', ['sip' => $item->sip[0]->id]) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ $data[0] }}view" class="btn btn-success">
                                            <i class="fas fa-link"></i>
                                        </a>
                                        <a href="{{ route('sip.edit', ['sip' => $item->sip[0]->id]) }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- <script>
                                    $(document).ready(function() {
                                        // let id = split('view', "{{ $item->sip[0]->link_sip }}")
                                        console.log({{ $item->id }})
                                    })
                                </script> --}}
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- tabel End -->
    <!-- /.container-fluid -->
@endsection
