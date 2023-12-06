@extends('main', ['title' => 'Tambah Diklat'])
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">Diklat</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Tambah Data Diklat</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.diklat.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Pegawai</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="pegawai" name="pegawai_id">
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
                        <label for="nama_diklat" class="col-sm-4 col-form-label">Nama Diklat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="nama_diklat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_diklat" class="col-sm-4 col-form-label">Tanggal Diklat</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah-hari" class="col-sm-4 col-form-label">Jumlah Hari</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="jumlah-hari" name="jumlah_hari" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah-jam" class="col-sm-4 col-form-label">Jumlah Jam</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="jumlah-jam" name="jumlah_jam" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penyelenggara" class="col-sm-4 col-form-label">Penyelenggara</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="penyelenggara" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tempat" class="col-sm-4 col-form-label">Tempat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="tempat" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun" class="col-sm-4 col-form-label">Tahun</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tahun" name="tahun" min="1900"
                                max="2200" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_sertifikat" class="col-sm-4 col-form-label">No Sertifikat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="no_sertifikat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal_sertifikat" class="col-sm-4 col-form-label">Tanggal Sertifikat</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="inputPassword3" name="tanggal_sertifikat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="link_sertifikat" class="col-sm-4 col-form-label">Link Sertifikat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="link_sertifikat">
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
            $('#tanggal_mulai').on('change', function() {
                let tanggal_mulai = $('#tanggal_mulai').val()
                let split = tanggal_mulai.split('-')
                console.log(split[0])
                $('#tahun').val(split[0])
                console.log("Jumlah Hari Antara Kedua Tanggal: " + jumlahHari +
                    " hari");
                if ($('#tanggal_selesai').val() != null) {
                    let tanggal_selesai = $('#tanggal_selesai').val()
                    var tanggalAwal = new Date(tanggal_mulai);
                    var tanggalAkhir = new Date(tanggal_selesai);
                    var selisihMilidetik = tanggalAkhir - tanggalAwal;
                    var jumlahHari = 1 + (selisihMilidetik / (1000 * 60 * 60 * 24));
                     $('#jumlah-hari').val(jumlahHari)
                     $('#jumlah-jam').val(jumlahHari*5)
                }
            })
            $('#tanggal_selesai').on('change', function() {
                let tanggal_selesai = $('#tanggal_selesai').val()
                if ($('#tanggal_mulai').val() != null) {
                    let tanggal_mulai = $('#tanggal_mulai').val()
                    var tanggalAwal = new Date(tanggal_mulai);
                    var tanggalAkhir = new Date(tanggal_selesai);
                    var selisihMilidetik = tanggalAkhir - tanggalAwal;
                    var jumlahHari = 1 + (selisihMilidetik / (1000 * 60 * 60 * 24));
                     $('#jumlah-hari').val(jumlahHari)
                     $('#jumlah-jam').val(jumlahHari*5)
                }
            })
            $('#jumlah-hari').on('change', function() {
                let jumlah_hari = $('#jumlah-hari').val()
                let jam = jumlah_hari * 5
                $('#jumlah-jam').val(jam)
            })

            // $('.nip').val('tes')
        });
    </script>
@endpush
