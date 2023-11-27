@extends('main', ['title' => 'Edit Diklat'])
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Diklat</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Edit Data Diklat</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.diklat.update', ['diklat' => $diklat->id]) }}" method="post">
            @method('put')
            @csrf
            <input type="hidden" value="riwayat" name="riwayat"> 
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="select2" name="pegawai_id">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($results as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ $diklat->pegawai->id == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control" id="pegawai" name="pegawai_id"
                                value="{{ $diklat->pegawai->nama_depan }} {{ $diklat->pegawai->nama_belakang }}" readonly> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_diklat" class="col-sm-4 col-form-label">Nama Diklat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_diklat" value="{{ $diklat->nama_diklat }}"
                                name="nama_diklat">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah_jam" class="col-sm-4 col-form-label">Jumlah Jam</label>
                        <div class="col-sm-8">
                            <input type="int" class="form-control" id="inputPassword3" value="{{ $diklat->jumlah_jam }}"
                                name="jumlah_jam">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penyelenggara" class="col-sm-4 col-form-label">Penyelenggara</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3"
                                value="{{ $diklat->penyelenggara }}" name="penyelenggara">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tempat" class="col-sm-4 col-form-label">Tempat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" value="{{ $diklat->tempat }}"
                                name="tempat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun" class="col-sm-4 col-form-label">Tahun</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" value="{{ $diklat->tahun }}"
                                name="tahun">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_sertifikat" class="col-sm-4 col-form-label">No Sertifikat</label>
                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="inputPassword3"
                                value="{{ $diklat->no_sertifikat }}" name="no_sertifikat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal_sertifikat" class="col-sm-4 col-form-label">Tanggal Sertifikat</label>
                        <div class="col-sm-8">

                            <input type="date" class="form-control" id="inputPassword3"
                                value="{{ $diklat->tanggal_sertifikat }}" name="tanggal_sertifikat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="link_sertifikat" class="col-sm-4 col-form-label">Link Sertifikat</label>
                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="inputPassword3"
                                value="{{ $diklat->link_sertifikat }}" name="link_sertifikat">
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('admin.diklat.riwayat',['pegawai' => $diklat->pegawai->id]) }}" class="btn bg-warning text-white">Tutup</a>
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
            $('#select2').select2();
            
            // $('.nip').val('tes')
        });
    </script>
@endpush
