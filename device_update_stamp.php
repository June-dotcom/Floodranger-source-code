<?php
include 'dbconn.php';
$device_api_key = $_GET['device_api_key'];
$pdo->exec("UPDATE devices SET last_update = CURRENT_TIMESTAMP() WHERE device_api_key = '$device_api_key'");
echo "Connected";