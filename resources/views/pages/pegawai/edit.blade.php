@extends('main')
@push('style-css')
    @livewireStyles
    <style>
        .judul-text {
            color: black;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
    <div class="card mb-5">
        <div class="px-4">
            <div class="card-body">
                <h1 class="fw-bold mb-4 mt-3 text-uppercase judul-text">Personal File</h1>
                <hr style="background: black; height:.2rem;" class="mt-3 mb-5">
                <form action="{{ route('pegawai.update', ['pegawai' => $pegawai->id]) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row mt-5 judul-text">
                        <div class="col-md-12 col-lg-12 col-xl-6 ">
                            <h3 class="judul-text">Biodata Diri</h3>
                            <hr style="height:.1rem;" class="bg-primary">
                            <div class="mt-5 mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label @error('nik') is-invalid @enderror">
                                            <p class="mb-0 mt-md-2 mt-0">NIK</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control form-control-user" id="NIK"
                                            aria-describedby="NIK" name="nik" autocomplete="false"
                                            placeholder="Masukkan NIK ..." required value="{{ old('nik', $pegawai->nik) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label ">
                                            <p class="mb-0 mt-md-2 mt-0">NIP / NIPPK</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('nip_nippk') is-invalid @enderror"
                                            id="nip_nippk" aria-describedby="nip_nippk" name="nip_nippk"
                                            autocomplete="false" placeholder="Masukkan NIP / NIPPK" required
                                            value="{{ old('nip_nippk', $pegawai->nip_nippk) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Gelar Depan</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('gelar_depan') is-invalid @enderror" id="gelar_depan"
                                            aria-describedby="gelar_depan" name="gelar_depan" autocomplete="false"
                                            value="{{ old('gelar_depan', $pegawai->gelar_depan) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label ">
                                            <p class="mb-0 mt-md-2 mt-0">Nama Depan</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('nama_depan') is-invalid @enderror"
                                            id="nama_depan" aria-describedby="nama_depan" name="nama_depan"
                                            autocomplete="false" placeholder="Masukkan Nama Depan ..." required
                                            value="{{ old('nama_depan', $pegawai->nama_depan) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label ">
                                            <p class="mb-0 mt-md-2 mt-0">Nama Belakang</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('nama_belakang') is-invalid @enderror"
                                            id="nama_belakang" aria-describedby="nama_belakang" name="nama_belakang"
                                            autocomplete="false"
                                            value="{{ old('nama_belakang', $pegawai->nama_belakang) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Gelar Belakang</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('gelat_belakang') is-invalid @enderror"
                                            id="gelar_belakang" aria-describedby="gelar_belakang" name="gelar_belakang"
                                            autocomplete="false"
                                            value="{{ old('gelar_belakang', $pegawai->gelar_belakang) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Jenis Kelamin</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <select name="jenis_kelamin" id="jenis_kelamin"
                                            class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">Pilih</option>
                                            <option value="laki-laki"
                                                {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                                Laki Laki
                                            </option>
                                            <option value="perempuan"
                                                {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Tempat lahir</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" aria-describedby="tempat_lahir" name="tempat_lahir"
                                            autocomplete="false" placeholder="Masukkan Tempat Lahir ..."
                                            value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Tanggal Lahir</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" aria-describedby="tanggal_lahir" name="tanggal_lahir"
                                            autocomplete="false" placeholder="Masukkan Tanggal Lahir ..."
                                            value="{{ Carbon\Carbon::parse(old('tanggal_lahir', $pegawai->tanggal_lahir))->format('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Alamat</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" aria-describedby="alamat" name="alamat" autocomplete="false"
                                            placeholder="Masukkan Alamat ..."
                                            value="{{ old('alamat', $pegawai->alamat) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Agama</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('agama') is-invalid @enderror"
                                            id="agama" aria-describedby="agama" name="agama" autocomplete="false"
                                            placeholder="Masukkan Agama" value="{{ old('agama', $pegawai->agama) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">No Wa</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                            id="no_wa" aria-describedby="no_wa" name="no_wa" autocomplete="false"
                                            placeholder="Masukkan No WA" value="{{ old('no_wa', $pegawai->no_wa) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Status pegawai</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <select name="status_pegawai" id="status_pegawai"
                                            class="form-control @error('status_pegawai') is-invalid @enderror">
                                            <option value="">Pilih</option>
                                            <option value="aktif"
                                                {{ old('status_pegawai', $pegawai->status_pegawai) == 'aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="pensiun"
                                                {{ old('status_pegawai', $pegawai->status_pegawai) == 'nonaktif' ? 'selected' : '' }}>
                                                Nonaktif
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Ruangan</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('ruangan') is-invalid @enderror"
                                            id="ruangan" aria-describedby="ruangan" name="ruangan"
                                            autocomplete="false" placeholder="Masukkan Ruangan"
                                            value="{{ old('ruangan', $pegawai->ruangan) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Tahun Pensiun</p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="number"
                                            class="form-control @error('tahun_pensiun') is-invalid @enderror"
                                            id="tahun_pensiun" aria-describedby="tahun_pensiun" name="tahun_pensiun"
                                            autocomplete="false" placeholder="Masukkan Ruangan" min="1900"
                                            max="2100" step="1"
                                            value="{{ old('tahun_pensiun', $pegawai->tahun_pensiun) }}">
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                            <h3 class="judul-text mt-5 mt-xl-0">Pangkat Dan Golongan</h3>
                            <hr style=" height:.1rem;" class="bg-primary">
                            @livewire('pegawai.pangkat-dan-golongan-edit', ['pegawai' => $pegawai])
                        </div>

                    </div>

                    <hr>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    @livewireScripts
@endpush
