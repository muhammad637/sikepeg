@extends('main')
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Detail Mutasi </h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Detail Mutasi {{ $mutasi->pegawai->nama_depan }}
            {{ $mutasi->pegawai->nama_belakang }}</h2>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.mutasi.update', ['mutasi' => $mutasi->id]) }}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai_id"
                                value="{{ $mutasi->pegawai->nama_depan }} {{ $mutasi->pegawai->nama_belakang }}" readonly>

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Jenis Mutasi</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai" value="{{ $mutasi->jenis_mutasi }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Ruangan Awal</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai" value="{{ $mutasi->ruanganAwal->nama_ruangan ?? '-' }}"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Ruangan Tujuan</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai" value="{{ $mutasi->ruanganTujuan->nama_ruangan ?? '-' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Instansi Awal</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai" value="{{ $mutasi->instansi_awal ?? '- ' }}"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Instansi Tujuan</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai" value="{{ $mutasi->instansi_tujuan ?? '-' }}"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Tanggal Berlaku</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai"
                                value="{{ $mutasi->tanggal_berlaku }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">No SK</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai" value="{{ $mutasi->no_sk }}"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Tanggal SK</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input class="form-control" id="pegawai" name="pegawai" value="{{ $mutasi->tanggal_sk }}"
                                readonly>
                        </div>
                    </div>


                    {{-- <div class="row mb-3">
                        <label for="noRegister" class="col-sm-4 col-form-label">No Registrasi</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3">
                        </div>
                    </div> --}}

                    {{-- <div class="row justify-content-between">
            <div class="col-md-4">
                <a class="btn btn-secondary" href="{{route('admin.str.index')}}"> Kembali</a>
            </div>
            <div class="text-right">
                <a  class="btn btn-warning" href="{{route('admin.str.history',['pegawai' => $str->pegawai->id])}}"><i class="fas fa-history"></i>
                    Lihat History STR</a>
            </div>
        </div> --}}
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <a class="btn btn-secondary" href="{{ route('admin.mutasi.index') }}"> Kembali</a>
                        </div>
                        <div class="text-right">
                            <a class="btn btn-warning"
                                href="{{ route('admin.mutasi.history', ['pegawai' => $mutasi->pegawai->id]) }}"><i
                                    class="fas fa-history"></i>
                                Lihat History Mutasi</a>
                        </div>
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
