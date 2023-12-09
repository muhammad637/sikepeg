@extends('main')

@section('content')
<h1 class="" style="color:black;font-weight:bold;">Kenaikan Pangkat</h1>
<div class="card p-4 mx-lg-5 mb-5 ">
    <h2 class="m-0 font-weight-bold text-dark">Detail Kenaikan Pangkat</h2>
    <hr>
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 ">
            <div class="h-100 p-4">
                <form>
                    {{-- <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">No Regikenaikan_pangkatasi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" value="">
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3"
                                value="{{ $kenaikan_pangkat->pegawai->nama_lengkap ?? $kenaikan_pangkat->pegawai->nama_depan }}"
                                readonly>
                        </div>
                    </div>
                    {{-- {{ $kenaikan_pangkat->pegawai->nama_depan }} --}}
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Ruangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3"
                                value="{{ $kenaikan_pangkat->pegawai->ruangan->nama_ruangan}}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis
                            Kelamin</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3"
                                value="{{ $kenaikan_pangkat->pegawai->jenis_kelamin }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Pangkat / Golongan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3"
                                value="{{ $kenaikan_pangkat->pangkat ? $kenaikan_pangkat->pangkat->nama_pangkat.' / '.$kenaikan_pangkat->golongan->nama_golongan : $kenaikan_pangkat->golongan->nama_golongan}}"
                                readonly>
                        </div>
                    </div>
                    

                </form>
            </div>
        </div>
        <!-- BIODATA END -->
        <!-- PANGKAT DAN GOLONGAN -->
        <div class="col-sm-12 col-xl-6">
            <div class="h-100 p-4">
                <form>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">No SK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" value="{{ $kenaikan_pangkat->no_sk }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal SK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3"
                                value="{{ Carbon\Carbon::parse($kenaikan_pangkat->tanggal_sk)->format('d, M Y') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Penerbit SK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3"
                                value="{{ $kenaikan_pangkat->penerbit_sk }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">TMT Kenaikan Pangkat</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputEmail3"
                                value="{{ Carbon\Carbon::parse($kenaikan_pangkat->tmt_pangkat_dari)->format('d, M Y')." - ". Carbon\Carbon::parse($kenaikan_pangkat->tmt_pangkat_sampai)->format('d, M Y') }}"
                                readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- PANGKAT DAN GOLONGAN END -->
    </div>
    <div class="row justify-content-between">
        <div class="col-md-4">
            <a class="btn btn-secondary" href="{{ route('admin.kenaikan-pangkat.riwayat',['pegawai' =>  $kenaikan_pangkat->pegawai_id ]) }}"> Kembali</a>
        </div>
    </div>
</div>
@endsection