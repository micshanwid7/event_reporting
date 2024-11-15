<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php ?>
		Program Name | PT Indoserako Sejahtera</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/custom/override.css">
</head>

<body style="background-color: #f2f2f2">
	<div class="">
		<!-- Main content -->
		<section class="content">
			<div class="error-page text-center" style="padding-top: 10vh;">
				<h1 class="text-danger mb-0" style="font-size: 200px;"> 403</h1>
				<div class="">
					<h2><i class="fas fa-skull-crossbones text-danger"></i> </h2>
					<h3>Page forbidden.</h3>
					<p>
						Oh noes, you should not be here!
					</p>
					
					<a href="<?= base_url(); ?>">
						<button class="btn btn-default shadow">
							Return to dashboard
						</button>
					</a>
				</div>
			</div>
		</section>

	</div>
</body>

</html>