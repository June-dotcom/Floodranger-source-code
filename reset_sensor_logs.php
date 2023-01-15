<?php ob_start(); ?>
<?php 
include 'dbconn.php';

$delete_query = $pdo->exec("DELETE FROM sensor_logs");
$reset_sensor_alert_cm = $pdo->exec("UPDATE flood_sensor_alerts_cm SET alert_a = null, alert_b = null, alert_c = null");
$sensor_query = $pdo->query("SELECT * FROM sensor_profiles");
$sensor_obj = $sensor_query->fetchAll();
$id_reset_counter = 1;
foreach($sensor_obj as $sensor_ent){
	$sensor_id = $sensor_ent->sensor_id;
	$pdo->exec("INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `remarks_id`, `timestamps`) VALUES ('$id_reset_counter', '$sensor_id', null, 'FLDNRML', current_timestamp())");
	$id_reset_counter = $id_reset_counter + 1;
}
// reset overflow also
$reset_overflow = $pdo->exec("UPDATE device_overflow_status SET is_overflow = 0");
ob_clean();
header("Location: admin_settings_misc.php");
// INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `remarks_id`, `timestamps`) VALUES (NULL, 'URDULTRSNR03', 0, 'FLDNRML', current_timestamp());
