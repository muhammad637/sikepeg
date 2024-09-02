@extends('main', ['title' => 'Edit Kenaikan Pangkat'])
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
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <input type="hidden" id="data-pegawai" value="{{ $kenaikan_pangkat->pegawai_id }}" name="pegawai_id">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" value="{{ $kenaikan_pangkat->pegawai->nama_lengkap }}"
                                class="form-control" readonly>
                        </div>
                    </div>
                    {{-- @livewire('kenaikan-pangkat.jenis-pangkat-golongan',['kenaikan_pangkat' => $kenaikan_pangkat]) --}}
                    @livewire('kenaikan-pangkat.jenis-pangkat-golongan', ['kenaikan_pangkat' => $kenaikan_pangkat])
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
                                    <input type="date" class="form-control" name="tmt_pangkat_dari" required
                                        value="{{ old('tmt_pangkat_dari', $kenaikan_pangkat->tmt_pangkat_dari) }}">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-1">
                                    <label for="" style="font-size: 15px">Selesai</label>
                                    <input type="date" class="form-control" name="tmt_pangkat_sampai" required
                                        value="{{ old('tmt_pangakt_sampai', $kenaikan_pangkat->tmt_pangkat_sampai) }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label for="no_sk" class="col-sm-4 col-form-label">No SK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="no_sk"
                                value="{{ old('no_sk', $kenaikan_pangkat->no_sk) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal_sk" class="col-sm-4 col-form-label">Tanggal SK</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="inputPassword3" name="tanggal_sk"
                                value="{{ old('tanggal_sk', $kenaikan_pangkat->tanggal_sk) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penerbit_sk" class="col-sm-4 col-form-label">Penerbit SK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="penerbit_sk"
                                value="{{ old('penerbit_sk', $kenaikan_pangkat->penerbit_sk) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal_sertifikat" class="col-sm-4 col-form-label">Dokumen SK</label>

                        <div class="col-sm-8">

                            <a target="popup"
                                onclick="window.open(`{{ route('admin.previewDokumen', ['path' => $kenaikan_pangkat->link_sk]) }}`,'name','width=600,height=400')"
                                class="btn btn-primary mr-1" style="cursor: pointer">
                                <i class="fas fa-file-alt text-white"></i> Lihat
                            </a>

                            <!-- Large modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#myModal">Update</button>

                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.kenaikan-pangkat.index') }}" class="btn bg-warning text-white">Tutup</a>
                        <button class="btn btn-success" type="submit">Kirim</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.kenaikan-pangkat.update-dok', ['kenaikan_pangkat' => $kenaikan_pangkat]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Dokumen Sertifikat
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="link_sertifikat" class="col-sm-4 col-form-label">Upload</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileInput" name="link_sk"
                                            required>
                                        <label class="custom-file-label" for="fileInput">Pilih
                                            file</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="modalSubmitBtn" type="submit" class="btn btn-primary">
                                <span id="modalButtonText">Submit</span>
                                <span id="modalSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    @livewireScripts
    <script>
        $(document).ready(function() {

            $('.custom-file-input').on('change', function(event) {
                var inputFile = event.currentTarget;
                $(inputFile).parent()
                    .find('.custom-file-label')
                    .html(inputFile.files[0].name);
            });
            $('#myModal form').on('submit', function(event) {
                // Menambahkan animasi spinner dan menonaktifkan tombol
                $('#modalButtonText').addClass('d-none');
                $('#modalSpinner').removeClass('d-none');
                $('#modalSubmitBtn').attr('disabled', true);
            });
            $('form').on('submit', function(event) {
                // Menambahkan animasi spinner dan menonaktifkan tombol
                $('#buttonText').addClass('d-none');
                $('#spinner').removeClass('d-none');
                $('#submitBtn').attr('disabled', true);
            });
        })
    </script>
@endpush
