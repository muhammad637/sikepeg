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
        <form action="{{ route('admin.diklat.store') }}" method="post">
            @csrf
            <div class="row">
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
                    <div class="row mb-3">
                        <label for="nama_diklat" class="col-sm-4 col-form-label">Jabatan Lama<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="nama_diklat" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah-hari" class="col-sm-4 col-form-label">Jabatan Baru<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="jumlah-hari" name="jumlah_hari" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penyelenggara" class="col-sm-4 col-form-label">Tanggal Berlaku<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="inputPassword3" name="penyelenggara" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tempat" class="col-sm-4 col-form-label">No SK<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="tempat" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun" class="col-sm-4 col-form-label">Tanggal SK<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tahun" name="tahun" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_sertifikat" class="col-sm-4 col-form-label">Upload Link SK<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="no_sertifikat" required>
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
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            // alert('oke')
            $('#pegawai').select2();
            $('#pegawai').on('change',function(){
                let val = $('#pegawai').val()
                @php
                    
                @endphp
            })
            // $('.nip').val('tes')
        });
    </script>
@endpush
