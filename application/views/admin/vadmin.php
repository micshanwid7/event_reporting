<style>
	.link {
		display: block;
		padding: 0.5rem 1rem;
		width: 100%;
		border: 2px dashed #d8d8d8;
		border-radius: 0.25rem;
		transition: 0.3s;
	}

	.link:hover {
		border: 2px solid #007bff;
		background-color: #007bff;
		color: #fff;
	}

	.link+.link {
		margin-top: 0.5rem;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Admin Page</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Main</a></li>
						<li class="breadcrumb-item active">Admin</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header">
							<h5 class="m-0">Page List</h5>
						</div>
						<div class="card-body">
							<a class="link" href="<?= base_url() . 'admin/get'; ?>">API Get</a>
							<a class="link" href="<?= base_url() . 'admin/color'; ?>">Color Libray</a>
							<a class="link" href="<?= base_url() . 'admin/dummy'; ?>">Dummy JSON</a>
							<a class="link" href="<?= base_url() . 'admin/phpinfo'; ?>">PHP Info</a>
							<a class="link" href="<?= base_url() . 'admin/sandbox'; ?>">Sandbox</a>
							<a class="link" href="<?= base_url() . 'admin/userdata'; ?>">Session Userdata</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<button class="btn btn-primary">Button</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->