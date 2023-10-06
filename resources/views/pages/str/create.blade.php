@extends('main')
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">STR</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Data STR</h2>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.str.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Nama</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="select2" name="asn_id">
                                <option value="">Pilih Nama Pegawai</option>
                                @foreach ($results as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ old($pegawai->id) == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->nama_lengkap ?? $pegawai->nama_depan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @livewire('pegawai.search-pegawai', ['dokumen' => 'str'])
                    {{-- <div class="row mb-3">
                        <label for="noRegister" class="col-sm-4 col-form-label">No Registrasi</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3">
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">No. Registrasi</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3" name="no_str"
                                value="{{ old('no_str') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">Kompetensi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="kompetensi" required
                                value="{{ old('kompetensi') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noSTR" class="col-sm-4 col-form-label">No. Sertifikat Kompetensi</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3" name="no_sertikom" required
                                value="{{ old('no_sertikom') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Tanggal Terbit</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" id="date" name="tanggal_terbit_str"
                                    value="{{ old('tanggal_terbit_str') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Masa Berakhir STR</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" name="masa_berakhir_str"
                                    value="{{ old('masa_berakhir_str') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Upload URL STR</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" name="link str" value="{{ old('link_str') }}"
                                    required>
                            </div>
                        </div>
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('admin.str.index') }}" class="btn bg-warning text-white">Tutup</a>
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
@endpush
