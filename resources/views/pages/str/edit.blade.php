@extends('main',['title'=>'Edit STR'])

@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    @livewireStyles
@endpush
@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">STR</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Edit Data STR</h4>
        <hr>
        <form action="{{ route('admin.str.update', ['str' => $str->id]) }}" method="post">
            @method('put')
            @csrf


            <div class="row mt-2">
                <div class="col-sm-12 col-xl-12">

                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Nama</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="select2" name="pegawai_id">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($results as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ $str->pegawai->id == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @livewire('pegawai.search-pegawai', ['dokumen' => 'str', 'pegawaiEdit' => $str->pegawai_id])

                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">No. STR</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3"
                                value="{{ old('no_str', $str->no_str) }}" name="no_str" required>
                        </div>
                    </div>
                    @livewire('s-t-r.search-sip', ['no_sip' => $str->no_sip])
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">Kompetensi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3"
                                value="{{ old('kompetensi', $str->kompetensi) }}" name="kompetensi" required>
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
                                    value="{{ old('tanggal_terbit_str', Carbon\Carbon::parse($str->tanggal_terbit_str)->format('Y-m-d')) }}"
                                    name="tanggal_terbit_str" required>

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
                                    value="{{ old('masa_berakhir_str', Carbon\Carbon::parse($str->masa_berakhir_str)->format('Y-m-d')) }}"
                                    name="masa_berakhir_str" required>

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
                                    value="{{ old('link_str', $str->link_str) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('admin.str.index') }}" class="btn bg-gradient-warning text-white">Tutup</a>
                        <button class="btn bg-gradient-success text-white" type="submit">Simpan</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
    @endsection
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        @livewireScripts
    @endpush
