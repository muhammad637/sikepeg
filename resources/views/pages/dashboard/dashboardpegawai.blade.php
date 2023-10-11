@extends('mainpegawai')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2>Dashboard</h2>
            </div>

        </div>
        <div class="row mt-5">

            <div class="col-xl-4">
                <div class="flex-fill card shadow-sm my-auto mx-2">
                    <div class="card-body p-3" style="color: #2d7430;">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-md-12">
                                <h5 class="text-sm font-weight-bold">
                                    Pangkat/Golongan Saat Ini</h5>
                            </div>
                            <div class="col">
                                <a href="{{ route('pegawai.kenaikanpangkat.riwayat', ['pegawai' => $pegawai->id]) }}" class="text-right mx-auto font-weight-bold d-block" style="color: #459AFF;">
                                    View All
                                </a> 
                                    
                            </div>



                        </div>
                        <div class="text-center">
                            @if ($pegawai->status_tipe == 'pns')
                                <p>
                                    {{ $KenaikanPangkat ? $KenaikanPangkat->nama_pangkat : ($pegawai->pangkat_id ? $pegawai->pangkat->nama_pangkat : 'junior') }}
                                    //
                                    {{ $KenaikanPangkat ? $KenaikanPangkat->nama_golongan : ($pegawai->golongan_id ? $pegawai->golongan->nama_golongan : 'junior') }}
                                </p>
                            @elseif($pegawai->status_tipe == 'pppk')
                                <p>
                                    {{ $KenaikanPangkat ? $KenaikanPangkat->nama_golongan : ($pegawai->golongan_id ? $pegawai->golongan->nama_golongan : 'junior') }}
                                </p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="flex-fill card shadow-sm my-2 mx-2">
                    <div class="card-body p-3" style="color: #2d7430">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-md-12">
                                <h5 class="text-sm font-weight-bold">
                                    Ruangan Saat Ini</h5>
                            </div>
                            <div class="col">
                                <a href="{{ route('pegawai.mutasi.history', ['pegawai' => $pegawai->id]) }}" class="text-right mx-auto font-weight-bold d-block" style="color: #459AFF;">
                                    View All
                                </a> 
                                    
                            </div>

                        </div>
                        <div class="text-center">

                            <p>
                                {{ $Mutasi ? $Mutasi->ruangan_tujuan : ($pegawai->mutasi_id ? $pegawai->mutasi->ruangan_tujuan : 'tidak ada') }}
                            </p>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="flex-fill card shadow-sm my-2 mx-2">
                    <div class="card-body p-3" style="color: #2d7430">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-md-12">
                                <h5 class="text-sm font-weight-bold">
                                    Diklat Saat Ini</h5>
                            </div>
                            <div class="col">
                                <a href="" class="text-right mx-auto font-weight-bold d-block" style="color: #459AFF;">
                                    View All
                                </a> 
                                    
                            </div>

                        </div>
                        <div class="text-center">
                            <p>
                                {{ $Diklat ? $Diklat->nama_diklat : ($pegawai->diklat_id ? $pegawai->diklat->nama_diklat : 'tidak ada') }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            @if ($pegawai->jenis_tenaga == 'nakes')
           <div class="col-xl-4">
            <div class="flex-fill card shadow-sm my-auto mx-2">
                <div class="card-body p-3" style="color: #2d7430;">
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-md-12">
                            <h5 class="text-sm mb-0 font-weight-bold">
                                Reminder STR Expired</h5>
    
                        </div>
                        <div class="col">
                            <a href="" class="text-right mx-auto font-weight-bold d-block" style="color: #459AFF;">
                                View All
                            </a> 
                                
                        </div>
                        
                    </div>
                    <div class="text-center">
                        <p>
                            -
                        </p>
                    </div>
                </div>
            </div>
           </div>
                    <div class="col-xl-4">
                        <div class="flex-fill card shadow-sm my-2 mx-2">
                            <div class="card-body p-3" style="color: #2d7430">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 col-md-12">
                                        <h5 class="text-sm mb-0 font-weight-bold">
                                            Reminder SIP Expired</h5>
                                    </div>
                                    <div class="col">
                                        <a href="" class="text-right mx-auto font-weight-bold d-block" style="color: #459AFF;">
                                            View All
                                        </a> 
                                            
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p>
                                        -
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
             
            @endif

        </div>

    </div>
@endsection
