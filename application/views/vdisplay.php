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
			overflow: scroll;
    		width: 100%;
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
					<h1 class="m-0" id="parentd99"><strong>Pressure Monitoring</strong></h1>
				</div>
			</div>
		</div>
		
		<?php foreach ($row as $key => $value) { ?>
			<div style="width: 473px;display: inline-block;" id="<?= "parent" . $key ?>">
				<div class="card">
					<a class="text-dark" href="<?= base_url() . 'detail/panel/' . $key . '/' . date('Y-m-d'); ?>">
						<div class="card-header text-center">
							<h2 class="text-bold m-0"><?= strtoupper($key) ?></h2>
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
								P: <span class="text-bold" id="nbrpress_<?= $key2 ?>">99.0</span> Bar <br>
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
	var base_url = '<?php echo base_url() ?>';
	var panel = <?php echo json_encode($row) ?>;
	var panel_list = <?php echo json_encode($row_panel) ?>;

	$(document).ready(function() {
		getLiveData();
		var ctr = 0;
		const section = document.getElementById('parentd99');
		const section2 = document.getElementById('parentd4');
		const section3 = document.getElementById('parentd9');
		const section4 = document.getElementById('parentuhs');
		setInterval(function() {
			getLiveData();
			//$(".circle").fadeOut(500).delay(100).fadeIn(500);  
			// switch (ctr) {
			// 	case 0:
			// 		section2.scrollIntoView({ behavior: 'smooth' });
			// 		break;
			// 	case 1:
			// 		section3.scrollIntoView({ behavior: 'smooth' });
			// 		break;
			// 	case 2:
			// 		section4.scrollIntoView({ behavior: 'smooth' });
			// 		break;
			// 	default:
			// 		section.scrollIntoView({ behavior: 'smooth' });
			// 		break;
			// }
			// if(ctr == 3) ctr = 0; else ctr++;
		}, 5000);

	});

	function getLiveData() {
		$.ajax({
			url: "<?= $api_url ?>pressure_api",
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
</script>

</html>