@extends('main')
@push('style-css')
@endpush
@section('content')
    <!-- Begin Page Content -->
    <h1 class="mx-4 px-4" style="color:black;font-weight:bold;">Cuti</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Detail Cuti Pegawai</h2>
        <hr class="font-weight-bold">
       <div>
    <form action="#" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row mb-3">

                    <label for="noSIP" class="col-sm-4 col-form-label">Pegawai</label>
                    <div class="col-sm-8">
                        <select name="pegawai" class="form-control" id="select2" wire:model="pegawai">
                            @foreach ($result as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_lengkap ?? $item->nama_depan }}
                                    {{ $item->status_tipe }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Jenis Cuti</label>
                    <div class="col-sm-8">
                        <select name="jenis_cuti" id="" class="form-control" wire:model='jenis_cuti'>
                            <option value="" >Pilih </option>
                            @if ($status_tipe == 'pns')
                                <option value="cuti tahunan">Cuti tahunan</option>
                                <option value="cuti besat">Cuti Besar</option>
                                <option value="cuti sakit">Cuti Sakit</option>
                                <option value="cuti melahirkan">Cuti Melahirkan</option>
                            @elseif ($status_tipe == 'pppk')
                                <option value="cuti tahunan">Cuti tahunan</option>
                                <option value="cuti besat">Cuti Besar</option>
                                <option value="cuti sakit">Cuti Sakit</option>
                            @else
                                <option value="cuti tahunan">Cuti tahunan</option>
                                <option value="cuti sakit">Cuti Sakit</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Alasan Cuti</label>
                    <div class="col-sm-8">
                        <textarea name="" class="form-control" id="" cols="30" rows="3">
                        </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Periode Cuti</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="inputPassword3" name="keterangan"
                            value="{{ old('keterangan') }}" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="inputPassword3" name="keterangan"
                            value="{{ old('keterangan') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="noSIP" class="col-sm-4 col-form-label">Jumlah Hari</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword3" name="keterangan"
                            value="{{ old('keterangan') }}" required>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('hariBesar.index') }}" class="btn bg-warning text-white">Tutup</a>
                    <button class="btn btn-info" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>


    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
@endpush
