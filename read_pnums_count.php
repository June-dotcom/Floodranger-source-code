<?php
require_once 'dbconn.php';

if (isset($_GET['device_api_key'])) {
	$device_api_key = $_GET['device_api_key'];
	$sql = 'SELECT COUNT(phone_number) AS counted FROM contacts WHERE device_api_key = :device_api_key';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['device_api_key' => $device_api_key]);
	$result = $stmt->fetch();
	echo $result->counted;
}

