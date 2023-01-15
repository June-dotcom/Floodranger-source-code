<?php 
include "dbconn.php";
include "sensor_current_val_cards_obj.php";

$fetch_sensors = $pdo->prepare("SELECT * FROM `sensor_profiles`");
$fetch_sensors->execute();
$fetch_sensors_res = $fetch_sensors->fetchAll();

$sensor_curr_arr_obj = array();

foreach($fetch_sensors_res as $fetch_sensors_ent){
	$sensor_id_ent = $fetch_sensors_ent->sensor_id;
	
	
	// $sql_tmp_ent = "SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id, sensor_ent.timestamps as updated_at, sensor_ent.remarks_id as sensor_val_remarks FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = '$sensor_id_ent') as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id";

  $sql_tmp_ent = "SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id, sensor_ent.timestamps as updated_at, sensor_val_remarks.remark_description as sensor_val_remarks FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = '$sensor_id_ent') as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_ent.remarks_id";

	
	$fetch_ent = $pdo->prepare($sql_tmp_ent);
	$fetch_ent->execute();
	$fetch_ent_res = $fetch_ent->fetch();

	// overflow status 
	$overflow_qry = "SELECT device_overflow_status.id, device_overflow_status.device_api_key, device_overflow_status.is_overflow FROM device_overflow_status JOIN sensor_profiles ON sensor_profiles.device_api_key = device_overflow_status.device_api_key WHERE sensor_profiles.sensor_id = '$sensor_id_ent'";

	$overflow_tmp_ent = $pdo->prepare($overflow_qry);
	$overflow_tmp_ent->execute();
	$overflow_tmp_res = $overflow_tmp_ent->fetch();


	if($fetch_ent_res){
			// echo json_encode($fetch_ent_res);
		array_push($sensor_curr_arr_obj, new current_val($fetch_ent_res->sensor_id, $fetch_ent_res->sensor_val, $fetch_ent_res->updated_at, $fetch_ent_res->sensor_val_remarks ?? null, $overflow_tmp_res->is_overflow));

	}
		
}


echo json_encode($sensor_curr_arr_obj);
