<style>
	.grid_image{
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
					<h1 class="m-0">Edit Participant</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Main</a></li>
						<li class="breadcrumb-item">Setting</li>
						<li class="breadcrumb-item"><a href="<?= base_url() . 'report/participant'; ?>">Participant</a></li>
						<li class="breadcrumb-item active">Edit</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container-fluid">
			<form action="" id="form-add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	<!-- CSRF protection untuk form -->	
				<div class="row">
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-6 mb-2">
										<input type="hidden" id="i_id" name="i_id" value="<?php echo set_value('i_id', $edit['id']); ?>" />
										<label>Name</label><span class="text-danger">*</span>
										<div class="">
											<input class="form-control mr-2" id="i_name" name="i_name" autocomplete="off" placeholder="eg: Texturing" value="<?php echo set_value('i_name', $edit['name']); ?>" />
										</div>
										<span class="text-danger"><?php echo form_error('i_name'); ?></span>
									</div>
									<div class="col-6 mb-2">
										<label>Company Name</label><span class="text-danger">*</span>
										<div class="">
											<input class="form-control mr-2" id="i_company_name" name="i_company_name" autocomplete="off" placeholder="eg: Texturing" value="<?php echo set_value('i_company_name', $edit['company_name']); ?>" />
										</div>
										<span class="text-danger"><?php echo form_error('i_company_name'); ?></span>
									</div>								
								</div>
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-6">
										<button type="submit" form="form-add" value="1" id="btn_submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane mr-2"></i> Submit</button>
									</div>
									<div class="col-6 text-right">
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#message_modal"><i class="fa fa-trash mr-2"></i> Delete</button>
									</div>
								</div>
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
