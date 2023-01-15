<?php 
include 'dbconn.php';

$alert_adapter_id = $_GET['alert_adapter_id'] ?? 'NA';
$sms_sender_api_key = $_GET['sms_sender_api_key'] ?? 'NA';
$alert_adapter_query = $pdo->query("UPDATE alert_adapter SET is_sms_sender_recognized = 'yes' WHERE id = '$alert_adapter_id'");
$alert_adapter_result = $alert_adapter_query->fetch();

$alert_query = $pdo->query("SELECT * FROM alert_adapter WHERE id = '$alert_adapter_id'");
$alert_results = $alert_query->fetch();

// return alert results
echo json_encode($alert_results) ?? 'false';


