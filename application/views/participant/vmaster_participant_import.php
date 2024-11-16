<style>
	.grid_image {
		text-align: center;
		display: none;
	}

	p {
		margin-bottom: 0;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Import Participant</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Main</a></li>
						<li class="breadcrumb-item">Setting</li>
						<li class="breadcrumb-item"><a href="<?= base_url() . 'report/participant'; ?>">Participant</a></li>
						<li class="breadcrumb-item active">Import</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container-fluid">
			<?php if ($this->session->flashdata('global')) {
				unset($_SESSION['global']);
			} ?>
			<!-- <div class="mb-2">
				<a href="<?= base_url() . 'master/plant_add' ?>" class="btn btn-primary mr-2 mb-2">Add New Equipment</a>
			</div> -->
			<form action="<?= base_url() . 'report/import' ?>" id="form-add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> <!-- CSRF protection untuk form -->
				<div class="row">
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-12 mb-2">
										<label>Upload File Excel</label><span class="text-danger">*</span>
										<input class="form-control mr-2" type="file" name="file">
										<div class="text-right">
											<span class="text-muted font-italic"><span class="text-danger">*</span> please upload excel file</span>
										</div>
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
</script>