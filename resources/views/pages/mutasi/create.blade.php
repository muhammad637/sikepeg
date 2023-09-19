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
    <div class="card">
        <div class="px-4">
            <div class="card-body">
                <h1 class="fw-bold mb-4 mt-3 text-uppercase judul-text">Mutasi</h1>
                <hr style="background: black; height:.2rem;" class="mt-3 mb-5">
                <form action="{{ route('mutasi.store') }}" method="post">
                    @csrf
                    <div class="row mt-5 judul-text">
                        
                        <div class="col-md-12 col-lg-12 col-xl-6 ">
                            
                            <h3 class="judul-text">Tambah Mutasi Pegawai</h3>
                            <hr style="background: black; height:.2rem;" class="mt-3 mb-5">
                            
                            <div class="mb-4">
                                @livewire('mutasi.jenis-mutasi')   
                            </div>
                            
                            
                           
                          
                        </div>


                    </div>

                    <hr>
                    <a href="{{ route('mutasi.index') }}" class="btn btn-secondary mx-auto">kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    @livewireScripts
@endpush
