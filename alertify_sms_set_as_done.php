<?php 
include 'dbconn.php';
$alert_adapter_id = $_GET['alert_adapter_id'] ?? "NA";
$sms_sender_api_key = $_GET['sms_sender_api_key'] ?? "NA";
$pdo->exec("UPDATE alert_adapter SET is_sms_sender_success = 'done', sms_sender_api_key = '$sms_sender_api_key' WHERE id = '$alert_adapter_id'");




