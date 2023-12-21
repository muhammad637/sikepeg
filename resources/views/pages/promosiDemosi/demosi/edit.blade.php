@extends('main', ['title' => 'Edit Data Demosi'])


@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Demosi</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Edit Data Demosi</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.jabatan.demosi.update', ['promosiDemosi' => $promosiDemosi->id]) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" value="demosi" name="type">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai<span class="text-danger">*</span></span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" class="form-control" readonly value="{{ $promosiDemosi->pegawai->nama_lengkap }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status_tipe" class="col-sm-4 col-form-label">Ruangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ruangan"
                                value="{{ $promosiDemosi->ruanganawal->nama_ruangan }}" readonly
                               >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status_tipe" class="col-sm-4 col-form-label">Jabatan Lama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="jabatan_sebelumnya"
                                value="{{ $promosiDemosi->jabatan_sebelumnya }}" readonly
                                placeholder="Pilih Pegawai terlebih dahulu">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah-hari" class="col-sm-4 col-form-label">Jabatan Baru<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jabatan_selanjutnya" name="jabatan_selanjutnya"
                                required value="{{ old('jabatan_selanjutnya', $promosiDemosi->jabatan_selanjutnya) }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penyelenggara" class="col-sm-4 col-form-label">Tanggal Berlaku<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" required
                                value="{{ old('tanggal_berlaku', $promosiDemosi->tanggal_berlaku) }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tempat" class="col-sm-4 col-form-label">No SK<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_sk" name="no_sk" required value={{old('no_sk', $promosiDemosi->no_sk)}}>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun" class="col-sm-4 col-form-label">Tanggal SK<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk" required value="{{old('tanggal_sk', $promosiDemosi->tanggal_sk)}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="uploadLinkSK" class="col-sm-4 col-form-label">Upload Link SK<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="uploadLinkSK" name="link_sk" required
                                value="{{ old('link_sk',$promosiDemosi->link_sk) }}">
                        </div>
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('admin.jabatan.demosi.index') }}" class="btn bg-warning text-white">Tutup</a>
            <button class="btn btn-success" type="submit">Kirim</button>
        </div>

    </div>
    </div>
    </form>
    </div>
    <!-- /.container-fluid -->
@endsection
