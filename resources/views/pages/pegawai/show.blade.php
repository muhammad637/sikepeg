@extends('main')
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
                    <h5
                        style="
                                                                margin-bottom: -25px;
                                                            ">
                        John doe,SE
                    </h5>
                    <br />
                    {{-- <span class="badge bg-light fw-italic">Nonaktif</span> --}}
                    <span
                        class="badge {{ $pegawai->status_pegawai == 'aktif' ? 'bg-success' : 'bg-warning' }} text-white">{{ $pegawai->status_pegawai }}</span>
                    <span class="judul-text">{{ $pegawai->jabatan_fungsional }}</span>
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

                        <div class="text-start" style="background: black">
                            <h4 class=" py-1 mb-3 ml-2 fw-bold text-white">
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
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->nip_nippk }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Gelar Depan</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->gelar_depan }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Nama Depan</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->nama_depan }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Nama Belakang</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->nama_belakang }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Gelar
                                    Belakang</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->gelar_belakang }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Jenis Kelamin</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->jenis_kelamin }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Tempat Lahir</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->tempat_lahir }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Tanggal Lahir</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->tempat_lahir }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Usia</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->usia }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Alamat</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->alamat }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Agama</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->agama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">No WA</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->no_wa }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Status
                                    Pegawai</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->status_pegawai }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Ruangan</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->ruangan }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Tahun Pensiun</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->tahun_pensiun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <span class="mb-0 text-dark fw-bolder">Status Tenaga</span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                {{ $pegawai->status_tenaga == 'non_asn' ? 'non pns' : ($pegawai->status_tenaga == 'asn_pns' ? 'pns' : 'pppk') }}
                            </div>
                        </div>
                        @if ($pegawai->status_tenaga == 'non_asn')
                            <div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">NIPKK</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">NI PTT-PK/THL</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Pendidikan
                                            Terakhir</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Tanggal Lulus</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">No Ijazah</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Jabatan</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Tanggal Masuk</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Masa Kerja</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Izin Dalam
                                            Setahun</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Jabatan</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Masa Kerja</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">No Karpeg</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">No Taspen</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">No NPWP
                                        </span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">No HP</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Email</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Pelatihan</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <span class="mb-0 text-dark fw-bolder">Cuti Dalam
                                            setahun</span>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        ..
                                    </div>
                                </div>
                            </div>
                        @else
                            testing
                        @endif
                    </div>
                    <!-- end isi -->
                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
@endpush
