<?php
include('dbconn.php');
if (isset($_GET['sensor_id'])) {
	$sensor_api_key = $_GET['sensor_id'];
	$result = $pdo->query("SELECT updated_at FROM sensor_profiles WHERE sensor_id = '$sensor_api_key'")->fetch();
	echo $result->updated_at;
}

