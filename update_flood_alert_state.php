<?php
include 'dbconn.php';

if (isset($_GET['device_api_key']) && isset($_GET['alert_level_state'])) {
  
  $device_api_key = $_GET['device_api_key'];
  $alert_level_state = $_GET['alert_level_state'];
  $sql = 'UPDATE current_device_state SET alert_level_state = :alert_level_state WHERE device_api_key = :device_api_key';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['alert_level_state' => $alert_level_state, 'device_api_key' => $device_api_key]);
  echo 'Water level state updated';
  
}
