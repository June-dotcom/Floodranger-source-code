<?php 
include 'dbconn.php';
if (isset($_GET['device_api_key']) && isset($_GET['sensor_id']) && isset($_GET['value'])) {
	$device_api_key = $_GET['device_api_key'];
	$sensor_id = $_GET['sensor_id'];
	$sensor_value = $_GET['value'];
	$pdo->query("INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `timestamps`) VALUES (NULL, '$device_api_key', '$sensor_value', CURRENT_TIMESTAMP)");
	$pdo->query("UPDATE devices SET last_update = CURRENT_TIMESTAMP() WHERE device_api_keys = '$device_api_key'");
	echo "Successfully updated";
}