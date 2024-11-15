<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs4/1.11.4/dataTables.bootstrap4.min.css" integrity="sha512-PtMN9IfbDiW41+IT7U23EZ/jPCyTRQgH8qGO2JXfodGnkntT2VlfKFcE8Oe4ZQyfAj8UPlQ+D2zKpZ/h52JcNg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.9/responsive.bootstrap4.min.css" integrity="sha512-Kep8UHrRwnogj5OXG/g6ZXsfOtdFwJBhcEkEKIKZfiiedZmjwVH3JAyPM3Ag4x6xG1DYf+U/Uu/MFCMkQh+eWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<!-- DataTables  & Plugins -->
<!-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs4/1.11.4/dataTables.bootstrap4.min.js" integrity="sha512-9o2JT4zBJghTU0EEIgPvzzHOulNvo0jq2spTfo6mMmZ6S3jK+gljrfo0mKDAxoMnrkZa6ml2ZgByBQ5ga8noDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-responsive/2.2.9/dataTables.responsive.min.js" integrity="sha512-4knl+8+KWBNyMb27V1fosX42eCyJFH383Sus6gnxuqzwmQpiLpyBJyuC17RRwLd5X6cmVUQeT5lOkVXbwajvCA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Echarts -->
<!-- <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.1/dist/echarts.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>

<!-- Apex Charts -->
<!-- <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/apex/apexcharts.css"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

<style>
	.filter-list .form-group {
		margin-right: 0.75rem;
		/* min-width: 150px; */
	}

	.filter-list .btn {
		line-height: 1.6;
	}

	.table-min td {
		padding-top: 0.25rem;
		padding-bottom: 0.5rem;
	}

	.tr-good td {
		/* background-color: var(--color-success); */
		/* color: #fff; */
		background-color: #e8faec;
	}

	.tr-warning td {
		/* background-color: var(--color-warning); */
		/* color: #fff; */
		background-color: #fdf2df;
	}

	.tr-danger td {
		/* background-color: var(--color-danger); */
		/* color: #fff; */
		background-color: #f9dcdf;
	}
</style>

<body onresize="resizeChart()">
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Detail <?= strtoupper(substr($id, 0, 1) . "-" . substr($id, 1, 2)) ?></h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Main</a></li>
							<li class="breadcrumb-item active">Detail</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<form id="form-add" method="post" action="<?= base_url() . 'detail/filter' ?>">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<!-- <input type="hidden" name="i_id" value="<?= $id ?>" /> -->
							<div class="d-flex filter-list">
								<div class="form-group">
									<label for="">Date</label>
									<div class="input-group date" id="fromdate" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input" data-target="#fromdate" name="i_date" />
										<div class="input-group-append" data-target="#fromdate" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Line</label>
									<select autofocus="" id="i_id_line" name="i_id_line" class="form-control">
										<?php foreach ($row as $key => $value) { ?>
											<option value="<?= $value['line_name'] ?>" <?php if($id == $value['line_name']) echo "selected=selected"; ?>>
												<?= ucfirst($value['line_name']) ?>
											</option>
										<?php } ?>		
									</select>
								</div>
								<div class="form-group">
									<label>&nbsp;</label><br>
									<button type="submit" form="form-add" value="1" id="btn_submit" name="submit" class="btn btn-primary"> Submit</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header bg-gray">
								<div class="card-title">
									<h5>Pressure</h5>
								</div>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<!-- <div class="float-left">
										<select class="form-control">
											<option>Panel 1</option>
											<option>Panel 2</option>
											<option>Panel 3</option>
											<option>Panel 4</option>
										</select>
									</div> -->
								</div>
								<div id="chart1" style="height: 350px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content-wrapper -->
</body>

<!-- Page level script -->
<script>
	function format_time(time) {
		var d = new Date(time),
			h = (d.getHours() < 10 ? '0' : '') + d.getHours(),
			m = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
		s = (d.getSeconds() < 10 ? '0' : '') + d.getSeconds();
		return value = h + ':' + m + ':' + s;
	}

	function set_color(idx, dom_id, value, warn, damg) {
		if (value < warn) {
			$(dom_id).removeClass("text-warning text-danger");
			$(dom_id).addClass("text-success");
		} else if (value < damg) {
			$(dom_id).removeClass("text-success text-danger");
			$(dom_id).addClass("text-warning");
		} else {
			$(dom_id).removeClass("text-warning text-success");
			$(dom_id).addClass("text-danger");
		}
	}

	function resizeChart() {
		chart1.resize();
		chart2.resize();
	}
</script>

<script>
	var dateNow = new Date('<?= $date ?>');
	//Date picker
	$('#fromdate').datetimepicker({
		format: 'YYYY-MM-DD',
		defaultDate: dateNow
	});
</script>

<script>
	const chartdata = <?= json_encode($chart) ?>;
	var device = <?= json_encode($device) ?>;
	var arr_dev = [];

	var series = [];
	var seri = [];
	var no_data = true;
	var idx_dataset = 0;

	var press1_x = [];
	var press1_y = [];

	var press2_x = [];
	var press2_y = [];

	var press3_x = [];
	var press3_y = [];

	if (chartdata['pressure'].length > 0) {
		chartdata['pressure'][0].forEach(element => {
			press1_x.push(element.x);
			press1_y.push(element.y);
		});

		chartdata['pressure'][1].forEach(element => {
			press2_x.push(element.x);
			press2_y.push(element.y);
		});

		if(chartdata['pressure'].length > 2){
			chartdata['pressure'][2].forEach(element => {
				press3_x.push(element.x);
				press3_y.push(element.y);
			});
		}
		no_data = false;
	}

	device.forEach(element => {
		seri = {
			type: 'line',
			showSymbol: false,
			name: device[idx_dataset]['device_name'],
			datasetIndex: idx_dataset,
			encode: {
				x: 'x',
				y: 'y'
			}
		}
		series.push(seri);
		arr_dev.push(element.device_name);
		idx_dataset++;
	});

	option = {
		title: {
			show: no_data,
			textStyle:{
				color:'#bcbcbc'
			},
			text: 'No data available',
			left: 'center',
			top: 'center'
		},
		tooltip: {
			trigger: 'axis'
		},
		legend: {
			data: arr_dev
		},
		grid: {
			left: '3%',
			right: '4%',
			bottom: '3%',
			containLabel: true
		},
		toolbox: {
			// feature: {
			// 	saveAsImage: {}
			// }
		},
		dataset: [{
				source: {
					x: press1_x,
					y: press1_y
				}
			},
			{
				source: {
					x: press2_x,
					y: press2_y
				}
			},
			{
				source: {
					x: press3_x,
					y: press3_y
				}
			}
		],
		xAxis: {
			// show: true,
			type: 'category',
			// data: time,
			// axisLabel: {
			// 	formatter: (function(value) {
			// 		return moment(value).format('HH:mm');
			// 	})
			// }
		},
		yAxis: {
			type: 'value'
		},
		series: series
	};

	const e_chart1 = document.getElementById('chart1');
	const chart1 = echarts.init(e_chart1);
	chart1.setOption(option);
</script>