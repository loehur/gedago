<?php
$level = 0;
$ada_port = false;
if (!isset($_SESSION['log'])) {
    include_once("home.php"); ?>
<?php } else {
    include_once("dashboard.php");
} ?>