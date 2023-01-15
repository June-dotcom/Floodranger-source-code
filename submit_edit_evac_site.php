<?php ob_start(); ?>
<?php 
include 'dbconn.php';
$edit_id = $_POST['edit_id'];
$evac_name = $_POST['evac_name'];
$evac_loc = $_POST['evac_loc'];


$sql = "UPDATE evacuation SET evacuation_center_name = :evac_name_val , evacuation_center_location = :evac_loc_val WHERE id = :edit_id_val";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	'evac_name_val' => $evac_name, 
	'evac_loc_val' => $evac_loc,
	'edit_id_val' => $edit_id
	]);

header('location: admin_settings_evac_sites.php');
// $sql = "UPDATE flood_alert_sms SET `sms_message` = :sms_alert_msg_txt WHERE sms_alert_id = :sms_alert_id_txt";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['sms_alert_id_txt' => $sms_alert_id_txt_val, 'sms_alert_msg_txt' => $sms_alert_msg_txt_val]);

