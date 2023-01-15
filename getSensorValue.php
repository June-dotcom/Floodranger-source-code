<?php
include('dbconn.php');
if (isset($_GET['sensor_id'])) {
	$sensor_api_key = $_GET['sensor_id'];
	$result = $pdo->query("SELECT sensor_value FROM sensor_profiles WHERE sensor_id = '$sensor_api_key' LIMIT 10")->fetch();
	echo $result->sensor_value;
}

