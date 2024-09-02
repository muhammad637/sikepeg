@extends('main', ['title' => 'Edit Mutasi'])
@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    @livewireStyles
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Mutasi</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Edit Data Mutasi</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.mutasi.update', ['mutasi' => $mutasi->id]) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-8 text-secondary">
                            <select class="form-control" id="pegawai" name="pegawai_id" required>
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('pegawai_id', $mutasi->pegawai->id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_lengkap ?? $item->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @livewire('mutasi.jenis-mutasi-edit', ['mutasi' => $mutasi])


                    <a href="{{ route('admin.mutasi.index') }}" class="btn bg-warning text-white">Tutup</a>
                    <button class="btn btn-success" type="submit">Simpan</button>

                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.mutasi.update-dok', ['mutasi' => $mutasi]) }}"
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
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush
