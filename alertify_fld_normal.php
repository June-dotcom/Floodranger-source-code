<?php
include "dbconn.php";
$device_api_key = $_GET['device_api_key'];
$pdo->exec("UPDATE `sensor_profiles` SET `sensor_val_remarks` = 'Normal water level' WHERE `sensor_profiles`.`device_api_key` = '$device_api_key'");
