
@extends('main',['title'=>'Tambah Kenaikan Pangkat'] )
@push('style-css')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<h1 class="" style="color:black;font-weight:bold;">Kenaikan Pangkat {{$pegawai->nama_lengkap}}</h1>
<div class="card p-4 mx-lg-5 mb-5 ">
    <h4 class="m-0 font-weight-bold text-dark">Form Tambah Data Kenaikan Pangkat</h4>
    <hr class="font-weight-bold">
    <form action="{{ route('admin.kenaikan-pangkat.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                {{-- <div class="row mb-2">
                    <div class="col-sm-4 mb-2  fw-italic text-end">
                        <span class="mb-0 text-dark ">Pegawai</span>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        <select class="form-control" id="pegawai" name="pegawai_id">
                            <option value="">Pilih Nama Pegawai</option>
                            @foreach ($pegawai_select as $item)
                            <option value="{{ $item->id }}" {{ old('pegawai_id', $pegawai->id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_lengkap ?? $item->nama_depan }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <input type="hidden" name="pegawai_id" value="{{$pegawai->id}}">
                <div class="row mb-3">
                    <label for="no_sk" class="col-sm-4 col-form-label">Pegawai</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="no_sk" value="{{$pegawai->nama_lengkap}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_sk" class="col-sm-4 col-form-label">Status Tipe</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="status_tipe" value="{{$pegawai->status_tipe}}" readonly>
                    </div>
                </div>
                @if ($pegawai->status_tipe == 'pns')
                <div class="row mb-3">
                    <label for="pangkat" class="col-sm-4 col-form-label">Pangkat</label>
                    <div class="col-sm-8">
                        <select name="pangkat_id" class="form-control" id="pangkat" wire:ignore
                            wire:model="pangkat_id">
                            <option value="">Pilih</option>
                            @foreach ($pangkat as $item)
                                <option value="{{ $item->id }}"  {{old('pangkat_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_pangkat }}</option>
                            @endforeach
                            <option value="lainnya">Lainnya ....</option>
                        </select>
                    </div>
                </div>
                {{-- <div class="row mb-3 {{ $pangkat_id == 'lainnya' ? '' : 'd-none' }}">
                    <label for="nama_pangkat" class="col-sm-4 col-form-label">Jenis Pangkat Lainnya</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama_pangkat" wire:model='nama_pangkat'
                            {{ $pangkat_id == 'lainnya' ? 'required' : '' }}>
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <label for="golongan" class="col-sm-4 col-form-label">Golongan</label>
                    <div class="col-sm-8">
                        <select name="golongan_id" class="form-control" id="golongan_id" wire:model='golongan_id'>
                            <option value="">Pilih</option>
                            @foreach ($golongan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('golongan_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_golongan }}</option>
                            @endforeach
                            <option value="lainnya">Lainnya ....</option>
                        </select>
                    </div>
                </div>
                {{-- <div class="row mb-3 {{ $golongan_id == 'lainnya' ? '' : 'd-none' }}">
                    <label for="nama_golongan" class="col-sm-4 col-form-label">Jenis Golongan Lainnya</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama_golongan" wire:model='nama_golongan'
                            {{ $golongan_id == 'lainnya' ? 'required' : '' }}>
                        @error('nama_golongan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div> --}}
                {{-- <script>
                    $(document).ready(function() {
                        livewire = new Livewire()
                        $('#pangkat').select2();
                        $('#golongan').select2();
                        livewire.hook('message.processed', (message, component) => {
                            $('#pangkat').select2()
                            $('#golongan').select2()
                        })
                        $('#pangkat').on('change', function() {
                            var data = $('#pangkat').select2('val')
                            @this.set('pangkat_id', data)
                        })
                        $('#golongan').on('change', function() {
                            var data = $('#golongan').select2('val')
                            @this.set('golongan_id', data)
                        })
                    });
                </script> --}}
            @elseif($status == 'pppk')
                <div class="row mb-3">
                    <label for="golongan" class="col-sm-4 col-form-label">Golongan</label>
                    <div class="col-sm-8">
                        <select name="golongan_id" class="form-control" id="golongan" wire:model='golongan_id'>
                            <option value="">Pilih</option>
                            @foreach ($golongan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('golongan') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_golongan }}</option>
                            @endforeach
                            <option value="lainnya">Lainnya ....</option>
                        </select>
                    </div>
                </div>
                {{-- <div class="row mb-3 {{ $golongan_id == 'lainnya' ? '' : 'd-none' }}">
                    <label for="nama_golongan" class="col-sm-4 col-form-label">Jenis Golongan Lainnya</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama_golongan" wire:model='nama_golongan'>
                        @error('nama_golongan')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div> --}}
            @endif
                <div class="row mb-3">
                    <label for="tmt_pangkat" class="col-sm-4 col-form-label">TMT Pangkat</label>
                    <div class="col-sm-4">
                        <label for="" styel="font-size:15px;">Mulai</label>
                        <input type="date" class="form-control" name="tmt_pangkat_dari" required value="{{old('tmt_pangkat_dari')}}">
                    </div>
                    <div class="col-sm-4">
                    <Label for='' style='font-size:15px;'>Selanjutnya</Label>
                        <input type="date" class="form-control" name="tmt_pangkat_sampai" required value="{{old('tmt_pangkat_sampai')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_sk" class="col-sm-4 col-form-label">No SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="no_sk" value="{{old('no_sk')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_sk" class="col-sm-4 col-form-label">Tanggal SK</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="inputPassword3" name="tanggal_sk" value="{{old('tanggal_sk')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit_sk" class="col-sm-4 col-form-label">Penerbit SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="penerbit_sk" value="{{old('penerbit_sk')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="link_sk" class="col-sm-4 col-form-label">Link SK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="link_sk" value="{{old('link_sk')}}">
                    </div>
                </div>
    </form>
    <div class="text-right">
        <a href="{{ route('admin.kenaikan-pangkat.index') }}" class="btn bg-warning text-white">Tutup</a>
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

{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

@endpush