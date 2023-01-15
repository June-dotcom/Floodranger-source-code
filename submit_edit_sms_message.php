<?php ob_start(); ?>
<?php
include 'dbconn.php';
$sms_alert_msg_txt_val = $_POST['sms_message_edit'];
$sms_alert_id_txt_val = $_POST['sms_message_id'];
$sql = "UPDATE flood_alert_sms SET `sms_message` = :sms_alert_msg_txt WHERE sms_alert_id = :sms_alert_id_txt";
$stmt = $pdo->prepare($sql);
$stmt->execute(['sms_alert_id_txt' => $sms_alert_id_txt_val, 'sms_alert_msg_txt' => $sms_alert_msg_txt_val]);
header('location: admin_settings_sms.php');