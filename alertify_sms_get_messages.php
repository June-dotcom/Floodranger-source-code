<?php 
include 'dbconn.php';

$alert_id = $_GET['alert_id'];
$query = $pdo->query("SELECT * FROM flood_alert_sms JOIN flood_alert_levels ON flood_alert_levels.sms_alert_id = flood_alert_sms.sms_alert_id WHERE flood_alert_levels.alert_id = '$alert_id'");
$result = $query->fetch();
echo $result->sms_message ?? "NA";

