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
					<h1 class="m-0">Edit User</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Main</a></li>
						<li class="breadcrumb-item">Setting</li>
						<li class="breadcrumb-item"><a href="<?= base_url() . 'master/user'; ?>">User</a></li>
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
										<label>Username</label><span class="text-danger">*</span>
										<div class="">
											<input class="form-control mr-2" id="i_username" name="i_username" autocomplete="off" placeholder="eg: Texturing" readonly value="<?php echo set_value('i_username', $edit['username']); ?>" />
										</div>
										<span class="text-danger"><?php echo form_error('i_username'); ?></span>
									</div>
									<div class="col-6 mb-2">
										<label>Name</label><span class="text-danger">*</span>
										<div class="">
											<input class="form-control mr-2" id="i_name" name="i_name" autocomplete="off" placeholder="eg: Texturing" value="<?php echo set_value('i_name', $edit['name']); ?>" />
										</div>
										<span class="text-danger"><?php echo form_error('i_name'); ?></span>
									</div>
									<!-- <div class="col-6 mb-2">
										<label>Password</label>
										<div class="">
											<input type="password" class="form-control mr-2" id="txt_password" name="i_password" autocomplete="off" value="<?php echo set_value('i_password', $edit['password']); ?>" />
										</div>
										<span class="text-danger"><?php echo form_error('i_password'); ?></span>
									</div>
									<div class="col-6 mb-2">
										<label>Confirm Password</label>
										<div class="">
											<input type="password" class="form-control mr-2" id="txt_confirm_pass" name="i_c_password" autocomplete="off" value="<?php echo set_value('i_c_password', $edit['password']); ?>" onkeyup="password_match()" />
										</div>
										<div class="text-danger" id="dupe_error_cpass" style="display:none;">Confirm Password does not match!</div>
										<span class="text-danger"><?php echo form_error('i_c_password'); ?></span>
									</div> -->
									<div class="col-12 mb-2">
										<label>Level</label>
										<select autofocus="" id="i_level" name="i_level" class="form-control">
												<option value="99" 
													<?php if (set_value('i_level', $edit['level']) == 99) {
													echo "selected=selected";
												}?>>Administrator</option>
												<option value="1" 
													<?php if (set_value('i_level', $edit['level']) == 1) {
													echo "selected=selected";
												}?>>Viewer</option>
										</select>
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

	function password_match(event) {
		let pass = $('#txt_password').val().toUpperCase();
		let cpass = $('#txt_confirm_pass').val().toUpperCase();
		
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

	$(".company-dropdown").change(function(){
		$('#i_id_plant').html(""); 
		var div_data = "";
		if($(this).val() != ""){
			$.ajax({
				type: "GET",
				url: base_url + "master/get_plant_by_comp",
				data: {'id_company': $(this).val()},
				dataType: 'json',
				success: 
					function(data){
						if(data.length > 0){
							data.forEach(element => {
								div_data += `<option value="`+ element.id +`">`+ element.plant_name +`</option>`;
							});
						}
						$('#i_id_plant').append(div_data);
					},
					complete: function() {
					}
				});
		}else{
			$('#i_id_plant').append(div_data);
		}
	});
</script>
