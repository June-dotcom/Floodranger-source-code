<?php 
include 'dbconn.php';

$device_api_key = $_GET['device_api_key'];
$overflow_status_code = $_GET['overflow_status_code'];
$pdo->exec("UPDATE device_overflow_status SET is_overflow = '$overflow_status_code' WHERE device_api_key = '$device_api_key'");