<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- DataTables  & Plugins -->
<script src="<?= base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<style>
	.w5 { width: 5%; }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<?php if ($this->session->flashdata('global')) { 
				unset($_SESSION['global']); 
			} ?>
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Participant Table</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Report</a></li>
						<li class="breadcrumb-item active">Participant</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container-fluid">
			<div class="mb-2">
				<a href="<?= base_url() . 'report/participant_add' ?>" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus mr-2"></i> Add New Participant</a>
			</div>
			<form action="<?= base_url() . 'report/import' ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group mt-3">
                    <label class="mr-2">Upload File XLSX:</label>
                    <input type="file" name="file">
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="m-0">Participant Table</h5>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable">
									<thead>
										<th class="w5">No.</th>
										<th>Email</th>
										<th>Name</th>
										<th>Company</th>
										<th>Log Visit</th>
										<th class="text-center w5" colspan="2">Action</th>
									</thead>
									<tbody>
										<?php 
											foreach ($row as $key => $value) { ?>
											<tr>
												<td></td>
												<td><?= $value['email'] ?></td>
												<td><?= $value['name'] ?></td>
												<td><?= $value['company_name'] ?></td>
												<td><?= $value['log_visit'] ?></td>
												<td class="text-center">	
													<a href="<?= base_url().'master/user_edit/'.$value['id'] ?>" title="Edit"><i class="fa fa-edit"></i></a>
												</td>
											</tr>
										<?php
											}
										?>
									</tbody>
                            	</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

<script>
	$(document).ready(function() {
		const t = $('#datatable').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": false,
			"iDisplayLength": 10,
			"columnDefs": [{
				"orderable": false,
				"targets": [0, 4, 5]
			}],
			"order": [
				[1, 'asc']
			]
		});

		t.on('order.dt search.dt', function () {
			let i = 1;
			
			t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
				this.data(i + ". ");
				i++;
			});
		}).draw();
	});

	function reset_confirm(params) {
		event.preventDefault();
		$("#reset_modal").modal();
		$("#reset_pass").attr("href", "<?= base_url() ?>"+'master/user_reset/'+params);
	}
</script>