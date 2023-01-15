<?php
include "dbconn.php";
include "sensor_val_cards_obj.php";

$sensor_id_val = $_GET['sensor_id'];
$query_type = $_GET['query_type'];

if ($query_type == 'max_min_curr') {
	// code...
	$sensor_val_cards = new sensorval();

	$max_value_sql = $pdo->query("SELECT sensor_value as sensor_max, timestamps FROM sensor_logs WHERE sensor_id = '$sensor_id_val' ORDER by sensor_value DESC LIMIT 1");
	$max_val_res = $max_value_sql->fetch();

	$min_value_sql = $pdo->query("SELECT sensor_value as sensor_min, timestamps FROM sensor_logs WHERE sensor_id = '$sensor_id_val' ORDER by sensor_value ASC LIMIT 1");
	$min_val_res = $min_value_sql->fetch();

	$current_value_sql = $pdo->query("SELECT sensor_log_tmp.sensor_value as sensor_val, sensor_log_tmp.timestamps as updated_at FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = '$sensor_id_val') as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1; ");

	$current_value = $current_value_sql->fetch();

	$sensor_val_cards->set_min_value($min_val_res->sensor_min);
	$sensor_val_cards->set_min_value_timestamp($min_val_res->timestamps);

	$sensor_val_cards->set_max_value($max_val_res->sensor_max);
	$sensor_val_cards->set_max_value_timestamp($max_val_res->timestamps);

	$sensor_val_cards->set_current_value($current_value->sensor_val);
	$sensor_val_cards->set_current_value_timestamp($current_value->updated_at);

	echo json_encode($sensor_val_cards);
}else if($query_type == 'alert_abc'){
	$alert_abc_sql = $pdo->query("SELECT * FROM flood_sensor_alerts_cm WHERE sensor_id = '$sensor_id_val' LIMIT 1");
	$alert_abc_res = $alert_abc_sql->fetch();

	echo json_encode($alert_abc_res);
}

