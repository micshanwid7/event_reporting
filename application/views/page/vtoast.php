<?php if ($flag == 0) { ?>
    <script>
        toastr.error("<?= $msg ?>")
    </script>
<?php } elseif ($flag == 1) { ?>
    <script>
        toastr.warning("<?= $msg ?>")
    </script>
<?php } elseif ($flag == 2) { ?>
    <script>
        toastr.success("<?= $msg ?>")
    </script>
<?php } ?>