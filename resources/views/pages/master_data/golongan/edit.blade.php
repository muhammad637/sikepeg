@extends('main', ['title'=>'Edit Golongan'])
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="mx-4 px-4" style="color:black;font-weight:bold;">Master Data</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Edit Golongan</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('golongan.update', ['golongan' => $golongan->id]) }}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-3">
                        <label for="noSIP" class="col-sm-4 col-form-label">Nama Golongan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="nama_golongan"
                                value="{{ old('nama_golongan', $golongan->nama_golongan) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noSIP" class="col-sm-4 col-form-label">Status Tipe</label>
                        <div class="col-sm-8">
                            <select name="jenis" id="jenis" required
                            class="form-control @error('jenis', $golongan->jenis) is-invalid @enderror">
                            <option value="pns" {{ old('jenis', $golongan->jenis) == 'pns' ? 'selected' : '' }}>PNS
                            </option>
                            <option value="pppk" {{ old('jenis', $golongan->jenis) == 'pppk' ? 'selected' : '' }}>
                                PPPK
                            </option>
                            </select>
                        </div>                        
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('golongan.index') }}" class="btn bg-warning text-white">Tutup</a>
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

