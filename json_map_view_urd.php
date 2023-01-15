<?php 
include "dbconn.php";
include "brgy_obj.php";

$fetch_sensors = $pdo->prepare("SELECT * FROM `sensor_profiles`");
$fetch_sensors->execute();
$fetch_sensors_res = $fetch_sensors->fetchAll();

$urd_brgy_arr_obj = array();

foreach($fetch_sensors_res as $fetch_sensors_ent){
	$sensor_id_ent = $fetch_sensors_ent->sensor_id;

	$device_api_key = $fetch_sensors_ent->device_api_key;	
// echo json_encode($device_api_key);
// 		echo "<br>";
	// $sql_tmp_ent = "SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id ,sensor_ent.timestamps as updated_at, sensor_val_remarks.remark_color,sensor_val_remarks.remark_description as sensor_val_remarks, sensor_val_remarks.priority_id as sensor_val_prio_id FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = '$sensor_id_ent') as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_ent.remarks_id;";

	$sql_tmp_ent = "SELECT devices.device_api_key,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(devices.last_update)) < 60 , '1', '0') as is_online, tmp_tbl.* FROM devices JOIN (SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id ,sensor_profiles.device_api_key ,sensor_ent.timestamps as updated_at, sensor_val_remarks.remark_color,sensor_val_remarks.remark_description as sensor_val_remarks, sensor_val_remarks.priority_id as sensor_val_prio_id FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = '$sensor_id_ent') as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_ent.remarks_id) AS tmp_tbl ON devices.device_api_key = tmp_tbl.device_api_key;";

	$fetch_ent = $pdo->prepare($sql_tmp_ent);
	$fetch_ent->execute();
	$fetch_ent_res = $fetch_ent->fetch();

	$address_tmp_qry = "SELECT * FROM address_table WHERE device_covered_by = '$device_api_key'";

	$address_ent = $pdo->prepare($address_tmp_qry);
	$address_ent->execute();
	$address_tmp_ent = $address_ent->fetchAll();

	foreach($address_tmp_ent as $address_tmp_obj){
		// detect if the addr mapping name is existed
		// echo json_encode($address_tmp_obj);
		// echo "<br>";
		$brgyurdObj = new brgyMap();
		$brgyurdObj->address_id = $address_tmp_obj->address_id;
		$brgyurdObj->addr_mapping_name = $address_tmp_obj->addr_mapping_name;
		if($fetch_ent_res->is_online == "1"){
			$brgyurdObj->color_alert_remarks = $fetch_ent_res->remark_color;
			$brgyurdObj->address_prio_id = $fetch_ent_res->sensor_val_prio_id;
		}else{
			// refer to admin_urdaneta_map.php
			$brgyurdObj->color_alert_remarks = "#73777B";
			$brgyurdObj->address_prio_id = '0';
		}


		// public $address_id;
		// public $addr_mapping_name;
		// public $color_alert_remarks;
		// public $address_prio_id;
		// array_push($urd_brgy_arr_obj,  $brgyurdObj);

		$urd_brgy_arr_obj = arr_insert_ver($brgyurdObj, $urd_brgy_arr_obj);
	}


	// if($fetch_ent_res){
	// 		// echo json_encode($fetch_ent_res);
	// 	array_push($sensor_curr_arr_obj, new current_val($fetch_ent_res->sensor_id, $fetch_ent_res->sensor_val, $fetch_ent_res->updated_at, $fetch_ent_res->sensor_val_remarks ?? null));

	// }

}

function arr_insert_ver($obj_entry, $array_tmp){
	$index = 0;
	// index + object there
	$is_duplicate = false;
	foreach($array_tmp as $compare){
		if ($compare->address_id == $obj_entry->address_id) {
			if (intval($compare->address_prio_id) < intval($obj_entry->address_prio_id)) {
				$array_tmp[$index]->address_prio_id = $obj_entry->address_prio_id;
				$array_tmp[$index]->color_alert_remarks = $obj_entry->color_alert_remarks;
			}
			$is_duplicate = true;
		}
		$index++;
	}

	if ($is_duplicate == false) {
		array_push($array_tmp, $obj_entry);
	}
	return $array_tmp;
}

echo json_encode($urd_brgy_arr_obj);
