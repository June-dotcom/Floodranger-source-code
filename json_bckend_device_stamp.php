<?php
include 'dbconn.php';
$query_device_stamp = $pdo->query('SELECT device_api_key,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(last_update)) < 60 , "Active", CONCAT("Last online ", last_update)) as remarks FROM devices');
$obj_device_stamp = $query_device_stamp->fetchAll();
echo json_encode($obj_device_stamp);