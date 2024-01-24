@extends('main', ['title' => 'Tambah Mutasi'])
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Mutasi</h1>
 
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Tambah Data Mutasi</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.mutasi.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai<span class="text-danger">*</span></span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-8 text-secondary">
                            <select class="form-control" id="pegawai" name="pegawai_id" required>
                                <option value="">Pilih Nama Pegawai </option>
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('pegawai_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_lengkap ?? $item->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @livewire('mutasi.jenis-mutasi')
                    <div class="mb-4">
                        <div class="row gap-5">
                            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                <label for="" class="form-label">
                                    <p class="mb-0 mt-md-2 mt-0">Tanggal Berlaku<span class="text-danger">*</span></p>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                <input type="date" class="form-control @error('tanggal_berlaku') is-invalid @enderror"
                                    id="tanggal_berlaku" aria-describedby="tanggal_berlaku" name="tanggal_berlaku"
                                    autocomplete="false" placeholder="Masukkan Tanggal Berlaku" required
                                    value="{{ old('tanggal_berlaku') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row gap-5">
                            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                <label for="" class="form-label">
                                    <p class="mb-0 mt-md-2 mt-0">No SK<span class="text-danger">*</span></p>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                <input type="text" class="form-control @error('no_sk') is-invalid @enderror "
                                    id="no_sk" aria-describedby="no_sk" name="no_sk" autocomplete="false"
                                    placeholder="Masukkan No Sk" required value="{{ old('no_sk') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row gap-5">
                            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                <label for="" class="form-label">
                                    <p class="mb-0 mt-md-2 mt-0">Tanggal SK<span class="text-danger">*</span></p>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                <input type="date" class="form-control @error('tanggal_sk') is-invalid @enderror "
                                    id="tanggal_sk" aria-describedby="tanggal_sk" name="tanggal_sk" autocomplete="false"
                                    placeholder="Masukkan Tanggal SK" required value="{{ old('tanggal_sk') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row gap-5">
                            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                <label for="" class="form-label">
                                    <p class="mb-0 mt-md-2 mt-0">Upload Link SK<span class="text-danger">*</span></p>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                <input type="text" class="form-control @error('link_sk') is-invalid @enderror "
                                    id="link_sk" aria-describedby="link_sk" name="link_sk" autocomplete="false"
                                    placeholder="Masukkan Link Upload SK"required value="{{ old('link_sk') }}">
                            </div>
                        </div>
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('admin.mutasi.index') }}" class="btn bg-warning text-white">Tutup</a>
            <button class="btn btn-success" type="submit">Kirim</button>
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
