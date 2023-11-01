@extends('main',['title'=>'Dashboard'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h2>Dashboard</h2>
        </div>
        <div class="col-md-6 col-sm-12">
            <form
                class=" d-sm-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{route('admin.pegawai.searchPegawai')}}" method="get">
                @csrf
                <div class="input-group shadow-sm" style="border: 1px solid rgb(139, 139, 139);">
                    <div class="input-group-append">
                        <button class="btn" type="button" style="background-color: #2d7430; color: white;">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-white border-0 small"
                        placeholder="Keyword : [Nama Pegawai] [NIP] [Ruangan] [Status Tenaga]" aria-label="Search" aria-describedby="basic-addon2" name="search" required>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-8">                                                            
            <div class="d-md-flex justify-content-between">
                <div class="flex-fill card shadow-sm my-2">
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
                                <h1>{{0}}</h1>
                            </div>
                        </div>
                    </div>
                </div>                                
                <div class="flex-fill card shadow-sm my-2 mx-1">
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
                                <h1>{{0}}</h1>
                            </div>
                        </div>
                    </div>
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
                        Aktif dan Tidak Aktif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body d-md-flex">
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
                {{-- @foreach ($dataPegawaiUlangtahun as $item) --}}
                {{-- <p>{{date('l j F ', strtotime($item->tanggal_lahir))}}<hr></p> --}}
                {{-- <p>{{Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('l, j F'). ' '.now()->format('Y')}}<hr></p> --}}
                <div class="row">
                    <div class="col-md-4 my-2">
                        <img src="{{asset('./tampilan-sikepeg/img/foto.png')}}" width="100px" height="100px" alt="" class="rounded-circle">
                    </div>
                    <div class="col-md-8 my-2">
                        {{-- <h6><em>{{Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('l, j F'). ' '.now()->format('Y')}}</em></h6> --}}
                        {{-- <p> <b>{{$item->nama_lengkap ?? $item->nama_depan}} </b>Berulang tahun hari ini, Kirim <a href="#" class="badge bg-info text-white">Pesan</a>  untuk mengucapkan Selamat Ulang Tahun</p> --}}
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>                            
            <!-- reminder ulang tahun end -->
        </div>
    </div>
</div>
@push('script')
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
	<script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
           
			var pegawai = <?php echo json_encode($pegawais); ?>;
			var options = {
				chart : {
					renderTo : 'donut_chart',
					plotBackgroundColor : null,
					plotBorderWidth : null,
					plotShadow : false,
				},
				title :{
					text:'Persentase Status Tenaga Pegawai'
				},
				tooltip:{
					pointFormat : '{series.name}: <b> {point.percentage}%</b>',
					percentageDecimals:1,
				},
				plotOptions:{
					pie:{
						allowPointSelect:true,
						cursor:'pointer',
						dataLabels:{
							enabled:true,
							color:'#000000',
							connectColor:'#000000',
						    	formatter:function(){
								return '<b>' + this.point.name + '</b>: ' + this.percentage + '%';
							}
						}
					}
				},
				series:[{
					type:'pie',
					name:'pegawai',
				}]

			}
			myarray = [];
			$.each(pegawai, function(index, val) {
				 myarray[index] = [val.status_tipe,val.count];
			});
			options.series[0].data = myarray;
			chart = new Highcharts.Chart(options);
            
		});
        $(document).ready(function(){
           
           var pegawai = <?php echo json_encode($pegawai); ?>;
           var options = {
               chart : {
                   renderTo : 'keaktifan_chart',
                   plotBackgroundColor : null,
                   plotBorderWidth : null,
                   plotShadow : false,
               },
               title :{
                   text:'Persentase Status Aktif Pegawai'
               },
               tooltip:{
                   pointFormat : '{series.name}: <b> {point.percentage}%</b>',
                   percentageDecimals:1,
               },
               plotOptions:{
                   pie:{
                       allowPointSelect:true,
                       cursor:'pointer',
                       dataLabels:{
                           enabled:true,
                           color:'#000000',
                           connectColor:'#000000',
                               formatter:function(){
                               return '<b>' + this.point.name + '</b>: ' + this.percentage + '%';
                           }
                       }
                   }
               },
               series:[{
                   type:'pie',
                   name:'pegawai',
               }]

           }
           myarray = [];
           $.each(pegawai, function(index, val) {
                myarray[index] = [val.status_pegawai,val.count];
           });
           options.series[0].data = myarray;
           chart = new Highcharts.Chart(options);
           
       });
	</script>
    
@endpush
@endsection