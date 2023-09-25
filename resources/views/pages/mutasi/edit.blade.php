@extends('main')
@push('style-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    @livewireStyles
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Mutasi</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">editphp Mutasi</h2>
        <hr class="font-weight-bold">
        <form action="{{ route('mutasi.update',['mutasi' => $mutasi->id]) }}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="asn_id" value="{{$mutasi->pegawai->nama_depan}} {{$mutasi->pegawai->nama_belakang}}">
                            
                        </div>
                    </div>
                    @livewire('mutasi.jenis-mutasi-edit',['mutasi' => $mutasi])  
                    
        </form>
        <div class="text-right">
            <a href="{{ route('mutasi.index') }}" class="btn bg-warning text-white">Tutup</a>
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>

    </div>
    </div>
    </form>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@livewireScripts
@endpush