<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content pt-3">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="m-0">API Get</h5>
						</div>
						<div class="card-body">
							<form method="post">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text"><b>URL : </b> <?php echo $serverip; ?></span>
									</div>
									<input type="text" class="form-control" name="782_url" placeholder="..." value="<?= $url ?>">
								</div>
								<div class="d-flex justify-content-between">
									<button type="submit" name="btn_submit" value="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>

						<div class="card-body">
							<div class="row mb-3">
								<div class="col">
									<div class="input-group">
										<span class="input-group-text"><b>Full URL </b></span>
										<input type="text" class="form-control" placeholder="..." value="<?= $full_url; ?>" readonly>
									</div>
								</div>
								<div class="col">
									<button class="btn btn-primary" onclick="prettyPrint()">JSON view</button>
								</div>
							</div>
							<textarea class="form-control" id="txt_result" spellcheck="false"><?= $json; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
	$("textarea").each(function () {
		this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
	}).on("input", function () {
		this.style.height = "auto";
		this.style.height = (this.scrollHeight) + "px";
	});

	function prettyPrint() {
		var ugly = document.getElementById('txt_result').value;
		var obj = JSON.parse(ugly);
		var pretty = JSON.stringify(obj, undefined, 2);
		document.getElementById('txt_result').value = pretty;
		$('textarea').trigger('input'); // force trigger onInput
	}
</script>