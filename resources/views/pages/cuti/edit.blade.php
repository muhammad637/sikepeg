@extends('main')
@push('style-css')
@endpush
@section('content')
    <!-- Begin Page Content -->
    <h1 class="mx-4 px-4" style="color:black;font-weight:bold;">Cuti</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Detail Cuti Pegawai</h2>
        <hr class="font-weight-bold">
       <div>
    <form action="#" method="get">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row mb-3">

                    <label for="noSIP" class="col-sm-4 col-form-label">Pegawai</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{$pegawai->nama_lengkap ?? $pegawai->nama_depan}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Jenis Cuti</label>
                    <div class="col-sm-8">
                        <select name="jenis_cuti" id="" class="form-control">
                            <option value="" >Pilih </option>
                            @if ($pegawai->status_tipe == 'pns')
                                <option value="cuti tahunan" selected>Cuti tahunan</option>
                                <option value="cuti besat">Cuti Besar</option>
                                <option value="cuti sakit">Cuti Sakit</option>
                                <option value="cuti melahirkan">Cuti Melahirkan</option>
                            @elseif ($pegawai->status_tipe == 'pppk')
                                <option value="cuti tahunan" selected>Cuti tahunan</option>
                                <option value="cuti besat">Cuti Besar</option>
                                <option value="cuti sakit">Cuti Sakit</option>
                            @else
                                <option value="cuti tahunan" selected >Cuti tahunan</option>
                                <option value="cuti sakit">Cuti Sakit</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Alasan Cuti</label>
                    <div class="col-sm-8">
                        <textarea name="" class="form-control" id="" cols="30" rows="3"> sakit hati
                        </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Periode Cuti</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="inputPassword3" name="keterangan"
                            value="2023-09-17" required value="2023-09-15">
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="keterangan"
                            value="2023-09-19" required >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Jumlah Hari</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="keterangan"
                            value="3" required >
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('data-cuti-aktif.index') }}" class="btn bg-warning text-white">Tutup</a>
                    <button class="btn btn-info" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>


    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
@endpush
