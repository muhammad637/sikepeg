@extends('main',['title'=>'Tambah Ruangan'])
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="mx-4 px-4" style="color:black;font-weight:bold;">Master Data</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Tambah Ruangan</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.master-data.ruangan.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-3">
                        <label for="noSIP" class="col-sm-4 col-form-label">Nama Ruangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="nama_ruangan"
                                value="{{ old('nama_ruangan') }}" required>
                        </div>                        
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('admin.master-data.ruangan.index') }}" class="btn bg-warning text-white">Tutup</a>
            <button class="btn btn-success" type="submit">Kirim</button>
        </div>
    </div>
    </div>
    </form>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush
