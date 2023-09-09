@extends('main')
@section('content')
    <h1 class="" style="color:black;font-weight:bold;margin:2rem 0 5rem;">Personal File</h1>
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header ">
            <div class="d-md-flex justify-content-between d-sm-block">
                <h2 class="m-0 font-weight-bold text-dark">Personal File</h2>
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize">create <i
                    class="fas fa-plus-square ml-1"></i></a>
                    {{-- <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                        IMPORT EXCEL
                    </button> --}}
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary mt-0 mt-sm-2 text-capitalize" data-toggle="modal" data-target="#importExcel">import<i
                        class="fas fa-plus-square ml-1"></i></a>
        
            </div>
        </div>
<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('import_excel')}}" enctype="multipart/form-data">
            {{-- @method('put') --}}
            {{-- @csrf --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
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
                                <td>{{$item->gelar_depan}}. {{ $item->nama_depan }} {{ $item->nama_belakang }} ,{{ $item->gelar_belakang }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->ruangan }}</td>
                                <td>
                                    <button class="badge p-2 text-white bg-info border-0">aktif</button>
                                </td>
                                <td>
                                    <a href="{{ route('pegawai.show', ['pegawai' => $item->id]) }}"
                                        class="badge p-2 text-white bg-info"><i class="fas fa-info-circle"></i></a>
                                    <a href="{{ route('pegawai.edit', ['pegawai' => $item->id]) }}"
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
