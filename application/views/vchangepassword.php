<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Main</a></li>
                        <li class="breadcrumb-item active">Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="m-0">Change Password</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype='multipart/form-data'>
                                <div class="form-group">
                                    <label for="i_old_password">Current Password</label>
                                    <input type="password" class="form-control" name="i_old_password" placeholder="Old Password" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="i_new_password">New Password</label>
                                    <input id="new_password" type="password" class="form-control mb-3" name="i_new_password" placeholder="New Password" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="i_retype_password">Confirm New Password</label>
                                    <input id="retype_password" type="password" class="form-control" name="i_retype_password" placeholder="Re-type new Password" autocomplete="off" required>
                                    <span id="error" style="color:red; display:none;">Password do not match</span>
                                </div>
                                <button id="submit" class="btn btn-primary mt-4" name="submit" value="1">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<script>
    <?php if ($this->session->flashdata('info')) { ?>
        toastr.success('<?= $this->session->flashdata('info') ?>');
    <?php } ?>
    
    <?php if ($this->session->flashdata('error')) { ?>
        toastr.error('<?= $this->session->flashdata('error') ?>');
    <?php } ?>

    $(document).ready(function() {
        $("#retype_password").keyup(function() {
            if ($("#new_password").val() != $("#retype_password").val()) {
                document.getElementById("submit").disabled = true;
                $("#error").show()
            } else {
                document.getElementById("submit").disabled = false;
                $("#error").hide()
            }
        });
        $("#new_password").keyup(function() {
            if ($("#new_password").val() != $("#retype_password").val()) {
                document.getElementById("submit").disabled = true;
                $("#error").show()
            } else {
                document.getElementById("submit").disabled = false;
                $("#error").hide()
            }
        });
    });
</script>