<?php
include 'dbconn.php';

  $device_api_key = $_GET['device_api_key'];
  $network_name = $_GET['network_name'];

  $sql = 'UPDATE current_device_state SET network_name = :network_name WHERE device_api_key = :device_api_key';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['network_name' => $network_name, 'device_api_key' => $device_api_key]);
  echo 'Network name updated';
  