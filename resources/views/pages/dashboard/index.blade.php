@extends('main', ['title' => 'Dashboard'])
@push('style-css')
    
    @livewireStyles
@endpush
@push('script')
    @livewireScripts
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Dashboard</h2>
            </div>
            <div class="col-md-6 col-sm-12">
                @livewire('search')

            </div>
        </div>
        <div class="row mt-5">

            <div class="col-md-8">
                <div class="d-md-flex justify-content-between">
                    <div class="flex-fill card shadow-sm my-2">
                        <a href="{{ route('admin.reminder.str.index') }}" class="text-decoration-none">
                            <div class="card-body p-3" style="color: #2d7430;">
                                <div class="row align-items-center">
                                    <h5 class="text-sm mb-0 font-weight-bold">
                                        Reminder STR Pegawai</h5>
                                    <div class="col-8 mt-4">
                                        <div class="numbers">
                                            <i class="far fa-file fa-4x"></i>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <h1>{{ $reminderSTR }}</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="flex-fill card shadow-sm my-2 mx-1">
                        <a href="{{ route('admin.reminder.sip.index') }}" class="text-decoration-none">
                            <div class="card-body p-3" style="color: #2d7430">
                                <div class="row align-items-center">
                                    <h5 class="text-sm mb-0 font-weight-bold">
                                        Reminder SIP Expired</h5>
                                    <div class="col-8 mt-4">
                                        <div class="numbers">
                                            <i class="far fa-file-alt fa-4x"></i>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <h1>{{ $reminderSIP }}</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Donut Chart -->
                <div class="card shadow-sm mb-4 mt-2">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 text-center" style="background-color: #2d7430">
                        <h6 class="m-0 font-weight-bold text-white">Grafik Perbandingan Jumlah
                            PNS, PPPK, dan Non ASN</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body d-md-flex">
                        <div class="chart-pie pt-4">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Donut Chart -->
                <div class="card shadow-sm mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 text-center" style="background-color: #2d7430">
                        <h6 class="m-0 font-weight-bold text-white">Grafik Perbandingan Pegawai
                            Aktif dan Tidak Aktif hari ini</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body d-md-flex">
                        <div class="chart-pie pt-4">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h6 style="font-weight: bold;">Ulang Tahun</h6>
                <!-- reminder ulang tahun -->
                <div class="container-fluid bg-white shadow-sm rounded mb-4 py-4">
                    @if (count($dataPegawaiUlangtahun) > 0)
                        @foreach ($dataPegawaiUlangtahun as $item)
                            {{-- <p>{{date('l j F ', strtotime($item->tanggal_lahir))}}<hr></p> --}}
                            <p>{{ Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('l, j F') . ' ' . now()->format('Y') }}
                                <hr>
                            </p>
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <img src="{{ asset('./tampilan-sikepeg/img/foto.png') }}" width="100px" height="100px"
                                        alt="" class="rounded-circle">
                                </div>
                                <div class="col-md-8 my-2">
                                    <h6><em>{{ Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('l, j F') . ' ' . now()->format('Y') }}</em>
                                    </h6>
                                    <p> <b>{{ $item->nama_lengkap ?? $item->nama_depan }} </b>Berulang tahun hari ini, Kirim
                                        <a href="#" class="badge bg-info text-white">Pesan</a> untuk mengucapkan
                                        Selamat Ulang Tahun</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1> Tidak ada yang berulang tahun dalam seminggu ini </h1>
                    @endif
                </div>
                <!-- reminder ulang tahun end -->
            </div>
        </div>
    </div>
@endsection
