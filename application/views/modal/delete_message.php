<div class="modal fade" id="message_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Delete Confirmation</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this <?= $del_title ?>?</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i> Cancel</button>
				<a href="<?= base_url() . $url_delete . $edit['id'] ?>" title="Delete" class="btn btn-danger"><i class="fa fa-trash mr-2"></i> Delete</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->