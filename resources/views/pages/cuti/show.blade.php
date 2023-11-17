@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="mx-4 px-4" style="color:black;font-weight:bold;">Cuti</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Detail Cuti Pegawai</h2>
        <hr class="font-weight-bold">

        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Pegawai</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control"
                            value="{{ $cuti->pegawai->nama_lengkap ?? $cuti->pegawai->nama_depan }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Jenis Cuti</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="{{ $cuti->jenis_cuti }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Alasan Cuti</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="{{ $cuti->alasan_cuti }}">

                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label for="noSIP" class="col-sm-4 col-form-label">Periode Cuti</label>
                    <div class="col-sm-4">
                        *tanggal mulai
                        <input type="date" readonly class="form-control" value="{{ $cuti->mulai_cuti }}">

                    </div>
                    <div class="col-sm-4">
                        *tanggal selesai
                        <input type="date" readonly class="form-control" value="{{ $cuti->selesai_cuti }}">

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Jumlah Hari</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" value="{{ $cuti->jumlah_hari }}">

                    </div>
                </div>
                <hr>
                <div class="d-md-flex justify-content-between d-sm-block">
                    <div>
                        @if ($cuti->status == 'nonaktif')
                            <a href="{{ route('admin.cuti.histori-cuti.index') }}"
                                class="btn btn-secondary text-white mb-1">Kembali</a>
                        @else
                            <a href="{{ route('admin.cuti.data-cuti-aktif.index') }}"
                                class="btn btn-secondary text-white">Kembali</a>
                        @endif
                        <a href="{{ route('admin.cuti.data-cuti-aktif.edit', ['cuti' => $cuti->id]) }}"
                            class="btn btn-warning text-white mb-1">Edit</a>
                    </div>
                    {{-- <div>
                        <a href="{{route('admin.cuti.riwayat-cuti-pegawai',['id'=> $cuti->pegawai_id])}}"
                            class="btn btn-info text-white">Lihat Semua Riwayat Cuti</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    <!-- /.container-fluid -->
@endsection

