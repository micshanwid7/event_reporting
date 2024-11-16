<style>
	.grid_image {
		text-align: center;
		display: none;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Add New Participant</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Main</a></li>
						<li class="breadcrumb-item">Setting</li>
						<li class="breadcrumb-item"><a href="<?= base_url() . 'report/participant'; ?>">Participant</a></li>
						<li class="breadcrumb-item active">Add</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container-fluid">
			<!-- <div class="mb-2">
				<a href="<?= base_url() . 'master/plant_add' ?>" class="btn btn-primary mr-2 mb-2">Add New Equipment</a>
			</div> -->
			<form action="" id="form-add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> <!-- CSRF protection untuk form -->
				<div class="row">
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-6 mb-2">
										<label>Name</label><span class="text-danger">*</span>
										<div class="">
											<input class="form-control mr-2" id="i_name" name="i_name" autocomplete="off" placeholder="..." value="<?php echo set_value('i_name'); ?>" />
										</div>
										<span class="text-danger"><?php echo form_error('i_name'); ?></span>
									</div>
									<div class="col-6 mb-2">
										<label>Company Name</label><span class="text-danger">*</span>
										<div class="">
											<input class="form-control mr-2" id="i_company_name" name="i_company_name" autocomplete="off" placeholder="..." value="<?php echo set_value('i_company_name'); ?>" />
										</div>
										<span class="text-danger"><?php echo form_error('i_company_name'); ?></span>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" form="form-add" value="1" id="btn_submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane mr-2"></i> Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

<script src="<?= base_url(); ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
	var base_url = '<?php echo base_url() ?>';
	$(function() {
		bsCustomFileInput.init();
	});

	function dupe_check() {
		let x = <?= json_encode($user_list) ?>;
		let ids = $("#i_username").val().toUpperCase();

		if (x != null) {
			x.every((element, index, array) => {
				if (ids == element.username.toUpperCase()) {
					document.getElementById("btn_submit").disabled = true;
					$("#dupe_error").show()
					return false;
				} else {
					document.getElementById("btn_submit").disabled = false;
					$("#dupe_error").hide()
					return true;
				}
			})
		}
	}

	function password_match(event) {
		let pass = $('#txt_password_add').val().toUpperCase();
		let cpass = $('#txt_confirm_pass_add').val().toUpperCase();

		if (pass != cpass) {
			document.getElementById("btn_submit").disabled = true;
			$("#dupe_error_cpass").show()
			return false;
		} else if (cpass == "" || pass == cpass) {
			document.getElementById("btn_submit").disabled = false;
			$("#dupe_error_cpass").hide()
			return true;
		}
	}
</script>