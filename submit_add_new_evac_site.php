<?php ob_start(); ?>
<?php 
include 'dbconn.php';
$evac_name = $_POST['evac_name'];
$evac_loc = $_POST['evac_loc'];

$qry_slctd_last = $pdo->query("SELECT * FROM evacuation ORDER BY id DESC LIMIT 1");
$qry_slctd_last_res = $qry_slctd_last->fetch();

$qry_last_id = $qry_slctd_last_res->id + 1;
$evac_id = 'EVAC0' . $qry_last_id;

$sql = "INSERT INTO evacuation(evac_id, evacuation_center_name, evacuation_center_location) VALUES(:evac_id_val, :evac_name_val, :evac_loc_val)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	'evac_id_val' => $evac_id,
	'evac_name_val' => $evac_name, 
	'evac_loc_val' => $evac_loc
	]);

header('location: admin_settings_evac_sites.php');
// $sql = "UPDATE flood_alert_sms SET `sms_message` = :sms_alert_msg_txt WHERE sms_alert_id = :sms_alert_id_txt";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['sms_alert_id_txt' => $sms_alert_id_txt_val, 'sms_alert_msg_txt' => $sms_alert_msg_txt_val]);

