<?php ob_start(); ?>

<?php 
include 'dbconn.php';

// delete evacuation site
$pdo->exec("DELETE FROM alert_adapter");
// delete 
$pdo->exec("DELETE FROM sms_messages_queue");
$pdo->exec("DELETE FROM sms_numbers_queue");

header("Location: admin_settings_misc.php");