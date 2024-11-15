<style>
    .ion {
        font-size: 3rem;
    }

    .card {
        max-width: 360px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content">
		<div class="container-fluid">
			<div class="" style="display:grid; height: calc( 100vh - 114px);">
				<div class="" style="justify-self: center; padding-top: 20vh">
					<div class="card">
						<div class="card-body text-center">
                            <i class="ion ion-ios-close-outline my-3 text-danger"></i>
							<h4 class="">No Data Received</h4>

							<p class="card-text">Error while connecting to data server. Return to <a href="#">Main Page</a> or try again later.</p>
							<button class="btn btn-primary" onClick="window.location.reload()">Refresh</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->