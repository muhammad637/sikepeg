@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Edit SIP Pegawai {{ $sip->pegawai->nama_depan }}</h2>
        <hr class="font-weight-bold">
        <form action="{{ route('sip.update', ['sip' => $sip->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">NIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" class="form-control" value="{{ $sip->pegawai->nip_nippk }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Nama</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" class="form-control" value="{{ $sip->pegawai->nama_depan }}" readonly>

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Jenis Tenaga </span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" class="form-control" value="{{ $sip->pegawai->jenis_tenaga }}" readonly>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="Ruangan" class="col-sm-4 col-form-label">Ruangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $sip->pegawai->ruangan }}" readonly>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ttl" class="col-sm-4 col-form-label">Tempat Tanggal
                            Lahir</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                                value="{{ $sip->pegawai->tempat_lahir }}, {{ $sip->pegawai->tanggal_lahir }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jenisKelamin" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $sip->pegawai->alamat }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noIjasah" class="col-sm-4 col-form-label">No SIP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ old('no_sip', $sip->no_sip) }}" required
                                name="no_sip">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noRegister" class="col-sm-4 col-form-label">No Rekomendasi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ old('no_rekom', $sip->no_rekom) }}"
                                required name="no_rekom">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">No. STR</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ old('no_str', $sip->no_str) }}" required
                                name="no_str">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Tanggal Terbit SIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="date" class="form-control"
                                value="{{ old('tanggal_terbit_sip', Carbon\Carbon::parse($sip->tanggal_terbit_sip)->format('Y-m-d')) }}"
                                required name="tanggal_terbit_sip">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Masa Berakhir SIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="date" class="form-control"
                                value="{{ old('masa_berakhir_sip', Carbon\Carbon::parse($sip->masa_berakhir_sip)->format('Y-m-d')) }}"
                                required name="masa_berakhir_sip">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Link Dokumen SIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" class="form-control" value="{{ old('link_sip', $sip->link_sip) }}"
                                required name="link_sip">
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('sip.index') }}" class="btn btn-warning text-white">Tutup</a>
                        <button class="btn btn-success text-white" type="submit">Simpan</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
