@extends('main', ['title' => 'Tambah Data Demosi'])
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Demosi</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Tambah Data Demosi</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.jabatan.demosi.store') }}" method="post">
            @csrf
            <input type="hidden" value="demosi" name="type">
            <div class="row align-items-end">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai<span class="text-danger">*</span></span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="pegawai" name="pegawai_id" required>
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}" {{ old($item->id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_lengkap ?? $item->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @livewire('promosi-demosi.form')
                    <div class="row mb-3">
                        <label for="jumlah-hari" class="col-sm-4 col-form-label">Jabatan Baru<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jabatan_selanjutnya" name="jabatan_selanjutnya" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Type-Jabatan" class="col-sm-4 col-form-label">Type Jabatan<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="type" id="type" class="form-control">
                                <option value="">Semua Jabatan</option>
                                <option value="demosi">Demosi</option>
                                <option value="promosi">Promosi</option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        <label for="penyelenggara" class="col-sm-4 col-form-label">Tanggal Berlaku<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tempat" class="col-sm-4 col-form-label">No SK<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_sk" name="no_sk" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun" class="col-sm-4 col-form-label">Tanggal SK<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="uploadLinkSK" class="col-sm-4 col-form-label">Upload Link SK<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="uploadLinkSK" name="link_sk" required value="{{old('link_sk')}}">
                        </div>
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('admin.diklat.index') }}" class="btn bg-warning text-white">Tutup</a>
            <button class="btn btn-success" type="submit">Kirim</button>
        </div>

    </div>
    </div>
    </form>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  @livewireScripts
   
@endpush
