@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h3 class="m-0 font-weight-bold text-dark"> Form Edit SIP {{ $sip->pegawai->nama_depan }}</h3>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.sip.update', ['sip' => $sip->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Nama</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="select2" name="asn_id">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($results as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ $sip->pegawai->id == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @livewire('pegawai.search-pegawai', ['dokumen' => 'sip', 'pegawaiEdit' => $sip->pegawai_id])
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
                        <a href="{{ route('admin.sip.index') }}" class="btn btn-warning text-white">Kembali</a>
                        <button class="btn btn-success text-white" type="submit">Simpan</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
