<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row py-4">
                <div class="col-12">
                    <a href="<?= base_url('admin') ?>" class="btn btn-primary">Return</a>
                </div>
            </div>
            <div class="row">
                <?php foreach ($dummy as $key => $v) { ?>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <?= $v['name'] ?>
                            </div>
                            <div class="card-body">
                                <input class="form-control mb-2" value="<?= $v['url']; ?>" />
                                <textarea class="form-control" rows="5">
                                    <?= $v['data'] ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->