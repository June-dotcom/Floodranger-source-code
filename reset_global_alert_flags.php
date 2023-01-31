<?php ob_start(); ?>

<?php 
include 'dbconn.php';
$mode = $_GET["mode"];
if($mode == "erase"){
    // delete evacuation site
    $pdo->exec("DELETE FROM alert_adapter");
    // delete 
    $pdo->exec("DELETE FROM sms_messages_queue");
    $pdo->exec("DELETE FROM sms_numbers_queue");
}else if($mode == "archive"){
    $pdo->exec("UPDATE alert_adapter SET is_active = 0");
}

header("Location: admin_settings_misc.php");