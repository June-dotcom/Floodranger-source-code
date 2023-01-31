<?php ob_start(); ?>
<?php 
include 'dbconn.php';
ini_set('display_errors', 1);
if($_GET['mode'] == "erase"){
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

	}else if($_GET["mode"] == "clear"){
	// perform clear operations just set is active = 0
	
	// set is active = 0 all sensor 
	$pdo->exec("UPDATE sensor_logs SET is_active = 0");
	// echo "Clear pass 1";
	// copy the first 4 timestamps
	$sensor_query = $pdo->query("SELECT * FROM sensor_profiles");
	$sensor_obj = $sensor_query->fetchAll();
	// reset is active = 1
	foreach ($sensor_obj as $sensor_ent) {
		$tmp_sensor_id = $sensor_ent->sensor_id;
		$cpy_qry_exe = $pdo->query("SELECT * FROM sensor_logs WHERE sensor_id = '$tmp_sensor_id' ORDER BY timestamps ASC LIMIT 1");
		$cpy_qry_obj = $cpy_qry_exe->fetch();
		$cpy_instnce_id = $cpy_qry_obj->id;
		if($cpy_qry_obj->sensor_value != null) {
			// INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `remarks_id`, `timestamps`, `is_active`) VALUES (NULL, 'URDULTRSNR01', '42', 'FLDNRML', current_timestamp(), '1');
			// copy sensor value with selected timestamps is_active = 0
			$cpy_tmp_sensor_id = $cpy_qry_obj->sensor_id;
			$cpy_tmp_sensor_value = $cpy_qry_obj->sensor_value;
			$cpy_tmp_remarks_id = $cpy_qry_obj->remarks_id;
			$cpy_tmp_timestamp = $cpy_qry_obj->timestamps; 
			$pdo->exec("INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `remarks_id`, `timestamps`, `is_active`) VALUES (NULL, '$cpy_tmp_sensor_id', '$cpy_tmp_sensor_value', '$cpy_tmp_remarks_id', '$cpy_tmp_timestamp', '0')");
			// set sensor value to null 

			$pdo->exec("UPDATE `sensor_logs` SET `sensor_value` = NULL, `remarks_id` = 'FLDNRML' WHERE `sensor_logs`.`id` = '$cpy_instnce_id'");
		
		}
		$pdo->exec("UPDATE `sensor_logs` SET `is_active` = 1 WHERE sensor_id = '$tmp_sensor_id' AND id = '$cpy_instnce_id'");
	}

	$reset_overflow = $pdo->exec("UPDATE device_overflow_status SET is_overflow = 0");

}
ob_clean();
header("Location: admin_settings_misc.php");
// INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `remarks_id`, `timestamps`) VALUES (NULL, 'URDULTRSNR03', 0, 'FLDNRML', current_timestamp());
