@extends('main')

@section('content')
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <div class="card p-4 mx-lg-5 mb-5">
        <h2 class="m-0 font-weight-bold text-dark">Detail SIP Pegawai {{ $sip->pegawai->nama_depan }}</h2>
        <hr>
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6 ">
                <div class="h-100 p-4">
                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No SIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" readonly
                                    value="{{ $sip->no_sip }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" readonly
                                    value="{{ $sip->pegawai->nama_depan }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tempat / Tanggal
                                Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" readonly
                                    value="{{ $sip->pegawai->tempat_lahir }} , {{ Carbon\Carbon::parse($sip->pegawai->tanggal_lahir)->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" readonly
                                    value="{{ $sip->pegawai->alamat }}">
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
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No STR</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3" readonly
                                    value="{{ $sip->no_str }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No Rekomndasi SIP</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3" readonly
                                    value="{{ $sip->no_rekomendasi }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal
                                Terbit SIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" readonly
                                    value="{{ Carbon\Carbon::parse($sip->tanggal_terbit_sip)->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Masa
                                Berlaku SIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" readonly
                                    value="{{ Carbon\Carbon::parse($sip->masa_berakhir_sip)->format('d-m-Y') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- PANGKAT DAN GOLONGAN END -->
        </div>
        <div class="text-right">
            <a type="submit" class="btn btn-warning"
                href="{{ route('admin.sip.riwayat', ['pegawai' => $sip->pegawai->id]) }}"><i class="fas fa-history"></i>
                Lihat History SIP</a>
        </div>
    </div>
@endsection
