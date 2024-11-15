<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Basic Line Chart using ECharts</title>



	<!-- include ECharts library -->
	<script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
</head>

<body>
	<div id="main" style="width: 600px; height:400px;"></div>
	<script type="text/javascript">
		// initialize ECharts instance
		var myChart = echarts.init(document.getElementById('main'));

		var measure_time = [
			'2023-01-01 07:00',
			'2023-01-01 07:01',
			'2023-01-01 07:02',
			'2023-01-01 07:03',
			'2023-01-01 07:04',
			'2023-01-01 07:05',
			'2023-01-01 07:06',
			'2023-01-01 07:07',
			'2023-01-01 07:08',
			'2023-01-01 07:09',
			'2023-01-01 07:10',
			'2023-01-01 07:11',
			'2023-01-01 07:12',
			'2023-01-01 07:13',
			'2023-01-01 07:14'
		];

		const length = 15;
		const numbers = new Array(length).fill().map(() => Math.floor(Math.random() * 101));

		console.log(numbers);
		console.log(measure_time);
	</script>
	<script type="text/javascript">
		// initialize ECharts instance
		var myChart = echarts.init(document.getElementById('main'));

		// specify chart configuration item and data
		var option = {
			tooltip: {
				trigger: 'axis',
				axisPointer: {
					animation: false
				},
				formatter: function(params) {
					var date = new Date(params[0].value[0]);
					return date.toLocaleDateString() + '<br />' + params[0].seriesName + ': ' + params[0].value[1];
				}
			},
			legend: {
				data: ['Sales']
			},
			xAxis: {
				type: 'category',
				axisLabel: {
					formatter: function(value, index) {
						var date = new Date(value);
						return date.toLocaleDateString();
					}
				}
			},
			yAxis: {
				type: 'value',
			},
			series: [{
				name: 'Sales',
				type: 'line',
				
			}]
		};

		// use configuration item and data specified to show chart
		myChart.setOption(option);
	</script>
</body>

</html>