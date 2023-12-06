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
                    <div class="flex-fill card shadow-sm my-2 mx-1">
                        <a href="{{ route('admin.reminder.sip.index') }}" class="text-decoration-none">
                            <div class="card-body p-3" style="color: #2d7430">
                                <div class="row align-items-center">
                                    <h5 class="text-sm mb-0 font-weight-bold">
                                        Reminder SIP Pegawai</h5>
                                    <div class="col-6 mt-">
                                        <div class="numbers">
                                            <i class="far fa-file-alt fa-5x"></i>
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
                    <div class="card-body ">
                        <div class="chart-donuts pt-4">
                            <div id="donut_chart"></div>
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
                    <div class="card-body ">
                        <div class="keaktifan_chart pt-4">
                            <div id="keaktifan_chart"></div>
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
                           
                            <hr>
                            </p>
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    
                                    <img src="{{$item->jenis_kelamin == 'laki-laki' ? 'https://bootdey.com/img/Content/avatar/avatar7.png' : asset('image/perempuan.jpg')}}" width="100px" height="100px"
                                        alt="" class="rounded-circle">
                                </div>
                                <div class="col-md-8 my-2">
                                    <h6><em>{{ Carbon\Carbon::parse($item->tanggal_lahir)->year(date('Y'))->translatedFormat('l, j F Y') }}</em>
                                    </h6>
                                    <p> <b>{{ $item->nama_lengkap ?? $item->nama_depan }} </b>Berulang tahun hari ini, Kirim
                                        <a href="#" class="badge bg-info text-white">Pesan</a> untuk mengucapkan
                                        Selamat Ulang Tahun
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1> Tidak ada yang berulang tahun dalam seminggu ini </h1>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
        <script type="text/javascript">
       
            $(document).ready(function() {
                // var pegawai = <?php echo json_encode($pegawais); ?>;
               var pegawai = @json($pegawais, JSON_HEX_TAG);
                var options = {
                    chart: {
                        renderTo: 'donut_chart',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                    },
                    title: {
                        text: 'Persentase Status Tenaga Pegawai'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b> {point.percentage}%</b>',
                        percentageDecimals: 1,
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectColor: '#000000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + this.percentage + '%';
                                }
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'pegawai',
                    }]

                }
                myarray = [];
                $.each(pegawai, function(index, val) {
                    myarray[index] = [val.status_tipe, val.count];
                });
                options.series[0].data = myarray;
                chart = new Highcharts.Chart(options);

            });
            $(document).ready(function() {

                // var pegawai = <?php echo json_encode($pegawai); ?>;
               var pegawai = @json($pegawai, JSON_HEX_TAG);
                var options = {
                    chart: {
                        renderTo: 'keaktifan_chart',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                    },
                    title: {
                        text: 'Persentase Status Aktif Pegawai'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b> {point.percentage}%</b>',
                        percentageDecimals: 1,
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectColor: '#000000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + this.percentage + '%';
                                }
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'pegawai',
                    }]

                }
                myarray = [];
                $.each(pegawai, function(index, val) {
                    myarray[index] = [val.status_pegawai, val.count];
                });
                options.series[0].data = myarray;
                chart = new Highcharts.Chart(options);

            });
        </script>
    @endpush
@endsection 

