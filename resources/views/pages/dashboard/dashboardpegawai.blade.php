@extends('mainpegawai')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2>Dashboard</h2>
            </div>

        </div>
        <div class="row mt-5">
            <div class="col-md">
                <div class="d-flex justify-content-between">
                    <div class="flex-fill card shadow-sm my-auto mx-2">
                        <div class="card-body p-3" style="color: #2d7430;">
                            <div class="align-items-center">
                                <h5 class="text-sm mb-0 font-weight-bold">
                                    Pangkat/Golongan Saat Ini</h5>
                                <div class="text-center">
                                    @if ($pegawai->status_tipe == 'pns')
                                    <p>
                                        {{ $KenaikanPangkat ? $KenaikanPangkat->nama_pangkat : ($pegawai->pangkat_id ? $pegawai->pangkat->nama_pangkat : 'junior') }} //  {{ $KenaikanPangkat ? $KenaikanPangkat->nama_golongan : ($pegawai->golongan_id ? $pegawai->golongan->nama_golongan : 'junior') }}
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
                    <div class="flex-fill card shadow-sm my-2 mx-2">
                        <div class="card-body p-3" style="color: #2d7430">
                            <div class=" align-items-center">
                                <h5 class="text-sm mb-0 font-weight-bold">
                                  Ruangan Saat Ini</h5>
                                <div class="text-center">
                                    <p>
                                       {{$pegawai->ruangan}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-fill card shadow-sm my-2 mx-2">
                        <div class="card-body p-3" style="color: #2d7430">
                            <div class="align-items-center">
                                <h5 class="text-sm mb-0 font-weight-bold">
                                    Diklat Saat Ini</h5>
                                <div class="text-center">
                                  <p>
                                    {{ $Diklat ? $Diklat->nama_diklat : ($pegawai->diklat_id ? $pegawai->diklat->nama_diklat : 'tidak ada') }}
                                  </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($pegawai->jenis_tenaga == 'nakes')
                <div class="d-flex justify-content-between">
                    <div class="flex-fill card shadow-sm my-auto mx-2">
                        <div class="card-body p-3" style="color: #2d7430;">
                            <div class="row align-items-center">
                                <h5 class="text-sm mb-0 font-weight-bold">
                                    Reminder STR Expired</h5>

                                <div class="col text-center">
                                    <h1>-</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-fill card shadow-sm my-2 mx-2">
                        <div class="card-body p-3" style="color: #2d7430">
                            <div class="row align-items-center">
                                <h5 class="text-sm mb-0 font-weight-bold">
                                    Reminder SIP Expired</h5>

                                <div class="col text-center">
                                    <h1>-</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
@endsection
