@extends('mainpegawai')
@push('style-css')
    <style>
        .judul-text {
            color: black;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
    <h1 class="text-center my-5 judul-text text-uppercase">personal file</h1>
    <div class="main-body">
        <div class="card mb-3">
            <div class="card-body judul-text">
                <div class="text-center mb-3">
                    <h5 class="text-uppercase" style="margin-bottom: -25px; ">
                        {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}
                    </h5>
                    <br />
                    {{-- <span class="badge bg-light fw-italic">Nonaktif</span> --}}
                    <span
                        class="badge {{ $pegawai->status_pegawai == 'aktif' ? 'bg-success' : 'bg-warning' }} text-white">{{ $pegawai->status_pegawai }}</span>
                    <span class="judul-text">{{ $pegawai->jabatan }}</span>
                </div>
                <div class="row">
                    <!-- profie -->
                    <div class="col-sm-12 col-md-12 col-lg-3 my-5">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                class="rounded-circle" width="150" />
                        </div>
                    </div>
                    <!-- end profile -->
                    <!-- isi -->
                    <div class="col-sm-12 col-md-12 col-lg-9 text-capitalize">

                        <div class="badge mb-3 p-1 px-2" style="background: black">
                            <h4 class="fw-bold text-white">
                                # Biodata Pegawai
                            </h4>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3 fw-italic">
                                <span class="mb-0 text-dark fw-bolder"
                                    style="
                                                                text-decoration: none;
                                                            ">NIP/NIPPK</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->nip_nippk }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Gelar Depan</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->gelar_depan }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Nama Depan</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->nama_depan }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Nama Belakang</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->nama_belakang }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Gelar
                                    Belakang</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->gelar_belakang }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Jenis Kelamin</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->jenis_kelamin }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Tempat Lahir</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->tempat_lahir }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Tanggal Lahir</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Usia</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->usia }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Alamat</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->alamat }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Agama</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->agama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">No WA</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->no_wa }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Status
                                    Pegawai</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                {{ $pegawai->status_pegawai }}
                            </div>
                        </div>


                    </div>
                    <!-- end isi -->
                </div>
                <hr>
                <br>
                <div class="p-md-5 p-sm-0">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-xl-1 my-5 ">

                        </div>
                        <div class="col-md-4 col-xl-4 col-sm-12">
                            <div class="row mb-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 ">
                                    <span class="mb-0 text-dark fw-bolder">Ruangan</span>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 ">
                                    {{ $pegawai->ruangan ? $pegawai->ruangan->nama_ruangan : '' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 ">
                                    <span class="mb-0 text-dark fw-bolder">Tahun Pensiun</span>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 ">
                                    {{ $pegawai->tahun_pensiun }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 ">
                                    <span class="mb-0 text-dark fw-bolder">Status Tenaga</span>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 ">
                                    {{ $pegawai->status_tenaga }}
                                </div>
                            </div>
                            @if ($pegawai->status_tenaga == 'non asn')
                                <div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">NI PTT-PK/THL</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->niPtt_pkThl }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">Pendidikan
                                                Terakhir</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->pendidikan_terakhir }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">Tanggal Lulus</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ Carbon\Carbon::parse($pegawai->tanggal_lulus)->format('d-M-Y') }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">No Ijazah</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->no_ijazah }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder text-uppercase">
                                            tmt cpns
                                        </span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->tmt_cpns }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder text-uppercase">
                                            tmt pns
                                        </span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->tmt_pns }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder text-uppercase">
                                            tmt <span class="text-capitalize">pangkat terakhir</span>
                                        </span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->tmt_pangkat_terakhir }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder text-uppercase">
                                            <span class="text-capitalize">pangkat / Golongan</span>
                                        </span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->pangkat_golongan }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder text-uppercas">
                                            Sekolah / Perguruan Tinggi
                                        </span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12  text-normal">
                                        {{ $pegawai->sekolah }}
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 col-xl-4 col-sm-12">
                            @if ($pegawai->status_tenaga == 'non asn')
                                <div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                            <span class="mb-0 text-dark fw-bolder">Jabatan</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                            {{ $pegawai->jabatan }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                            <span class="mb-0 text-dark fw-bolder">Tanggal Masuk</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                            {{ Carbon\Carbon::parse($pegawai->tanggal_masuk)->format('d-M-Y') }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                            <span class="mb-0 text-dark fw-bolder">Izin Dalam
                                                Setahun</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                            {{ $pegawai->cuti_tahunan }} hari
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                            <span class="mb-0 text-dark fw-bolder">Masa Kerja</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                            {{ $pegawai->masa_kerja }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                            <span class="mb-0 text-dark fw-bolder">Sisa Cuti</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                            {{ $pegawai->sisa_cuti_tahunan }} Hari
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">Pendidikan
                                            sesuai <span class="text-uppercase">SK</span> Terakhir</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->pendidikan_terakhir }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">Tanggal Lulus</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ Carbon\Carbon::parse($pegawai->tanggal_lulus)->format('d-M-Y') }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">No Ijazah</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->no_ijazah }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">Jabatan</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->jabatan }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">Cuti Tahunan</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->cuti_tahunan }} hari
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">Masa Kerja</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->masa_kerja }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">Sisa Cuti Tahunan</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->sisa_cuti_tahunan }} Hari
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        <span class="mb-0 text-dark fw-bolder">Jenis Tenaga</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                        {{ $pegawai->jenis_tenaga }}
                                    </div>
                                </div>

                                @if ($pegawai->jenis_tenaga_struktural == 'umum')
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">No Karpeg</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->no_karpeg }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">No Taspen</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->no_taspen }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">No NPWP
                                            </span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->no_npwp }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">No HP</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->no_hp }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">Email</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12  text-lowercase">
                                            {{ $pegawai->email }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">Pelatihan</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ $pegawai->pelatihan }}
                                        </div>
                                    </div>
                                @endif
                                @if (count($pegawai->str) > 0 && count($pegawai->sip) > 0)
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder">STR</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <a href="{{ route('pegawai.str.history', ['pegawai' => $pegawai->id]) }}">
                                                lihat Semua <span class="text-uppercase">
                                                    str
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <span class="mb-0 text-dark fw-bolder text-uppercase">Sip</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <a href="{{ route('pegawai.sip.history', ['pegawai' => $pegawai->id]) }}">
                                                lihat Semua <span class="text-uppercase">
                                                    sip
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span class="mb-0 text-dark fw-bolder"> Masa Berakhir Sip</span>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            {{ Carbon\Carbon::parse($pegawai->SIP[0]->orderByDesc('masa_berakhir_sip')->first()->masa_berakhir_sip)->format('d-m-Y') }}
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
@endpush
