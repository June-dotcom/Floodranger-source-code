<?php
include 'dbconn.php';

$device_api_key = $_POST['device_api_key'];
$sms_message_alert_1 = $_POST['lvl_1_flood_alert_message'];
$sms_message_alert_2 = $_POST['lvl_2_flood_alert_message'];
$sms_message_alert_3 = $_POST['lvl_3_flood_alert_message'];
$body = 'This is the updated post';

$sql = 'UPDATE flood_alert_sms SET sms_message = :sms_message WHERE alert_level = :sms_message_alert_1 AND device_api_key = :device_api_key';
$stmt = $pdo->prepare($sql);
$stmt->execute(['sms_message' => $body, 'sms_message' => $sms_message_alert_1]);

$sql = 'UPDATE flood_alert_sms SET sms_message = :sms_message WHERE alert_level = :id AND device_api_key = :device_api_key';
$stmt = $pdo->prepare($sql);
$stmt->execute(['sms_message' => $body, 'alert_level' => $id]);