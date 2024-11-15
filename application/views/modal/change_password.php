<div class="modal fade" id="change_pass_modal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Change Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_change_pass" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Current Password</label><span class="text-danger">*</span>
						<input type="password" class="form-control" name="i_old_password" maxlength="50" autocomplete="off" required/>
						<div class="text-danger" id="dupe_error_oldpass" style="display:none;">Current password is wrong!</div>
					</div>
					<div class="form-group">
						<label>New Password</label><span class="text-danger">*</span>
						<input type="password" id="txt_password" class="form-control" name="i_new_password" maxlength="50" autocomplete="off" required/>
					</div>		
					<div class="form-group">
						<label>Retype New Password</label><span class="text-danger">*</span>
						<input type="password" id="txt_confirm_pass" class="form-control" name="i_re_password" maxlength="50" autocomplete="off" required onkeyup="password_match()"/>
						<div class="text-danger" id="dupe_error_cpass" style="display:none;">Confirm Password does not match!</div>
					</div>				
				</div>
				<div class="modal-footer justify-content-center">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i> Cancel</button> -->
					<button type="submit" id="btn_submit_pass" class="btn btn-primary"><i class="fa fa-save mr-2"></i> Save</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
	var base_url = '<?php echo base_url() ?>';
	$(document).ready(function () {
		$('#form_change_pass').submit(function () {
			event.preventDefault();
			var queryString = $('#form_change_pass').serializeArray();
			$.ajax({
				type: "POST",
				url: base_url + "main/changepassword",
				data: queryString,
				dataType: 'json',
				success: function(data) {
					if(data){
						window.location.reload();
						$('#dupe_error_oldpass').hide();
					}else{
						$('#dupe_error_oldpass').show();
					}
				},
				complete: function() {}
			});
		});
	});
	function password_match(event) {
		let pass = $('#txt_password').val().toUpperCase();
		let cpass = $('#txt_confirm_pass').val().toUpperCase();
		
		if (pass != cpass) {
			document.getElementById("btn_submit_pass").disabled = true;
			$("#dupe_error_cpass").show()
			return false;
		} else if (cpass == "" || pass == cpass) {
			document.getElementById("btn_submit_pass").disabled = false;
			$("#dupe_error_cpass").hide()
			return true;
		}
	}
</script>