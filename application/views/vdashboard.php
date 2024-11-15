<style>
	h1,h2,h3,h4,h5 {margin: 0;}
	.bg-warning>a, .bg-warning {color: #fff !important;}
	.card-min {
		border: 1px solid #d8d8d8;
		box-shadow: none;
		margin-bottom: 1rem;
		/* border-radius: 10px; */
	}
	.card-link:hover:after {opacity: 1;}
	.card-link:after {
		content: '\A';
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background: rgba(255, 255, 255, 0.3);
		opacity: 0;
		transition: all 0.6s;
		-webkit-transition: all 0.6s;
	}

	.lh {line-height: 0.9;}

	.icon-box {
		/* background-color: #f2f4f6; */
		height: 40px;
		width: 40px;
		display: flex;
		justify-content: center;
		align-items: center;
		border-radius: 6px;
		margin-right: 1rem;
	}

	.icon-box.success {
		border: 2px solid #00a65a;
		color: #00a65a
	}

	.icon-box.warning {
		border: 2px solid #f39c12;
		color: #f39c12
	}

	.icon-box.danger {
		border: 2px solid #f56954;
		color: #f56954
	}

	.vertical-center {
		display: flex;
		align-items: center;
	}

	.w5 {width: 5%;}
	.divider {
		border-bottom: 1px solid #d8d8d8;
	}

	@media screen and (max-width: 1399px) {
		h3 {
			font-size: 14px;
		}
	}
</style>

<body onresize="resizeChart()">
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" id="dashboard_wrapper">
		<div class="content mt-3">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h5 class="m-0">Last Updated : <strong class="" id="update"></strong></h5>
							</div>
						</div>
					</div>
				</div>
				<!-- Global Data -->
				<div class="row">
					<?php foreach ($row as $key => $value) { ?>
						<div class="col-lg-4 col-md-6">
							<div class="card">
								<div class="card-header bg-gray">
									<div class="row">
										<div class="col-6">
											<h5 class="text-bold m-0"><?= strtoupper($key) ?></h5>
										</div>
										<div class="col-6 text-right">
											<?php $date = date('Y-m-d'); ?>
											<div class="card-tools">
												<a type="button" class="btn btn-tool" href="<?= base_url() . 'detail/panel/'. $key . '/' . $date ?>"><i class="fas fa-search"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
											<?php foreach ($value['panel'] as $key2 => $value2) { ?>
											<div class="col-6">
												<h6 class="text-bold mb-2"><?= ucfirst($value2) ?></h6>
												<div class="row">
													<div class="col-12 mb-0">
														<h6 class="m-0"><i class="fa fa-gauge mr-2"></i>Pressure</h6>
														<div class="row">
															<div class="col-12">
																<div id="divtemp_<?= $key2 ?>" class="" style="font-size:20pt;">
																	<span class="text-bold text-primary" id="nbrpress_<?= $key2 ?>">0.0</span> Bar
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="divider mt-1 mb-2"></div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content-wrapper -->
</body>

<!-- Page level script -->
<script>
	var base_url = '<?php echo base_url() ?>';
	var speed = 5;

	var panel_list = <?php echo json_encode($row_panel) ?>;

	$(document).ready(function() {
		getLiveData();
		setInterval(function() {
			getLiveData();
		}, 5000);
	});
	
	function getLiveData() {
		$.ajax({
			url: "<?= $api_url ?>pressure_api",
			// url: base_url + "dummy/dash",
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				$.each(response.device, function(key, value) {
					check_treshold_warn(key, value['pressure']);
				});
				$("#update").html(response.last_update);
			},
			complete: function() {

			}
		});
	}

	function check_treshold_warn(params, val_pressure) {
		var lower_warn_pressure = panel_list[params]['lower_warn_pressure'];
		var upper_warn_pressure = panel_list[params]['upper_warn_pressure'];

		if(parseFloat(val_pressure) >= parseFloat(lower_warn_pressure) && parseFloat(val_pressure) <= parseFloat(upper_warn_pressure)){
			$("#nbrpress_" + params).removeClass('text-danger').addClass('text-primary');
		}else{
			$("#nbrpress_" + params).removeClass('text-primary').addClass('text-danger');
		}

		$("#nbrpress_" + params).html(val_pressure);
	}

	function resizeChart() {
		//chart_history.resize();
		//chart_pie_0.resize();
	}
</script>