@extends('main')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="ml-2">STR</h1>
    <div class="card p-4 mx-5 mb-5 ">
        <h5 class="fw-bold mb-2">Edit STR Pegawai</h5>
        <hr>
        <div class="row mt-2">
            <div class="col-sm-12 col-xl-12">
                <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark " style="text-decoration: none;">NIP</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Pilih NIP</option>
                            <option value="1">000</option>
                            <option value="2">111</option>
                            <option value="3">222</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark " style="text-decoration: none;">Nama</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Pilih Nama</option>
                            <option value="1">aaa</option>
                            <option value="2">bbb</option>
                            <option value="3">ccc</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark " style="text-decoration: none;">Jenis Tenaga </span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Pilih Jenis Tenaga</option>
                            <option value="1">NAKES</option>
                            <option value="2">Pegawai</option>
                            <option value="3">CS</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Ruangan" class="col-sm-4 col-form-label">Ruangan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ttl" class="col-sm-4 col-form-label">Tempat Tanggal
                        Lahir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3"
                            placeholder="28/01/2024">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noIjasah" class="col-sm-4 col-form-label">No Ijasah / Sertifikat
                        Profesi</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark " style="text-decoration: none;">Tanggal Lulus</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control" id="date" style="height: 90%;" />
                            <span class="input-group-append">
                                <span class="input-group-text bg-light d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="perguruanTinggi" class="col-sm-4 col-form-label">Perguruan Tinggi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kompetensi" class="col-sm-4 col-form-label">Kompetensi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noRegister" class="col-sm-4 col-form-label">No Registrasi</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSTR" class="col-sm-4 col-form-label">No. STR</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark " style="text-decoration: none;">Tanggal Terbit</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control" id="date" style="height: 90%;" />
                            <span class="input-group-append">
                                <span class="input-group-text bg-light d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark " style="text-decoration: none;">Masa Berlaku</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control" id="date" style="height: 90%;" />
                            <span class="input-group-append">
                                <span class="input-group-text bg-light d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                </form>
                <div class="text-right">
                    <a href="str.html" class="btn bg-gradient-warning text-white">Tutup</a>
                    <a href="str.html" class="btn bg-gradient-success text-white">Simpan</a>
                </div>
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection