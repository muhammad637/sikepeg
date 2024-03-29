@extends('main',['title'=>'Tambah Kenaikan Pangkat'] )
@push('style-css')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<h1 class="" style="color:black;font-weight:bold;">Kenaikan Pangkat</h1>
<div class="card p-4 mx-lg-5 mb-5 ">
    <h4 class="m-0 font-weight-bold text-dark">Form Tambah Data Kenaikan Pangkat</h4>
    <hr class="font-weight-bold">
    <form action="{{ route('admin.kenaikan-pangkat.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark ">Pegawai</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <select class="form-control" id="pegawai" name="pegawai_id">
                            <option value="">Pilih Nama Pegawai</option>
                            @foreach ($pegawai as $item)
                            <option value="{{ $item->id }}" {{ old('pegawai_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_lengkap ?? $item->nama_depan }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @livewire('kenaikan-pangkat.jenis-pangkat-golongan',['pegawai_id' => null])
                <div class="row mb-3">
                    <label for="tmt_pangkat" class="col-sm-4 col-form-label">TMT Pangkat</label>
                    <div class="col-sm-4">
                        <label for="" styel="font-size:15px;">Terbit</label>
                        <input type="date" class="form-control" name="tmt_pangkat_dari" required value="{{old('tmt_pangkat_dari')}}">
                    </div>
                    <div class="col-sm-4">

                    <Label for='' style='font-size:15px;'>Sampai</Label>
                        <input type="date" class="form-control" name="tmt_pangkat_sampai" required value="{{old('tmt_pangkat_sampai')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_sk" class="col-sm-4 col-form-label">No SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="no_sk" value="{{old('no_sk')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_sk" class="col-sm-4 col-form-label">Tanggal SK</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="inputPassword3" name="tanggal_sk" value="{{old('tanggal_sk')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit_sk" class="col-sm-4 col-form-label">Penerbit SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="penerbit_sk" value="{{old('penerbit_sk')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="link_sk" class="col-sm-4 col-form-label">Link SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="link_sk" value="{{old('link_sk')}}">
                    </div>
                </div>
    </form>
    <div class="text-right">
        <a href="{{ route('admin.kenaikan-pangkat.index') }}" class="btn bg-warning text-white">Tutup</a>
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