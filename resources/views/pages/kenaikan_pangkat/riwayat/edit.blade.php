@extends('main',['title'=>'Edit Kenaikan Pangkat'])
@push('style-css')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<h1 class="" style="color:black;font-weight:bold;">Kenaikan Pangkat</h1>
<div class="card p-4 mx-lg-5 mb-5 ">
    <h4 class="m-0 font-weight-bold text-dark">Form Edit Data Kenaikan Pangkat</h4>
    <hr class="font-weight-bold">
    <form action="{{ route('admin.kenaikan-pangkat.update', ['kenaikan_pangkat' => $kenaikan_pangkat->id]) }}"
        method="post">
        @method('put')
        @csrf
        <input type="hidden" value="riwayat" name="riwayat">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <input type="hidden" id="data-pegawai" value="{{$kenaikan_pangkat->pegawai_id}}" name="pegawai_id">
                <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark ">Pegawai</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <input type="text" value="{{$kenaikan_pangkat->pegawai->nama_lengkap}}" class="form-control" readonly>
                    </div>
                </div>
                {{-- @livewire('kenaikan-pangkat.jenis-pangkat-golongan',['kenaikan_pangkat' => $kenaikan_pangkat]) --}}
                @livewire('kenaikan-pangkat.jenis-pangkat-golongan',['kenaikan_pangkat' => $kenaikan_pangkat])
                {{-- <div class="row mb-3">
                    <label for="nama_jabatan_fungsional" class="col-sm-4 col-form-label">Jabatan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="jabatan"
                            value="{{old('jabatan', $kenaikan_pangkat->pegawai->jabatan)}}" readonly>
                    </div>
                </div> --}}
                <div class="row mb-3"> 
                    <label for="tmt_pangkat" class="col-sm-4 col-form-label">TMT Pangkat</label>
                    <div class="col-md-8 col-sm-8">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                        <label for="" style="font-size: 15px">Mulai</label>
                        <input type="date" class="form-control" name="tmt_pangkat_dari" required value="{{old('tmt_pangkat_dari',$kenaikan_pangkat->tmt_pangkat_dari)}}">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-1">
                        <label for="" style="font-size: 15px">Sampai</label>
                        <input type="date" class="form-control" name="tmt_pangkat_sampai" required value="{{old('tmt_pangakt_sampai', $kenaikan_pangkat->tmt_pangkat_sampai)}}">
                    </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row mb-3">
                    <label for="no_sk" class="col-sm-4 col-form-label">No SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="no_sk" value="{{old('no_sk', $kenaikan_pangkat->no_sk)}}" required>
                    </div>
                    <div class="row mb-3">
                        <label for="tmt_pangkat" class="col-sm-4 col-form-label">TMT Pangkat</label>
                        <div class="col-md-4 col-sm-12 mb-1">
                            <label for="" style="font-size: 15px">Terbit</label>
                            <input type="date" class="form-control" name="tmt_pangkat_dari" required
                                value="{{ old('tmt_pangkat_dari', $kenaikan_pangkat->tmt_pangkat_dari) }}">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-1">
                            <label for="" style="font-size: 15px">Sampai</label>
                            <input type="date" class="form-control" name="tmt_pangkat_sampai" required
                                value="{{ old('tmt_pangakt_sampai', $kenaikan_pangkat->tmt_pangkat_sampai) }}">
                        </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_sk" class="col-sm-4 col-form-label">Tanggal SK</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="inputPassword3" name="tanggal_sk" value="{{old('tanggal_sk', $kenaikan_pangkat->tanggal_sk)}}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit_sk" class="col-sm-4 col-form-label">Penerbit SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="penerbit_sk" value="{{old('penerbit_sk', $kenaikan_pangkat->penerbit_sk)}}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="link_sk" class="col-sm-4 col-form-label">Link SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="link_sk" value={{old('link_sk', $kenaikan_pangkat->link_sk)}}>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@livewireScripts

@endpush