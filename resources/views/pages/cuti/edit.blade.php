@extends('main')
@push('style-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    @livewireStyles
@endpush
@section('content')
    <!-- Begin Page Content -->
    <h1 class="mx-4 px-4" style="color:black;font-weight:bold;">Cuti</h1>
    <div class="card p-4 mx-lg-5 mb-5 ">
        <h2 class="m-0 font-weight-bold text-dark">Detail Cuti Pegawai</h2>
        <hr class="font-weight-bold"> 
          <form action="{{ route('data-cuti-aktif.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row mb-3">
                    <label for="select2" class="col-sm-4 col-form-label">Pegawai</label>
                    <div class="col-sm-8">
                        <select name="pegawai_id" class="form-control" id="select2">
                            @foreach ($pegawai as $item)
                                <option value="{{ $item->id }}" {{$cuti->pegawai_id === $item->id ? 'selected' : '' }}>{{ $item->nama_lengkap ?? $item->nama_depan }}
                                    {{ $item->status_tipe }}
                                </option>
                                @endforeach
                        </select>
                        
                    </div>
                </div>
                @livewire('cuti.cuti-form-edit', ['cuti' => $cuti,'pegawai' => $cuti->pegawai_id])
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
