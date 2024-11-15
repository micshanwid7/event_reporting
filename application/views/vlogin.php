<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event Reporting | Log in</title>

	<!-- Local Assets -->
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/custom/override.css">

	
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/custom/override.css">
	<style>
		.login-page {
			justify-content: unset;
			padding-top: 20vh;
		}
	</style>
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>Event</b> Reporting</a>
		</div>
		<!-- /.login-logo -->
		<div class="card py-4">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Sign in to start your session</p>

				<form method="post">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Username" name="username" id="txt_username" autocomplete="off" value="<?php echo set_value('username'); ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" value="<?php echo set_value('password'); ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-8">

						</div>
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block" name="submit" value="1">Sign In</button>
						</div>
					</div>
				</form>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->



	<!-- jQuery -->
	<!-- <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Bootstrap 4 -->
	<!-- <script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->

	<!-- Toastr -->
	<!-- <script src="<?= base_url('assets'); ?>/plugins/toastr/toastr.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- AdminLTE App -->
	<!-- <script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js" integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>
		$(document).ready(function() {
			document.getElementById("txt_username").focus();
		});
		<?php if ($this->session->flashdata('login')) { ?>
			toastr.error('<?= $this->session->flashdata('login'); ?>');
		<?php } ?>
		// </?php if ($this->session->flashdata('login') == 'no_username') { ?>
		// 	toastr.error("Username not found");
		// </?php } else if ($this->session->flashdata('login') == 'wrong_password') { ?>
		// 	toastr.error("Wrong Password");
		// </?php } else if ($this->session->flashdata('login') == 'lost_conn') { ?>
		// 	toastr.error("Lost connection to data server");
		// </?php } ?>
	</script>


</body>

</html>
