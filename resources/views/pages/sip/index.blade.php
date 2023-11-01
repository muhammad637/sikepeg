@extends('main',['title'=>'SIP'])

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">SIP</h1>
    <!-- tabel -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" >
            <div class="d-md-flex justify-content-between s-sm-block">
                <h4 class="m-0 font-weight-bold text-dark ">Data SIP Aktif Pegawai</h4>
                <a href="{{ route('admin.sip.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">
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
                                    <td>{{ $item->nama_lengkap ?? $item->nama_depan }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->ruangan->nama_ruangan }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->sip[0]->masa_berakhir_sip)->format('d-M-Y') }}</td>
                                    <td>


                                        <button
                                            class="btn rounded-3 py-0 {{ $item->sip[0]->masa_berakhir_sip > now() ? 'btn-success' : 'btn-secondary' }}">{{ $item->sip[0]->masa_berakhir_sip > now() ? 'active' : 'expired' }}
                                        </button>
                                    </td>
                                    <td>
                                        <a target="popup"
                                            onclick="window.open(`{{ $data[0] }}`,'name','width=600,height=400')"
                                            class="btn btn-primary" style="cursor: pointer">
                                            <i class="fas fa-file-alt text-white"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sip.show', ['sip' => $item->sip[0]->id]) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ $data[0] }}view" class="btn btn-success">
                                            <i class="fas fa-link"></i>
                                        </a>
                                        <a href="{{ route('admin.sip.edit', ['sip' => $item->sip[0]->id]) }}"
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
@push('script')
    <script src="{{asset('tampilan-sikepeg/vendor/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('tampilan-sikepeg/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endpush
