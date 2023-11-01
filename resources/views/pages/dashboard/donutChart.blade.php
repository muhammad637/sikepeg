<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Make Donut Chart In Laravel 9</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


</head>
<body>
	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Make Donut Chart In Laravel 9</h3>
					</div>
					<div class="panel-body" align="center">
						<div id="donut_chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>

	<script type="text/javascript">
		$(document).ready(function(){
            console.log(donut_chart)

			var pegawai = <?php echo json_encode($pegawai); ?>;
			var options = {
				chart : {
					renderTo : 'donut_chart',
					plotBackgroundColor : null,
					plotBorderWidth : null,
					plotShadow : false,
				},
				title :{
					text:'Percentage of pegawais courses'
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
					name:'pegawai'
				}]

			}
			myarray = [];
			$.each(pegawai, function(index, val) {
				myarray[index] = [val.course,val.count];
			});
			options.series[0].data = myarray;
			chart = new Highcharts.Chart(options);
		});
	</script>

 
