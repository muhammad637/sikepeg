@extends('main',['title'=>'Tambah SIP'])
@push('style-css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <h1 class="" style="color:black;font-weight:bold;">SIP</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h4 class="m-0 font-weight-bold text-dark">Form Tambah Data SIP</h4>
        <hr class="font-weight-bold">
        <form action="{{ route('admin.sip.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark ">Nama</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <select class="form-control" id="select2" name="pegawai_id" required
                                style="max-width:100%;m-width:100%">
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
                    @livewire('pegawai.search-pegawai', ['dokumen' => 'sip'])
                    {{-- <div class="row mb-3">
                        <label for="noRegister" class="col-sm-4 col-form-label">No Registrasi</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputPassword3">
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <label for="noSIP" class="col-sm-4 col-form-label">No. SIP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="no_sip"
                                value="{{ old('no_sip') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noSIP" class="col-sm-4 col-form-label">No. Rekomendasi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="no_rekomendasi"
                                value="{{ old('no_rekomendasi') }}" required>
                        </div>
                    </div>
                   
                    @livewire('s-i-p.search-str')
                    <div class="row mb-3">
                        <label for="penerbitSIP" class="col-sm-4 col-form-label">Penerbit SIP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3" name="penerbit_sip"
                                value="{{ old('penerbit_sip') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Tanggal Terbit SIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" id="date" name="tanggal_terbit_sip"
                                    value="{{ old('tanggal_terbit_sip') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Masa Berakhir SIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control" name="masa_berakhir_sip"
                                    value="{{ old('masa_berakhir_sip') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Tempat Praktik SIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="">
                                <input type="text" class="form-control" name="tempat_praktik"
                                    value="RSUD Blambangan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-2  fw-italic text-end">
                            <span class="mb-0 text-dark " style="text-decoration: none;">Upload URL SIP</span>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" name="link_sip" value="{{ old('link_sip') }}"
                                    required>
                            </div>
                        </div>
                    </div>
        </form>
        <div class="text-right">
            <a href="{{ route('admin.sip.index') }}" class="btn bg-warning text-white">Tutup</a>
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
