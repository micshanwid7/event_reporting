<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?= isset($title) ? $title . ' - ' : ''; ?>Pressure Monitoring | PT Indoserako Sejahtera
	</title>
	<link href="<?php echo base_url('assets'); ?>/dist/img/logo-square.png" rel="shortcut icon" type="image/x-icon">

	<!-- <link href="<?= base_url('assets'); ?>/custom/loader.css" rel="stylesheet" type="text/css" /> -->
	<!-- <script src="<?= base_url('assets'); ?>/custom/loader.js"></script> -->

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

	<!--
	==============================
		Local Assets                 
	==============================
	-->
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">

	<!-- jQuery -->
	<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?= base_url('assets'); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>

	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('assets'); ?>/dist/js/adminlte.js"></script>

	<!--
	==============================
		Cloud Assets                 
	==============================
	-->

	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

	<!-- Override CSS -->
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/custom/override.css">
	<style>
		:root {
			--color-display: #85ffdb;
		}

		body {
			overflow: hidden;
		}

		.img-layout {
			width: 100%;
			object-fit: contain;
			height: calc(1080px - 200px);
		}

		.example {
			width: 100px;
			height: 100px;
			position: absolute;

			border: 2px solid red;
		}

		.note {
			width: auto;
			height: auto;
			position: absolute;
			background-color: var(--color-display);
			padding: 3px;
			font-size: 22px;
			border: 2px solid black;
		}

		.parent {
			width: 100%;
		}

		a:hover {
			background-color: #f2F4F6;
		}

		.circle {
			width: 25px;
			height: 25px;
			border-radius: 50%;
			border: 1px solid black;
			background-color: var(--color-display);
			position: absolute;
		}
	</style>
</head>

<body>
	<div class="">
		<div class="text-center">
			<div class="card">
				<div class="card-header bg-gray">
					<h1 class="m-0"><strong>Pressure Monitoring</strong></h1>
				</div>
			</div>
		</div>
		
		<?php foreach ($row as $key => $value) { ?>
			<div style="width: 477px;display: inline-block;">
				<div class="card">
					<a class="text-dark" href="<?= base_url() . 'detail/panel/' . $key . '/' . date('Y-m-d'); ?>">
						<div class="card-header text-center">
							<h2 class="text-bold m-0"><?= ucfirst($key) ?></h2>
						</div>
					</a>
					<div class="card-body">
						<?php
						$ctr = 1;
						foreach ($value['panel'] as $key2 => $value2) {
						?>
						<!-- <div class="block"></div> -->
							<div class="circle text-center text-bold" style="top: <?= $value2['y_circle'] . "px" ?>; left: <?= $value2['x_circle'] . "px" ?>;"><?= $ctr ?></div>
							<div class="note" style="top: <?= $value2['y_note'] . "px" ?>; left: <?= $value2['x_note'] . "px" ?>;">
								<div class="text-bold text-center" style="border-bottom: 2px solid black;">
									<?= $ctr ?>
								</div>
								<div class="text-bold"><?= $value2['device_name'] ?></div>
								T: <span class="text-bold" id="nbrtemp_<?= $key2 ?>">0.0</span> °C <br>
								H: <span class="text-bold" id="nbrhum_<?= $key2 ?>">0.0</span> %
							</div>
						<?php $ctr++;
						}
						?>
						<img class="img-layout" src="<?php echo base_url() . "uploads/machine_layout/" . $key . ".jpg" ?>" alt="">
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</body>
<script>
	var panel = <?php echo json_encode($row) ?>;
	var panel_list = <?php echo json_encode($row_panel) ?>;

	$(document).ready(function() {
		getLiveData();
		setInterval(function() {
			getLiveData();
			//$(".circle").fadeOut(500).delay(100).fadeIn(500);  
		}, 5000);
	});

	function getLiveData() {
		$.ajax({
			url: "<?= $api_url ?>temp_hum_api",
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				$.each(response.device, function(key, value) {
					// if(key == 17) console.log(value['temp']);
					// incEltNbr("nbrtemp_" + key, value['temp']);
					// incEltNbr("nbrhum_" + key, value['hum']);
					check_treshold_warn(key, value['temp'], value['hum']);
				});
				$("#update").html(response.last_update);
			},
			complete: function() {

			}
		});
	}

	function check_treshold_warn(params, val_temp, val_hum) {
		var warn_pressure = panel_list[params]['warn_pressure'];
		var warn_hum = panel_list[params]['warn_hum'];

		if (parseInt(val_temp) > parseInt(warn_pressure)) {
			$("#nbrtemp_" + params).addClass('text-danger');
		} else {
			$("#nbrtemp_" + params).removeClass('text-danger');
		}

		if (parseInt(val_hum) > parseInt(warn_hum)) {
			$("#nbrhum_" + params).addClass('text-danger');
		} else {
			$("#nnbrhum_" + params).removeClass('text-danger');
		}

		$("#nbrtemp_" + params).html(val_temp);
		$("#nbrhum_" + params).html(val_hum);
	}
</script>

</html>
