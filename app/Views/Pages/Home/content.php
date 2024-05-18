<?php
$level = 0;
$ada_port = false;
if (!isset($_SESSION['log'])) {
    include_once("home.php"); ?>
<?php } else {
    include_once("dashboard.php");
} ?>

<script>
    $(document).ready(function() {
        $("span.balance_amount").load("<?= PC::BASE_URL ?>Load/balance");
        $("span.level_name").load("<?= PC::BASE_URL ?>Load/level_name/<?= $level ?>");
        $("span.daily_task").load("<?= PC::BASE_URL ?>Load/daily_task/<?= $level ?>");
        device();
        spinner(0);
    });

    $("#checkin").click(function() {
        $.post("<?= PC::BASE_URL ?>Load/checkin", function(res) {
            if (res == 0) {
                content();
            } else {
                alert(res);
            }
        });
    })
</script>