<?php
require_once 'dbconn.php';

if(!empty($_GET['device_api_key']))
{
	$device_api_key = $_GET['device_api_key'];
	$alert_level = $_GET['alert_level'];
  	$sql = 'SELECT * FROM contacts WHERE device_api_key = :device_api_key AND alert_level = :alert_level ';
  	$stmt = $pdo->prepare($sql);
  	$stmt->execute(['device_api_key' => $device_api_key, 'alert_level' => $alert_level]);
  	$result = $stmt->fetch();
  	echo $result->sms_message;
}