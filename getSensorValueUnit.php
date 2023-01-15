<?php
include('dbconn.php');
if (isset($_GET['sensor_id'])) {
	$sensor_api_key = $_GET['sensor_id'];
	$result = $pdo->query("SELECT sensor_val_unit FROM sensor_profiles WHERE sensor_id = '$sensor_api_key'")->fetch();
	echo $result->sensor_val_unit;
}

