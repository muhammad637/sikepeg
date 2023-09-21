@extends('main')

@section('content')
    <h1 class="" style="color:black;font-weight:bold;">STR</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Detail STR</h2>
        <hr>
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6 ">
                <div class="h-100 p-4">
                    <form>
                        {{-- <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No Registrasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="">
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="{{ $str->pegawai->nama_lengkap }}"
                                    readonly>
                            </div>
                        </div>
                        {{-- {{ $str->pegawai->nama_depan }} --}}
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tempat / Tanggal
                                Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="{{$str->pegawai->tempat_lahir.", ".Carbon\Carbon::parse($str->pegawai->tanggal_lahir)->format('d-M-Y') }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis
                                Kelamin</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="{{$str->pegawai->jenis_kelamin}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No Ijazah /
                                Sertiikat Profesi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="{{$str->pegawai->no_ijazah}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal
                                Lulus</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="{{$str->pegawai->tanggal_lulus}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Perguruan
                                Tinggi</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3" value="{{$str->pegawai->sekolah}}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- BIODATA END -->
            <!-- PANGKAT DAN GOLONGAN -->
            <div class="col-sm-12 col-xl-6">
                <div class="h-100 p-4">
                    <form>
                       <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No STR</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="{{$str->no_str}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Kompetensi</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3" value="{{$str->kompetensi}}" readonly>
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">No Sertifikat Kompetensi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" value="{{$str->no_sertikom}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal
                                Terbit</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="inputEmail3" value="{{$str->tanggal_terbit_str}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Masa
                                Berlaku</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="inputEmail3" value="{{$str->masa_berakhir_str}}" readonly>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- PANGKAT DAN GOLONGAN END -->
        </div>
        <div class="row justify-content-between">
            <div class="col-md-4">
                <a class="btn btn-secondary" href="{{route('str.index')}}"> Kembali</a>
            </div>
            <div class="text-right">
                <a  class="btn btn-warning" href="{{route('str.history',['pegawai' => $str->pegawai->id])}}"><i class="fas fa-history"></i>
                    Lihat History STR</a>
            </div>
        </div>
    </div>
@endsection
