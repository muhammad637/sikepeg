@extends('main')
@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @livewireStyles
    <style>
        .judul-text {
            color: black;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
    <div class="card">
        <div class="px-4">
            <div class="card-body">
                <h1 class="fw-bold mb-4 mt-3 text-uppercase judul-text">Personal File</h1>
                <hr style="background: black; height:.2rem;" class="mt-3 mb-5">
                <form action="{{ route('admin.pegawai.store') }}" method="post">
                    @csrf
                    <div class="row mt-5 judul-text">

                        <div class="col-md-12 col-lg-12 col-xl-6 ">

                            <h3 class="judul-text">Biodata Diri</h3>
                            <hr style="height:.1rem;" class="bg-primary">
                            <div class="mt-5 mb-4">
              
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label @error('nik') is-invalid @enderror">
                                            <p class="mb-0 mt-md-2 mt-0">NIK <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" aria-describedby="nik" name="nik"
                                            autocomplete="false" placeholder="Masukkan NIK" required
                                            value="{{ old('nik') }}">
                                           
                                    </div>

                                </div>
                            </div>
                     
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label ">
                                            <p class="mb-0 mt-md-2 mt-0">NIP / NIPPK <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('nip_nippk') is-invalid @enderror"
                                            id="nip_nippk" aria-describedby="nip_nippk" name="nip_nippk"
                                            autocomplete="false" placeholder="Masukkan NIP / NIPPK" required
                                            value="{{ old('nip_nippk') }}">
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Gelar Depan </p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('gelar_depan') is-invalid @enderror" id="gelar_depan"
                                            aria-describedby="gelar_depan" name="gelar_depan" autocomplete="false"
                                            value="{{ old('gelar_depan') }}">
                                    </div>
                                </div>
                            </div>
                 
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label ">
                                            <p class="mb-0 mt-md-2 mt-0">Nama Depan <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('nama_depan') is-invalid @enderror"
                                            id="nama_depan" aria-describedby="nama_depan" name="nama_depan"
                                            autocomplete="false" placeholder="Masukkan Nama Depan ..." 
                                            value="{{ old('nama_depan') }}" required>
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label ">
                                            <p class="mb-0 mt-md-2 mt-0">Nama Belakang </p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('nama_belakang') is-invalid @enderror"
                                            id="nama_belakang" aria-describedby="nama_belakang" name="nama_belakang"
                                            autocomplete="false" value="{{ old('nama_belakang') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Gelar Belakang </p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('gelat_belakang') is-invalid @enderror"
                                            id="gelar_belakang" aria-describedby="gelar_belakang" name="gelar_belakang"
                                            autocomplete="false" value="{{ old('gelar_belakang') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Jenis Kelamin <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <select name="jenis_kelamin" id="jenis_kelamin" required
                                            class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">Pilih</option>
                                            <option value="laki-laki"
                                                {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki Laki
                                            </option>
                                            <option value="perempuan"
                                                {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Tempat lahir <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" aria-describedby="tempat_lahir" name="tempat_lahir"
                                            autocomplete="false" placeholder="Masukkan Tempat Lahir ..."
                                            value="{{ old('tempat_lahir') }}" required>
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Tanggal Lahir <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" aria-describedby="tanggal_lahir" name="tanggal_lahir"
                                            autocomplete="false" placeholder="Masukkan Tanggal Lahir ..."
                                            value="{{ Carbon\Carbon::parse(old('tanggal_lahir'))->format('Y-m-d') }}"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Alamat <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" aria-describedby="alamat" name="alamat" autocomplete="false"
                                            placeholder="Masukkan Alamat ..." value="{{ old('alamat') }}" required>
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="agama" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Agama <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <select name="agama" id="agama" required
                                            class="form-control @error('agama') is-invalid @enderror">
                                            <option value="">Pilih</option>
                                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                            </option>
                                            <option value="Protestan" {{ old('agama') == 'Protestan' ? 'selected' : '' }}>
                                                Kristen-Protestan
                                            </option>
                                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                                Kristen-Katolik
                                            </option>
                                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                            </option>
                                            <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha
                                            </option>
                                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">No Wa <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                            id="no_wa" aria-describedby="no_wa" name="no_wa" autocomplete="false"
                                            placeholder="Masukkan No WA" value="{{ old('no_wa') }}" required>
                                           
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Status pegawai <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <select name="status_pegawai" id="status_pegawai"
                                            class="form-control @error('status_pegawai') is-invalid @enderror" required>
                                            <option value="">Pilih</option>
                                            <option value="aktif"
                                                {{ old('status_pegawai') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="aktif"
                                                {{ old('status_pegawai') == 'nonaktif' ? 'selected' : '' }}>Non Aktif
                                            </option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            @livewire('pegawai.ruangan-id')    
                            <div class="mb-4">
                                <div class="row gap-5">
                                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                                        <label for="" class="form-label">
                                            <p class="mb-0 mt-md-2 mt-0">Tahun Pensiun <span class="text-danger">*</span></p>
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                                        <input type="number"
                                            class="form-control @error('tahun_pensiun') is-invalid @enderror"
                                            id="tahun_pensiun" aria-describedby="tahun_pensiun" name="tahun_pensiun"
                                            autocomplete="false" placeholder="Masukkan Tahun Pensiun ..." min="2000"
                                            max="2100" step="1" value="{{ old('tahun_pensiun') }}" required>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                            <h3 class="judul-text mt-5 mt-xl-0">Pangkat Dan Golongan</h3>
                            <hr style=" height:.1rem;" class="bg-primary">
                            @livewire('pegawai.pangkat-dan-golongan')
                        </div>

                    </div>

                    <hr>
                    <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary">kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    @livewireScripts
@endpush
