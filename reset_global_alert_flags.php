<?php ob_start(); ?>

<?php 
include 'dbconn.php';

// delete evacuation site
$pdo->exec("DELETE FROM alert_adapter");

header("Location: admin_settings_misc.php");