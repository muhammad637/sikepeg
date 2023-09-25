@extends('main')

@section('content')
    @push('style-css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
        @livewireStyles
    @endpush
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">STR</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Edit Data STR</h2>
        <hr>
        <form action="{{ route('str.update', ['str' => $str->id]) }}" method="post">
            @method('put')
            @csrf


            <div class="row mt-2">
                <div class="col-sm-12 col-xl-12">
                    {{-- <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Nama</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" value="{{ $str->pegawai->nama_depan }}" class="form-control"
                                placeholder="NIP" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">NIK</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" value="{{ $str->pegawai->nik }}" class="form-control" placeholder="NIK"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">NIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <input type="text" value="{{ $str->pegawai->nip_nippk }}" class="form-control"
                                placeholder="NIP" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="Ruangan" class="col-sm-4 col-form-label">Ruangan</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{ $str->pegawai->ruangan }}" class="form-control"
                                id="inputPassword3" readonly placeholder="ruangan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ttl" class="col-sm-4 col-form-label">Tempat Tanggal
                            Lahir</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" readonly
                                placeholder="tempat tanggal lahir"
                                value="{{ $str->pegawai->tempat_lahir . ', ' . Carbon\Carbon::parse($str->pegawai->tanggal_lahir)->format('d-M-Y') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" readonly placeholder="jenis kelamin"
                                {{ $str->pegawai->jenis_kelamin }}>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noIjasah" class="col-sm-4 col-form-label">No Ijazah </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3" readonly placeholder="no ijazah"
                                {{ $str->pegawai->no_ijazah }}>
                        </div>
                    </div> --}}
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Nama</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="select2" name="asn_id">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($results as $pegawai)
                                    <option value="{{$pegawai->id}}"
                                        {{  $str->pegawai->id  == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @livewire('pegawai.search-pegawai', ['dokumen' => 'str', 'pegawaiedit' => $str->pegawai_id])
                    {{-- <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Tanggal Lulus</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" readonly placeholder="tanggal lulus"
                                    value="{{ $str->pegawai->tanggal_lulus }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="perguruanTinggi" class="col-sm-4 col-form-label">Perguruan Tinggi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3"
                                value="{{ $str->pegawai->sekolah }}" readonly placeholder="perguruan tinggi">
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">No. STR</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3"
                                value="{{ old('no_str', $str->no_str) }}" name="no_str">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">Kompetensi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3"
                                value="{{ old('kompetensi', $str->kompetensi) }}" name="kompetensi">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">No. Sertifikat Kompetensi</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3"
                                value="{{ old('no_sertikom', $str->no_sertikom) }}" name="no_sertikom">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Tanggal Terbit</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" id="date" style="height: 90%;"
                                    value="{{ old('tanggal_terbit_str', $str->tanggal_terbit_str) }}"
                                    name="tanggal_terbit_str">

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Masa Berakhir</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" id="date" style="height: 90%;"
                                    value="{{ old('masa_berakhir_str', $str->masa_berakhir_str) }}"
                                    name="masa_berakhir_str">

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Upload URL STR</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" name="link str"
                                    value="{{ old('link_str', $str->link_str) }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('str.index') }}" class="btn bg-gradient-warning text-white">Tutup</a>
                        <button class="btn bg-gradient-success text-white" type="submit">Simpan</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        @livewireScripts
    @endpush
@endsection
