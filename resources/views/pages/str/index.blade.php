@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">STR</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background-color: #d9d9d9;">
            <div class="d-md-flex justify-content-between s-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Data STR</h2>
                <div class="d-flex">
                    <a href="{{ route('admin.str.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize mx-1">
                        create <i class="fas fa-plus-square ml-1"></i>
                    </a>
                    <a href="#apa" data-toggle="modal" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">
                        Export <i class="fas fa-file-excel"></i>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="apa" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center text-capitalize" id="dataTable" width="100%"
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
                            @if (count($item->str) > 0)
                                @php
                                    $data = explode('view', $item->str[0]->link_str);
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->nama_depan }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->ruangan }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->str[0]->masa_berakhir_str)->format('d-M-Y') }}</td>
                                    <td>
                                        <button
                                            class="btn rounded-3 py-0 {{ $item->str[0]->masa_berakhir_str > now() ? 'btn-success' : 'btn-secondary' }}">{{ $item->str[0]->masa_berakhir_str > now() ? 'active' : 'expired' }}
                                        </button>
                                    </td>
                                    <td>

                                        <a target="popup"
                                            onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                            class="btn btn-primary" style="cursor: pointer">
                                            <i class="fas fa-file-alt text-white"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.str.show', ['str' => $item->str[0]->id]) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ $data[0] }}view" class="btn btn-success">
                                            <i class="fas fa-link"></i>
                                        </a>
                                        <a href="{{ route('admin.str.edit', ['str' => $item->str[0]->id]) }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- <script>
                                    $(document).ready(function() {
                                        // let id = split('view', "{{ $item->str[0]->link_str }}")
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
