<?php ob_start(); ?>
<?php session_start(); ?>

<?php 
include "dbconn.php";
include "sensor_current_val_cards_obj.php";
$user_id = $_SESSION['user_id']; 

$query_get_user_info = $pdo->query("SELECT * FROM contacts JOIN address_table ON address_table.address_id = contacts.address_id JOIN evacuation ON evacuation.evac_id = address_table.evacuation_id WHERE contacts.assoc_user_id = $user_id");
$obj_get_user_info = $query_get_user_info->fetch();

$address_id = $obj_get_user_info->address_id;

$query_get_river_assoc = $pdo->query("SELECT * FROM address_table WHERE address_table.address_id = '$address_id'");
$fetch_sensors_res = $query_get_river_assoc->fetchAll();

$sensor_curr_arr_obj = array();



foreach($fetch_sensors_res as $fetch_sensors_ent){
	$tmp_device_api_key = $fetch_sensors_ent->device_covered_by;
	
	
	// $sql_tmp_ent = "SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id, sensor_ent.timestamps as updated_at, sensor_ent.remarks_id as sensor_val_remarks FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = '$sensor_id_ent') as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id";

	$sql_tmp_ent = "SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id, sensor_ent.timestamps as updated_at, sensor_val_remarks.remark_description as sensor_val_remarks FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = (SELECT sensor_id FROM sensor_profiles WHERE device_api_key = '$tmp_device_api_key' LIMIT 1)) as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_ent.remarks_id";

	
	$fetch_ent = $pdo->prepare($sql_tmp_ent);
	$fetch_ent->execute();
	$fetch_ent_res = $fetch_ent->fetch();


	if($fetch_ent_res){
			// echo json_encode($fetch_ent_res);
		array_push($sensor_curr_arr_obj, new current_val($fetch_ent_res->sensor_id, $fetch_ent_res->sensor_val, $fetch_ent_res->updated_at, $fetch_ent_res->sensor_val_remarks ?? null));

	}

}


echo json_encode($sensor_curr_arr_obj);
