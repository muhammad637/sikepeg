@extends('main')
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Diklat</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Tambah Diklat Pegawai</h2>
        <hr class="font-weight-bold">
        <form action="{{ route('diklat.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    {{-- <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="pegawai" name="pegawai_id">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old($item->id) == $item->id ? 'selected' : '' }}>{{ $item->nama_lengkap ?? $item->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="pegawai" name="pegawai_id">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old($item->id) == $item->id ? 'selected' : '' }}>{{ $item->nama_lengkap ?? $item->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_diklat" class="col-sm-4 col-form-label">Nama Diklat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="nama_diklat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_jam" class="col-sm-4 col-form-label">Jumlah Jam</label>
                        <div class="col-sm-8">
                            <input type="int" class="form-control" id="inputPassword3" name="jumlah_jam">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penyelenggara" class="col-sm-4 col-form-label">Penyelenggara</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="penyelenggara">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tempat" class="col-sm-4 col-form-label">Tempat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="tempat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun" class="col-sm-4 col-form-label">Tahun</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="tahun">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_sttpp" class="col-sm-4 col-form-label">No STTPP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="no_sttpp">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal_sttpp" class="col-sm-4 col-form-label">Tanggal STTPP</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="inputPassword3" name="tanggal_sttpp">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="link_sttpp" class="col-sm-4 col-form-label">Link STTPP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="link_sttpp">
                        </div>
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('diklat.index') }}" class="btn bg-warning text-white">Tutup</a>
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
            // $('.nip').val('tes')
        });
    </script>
@endpush
