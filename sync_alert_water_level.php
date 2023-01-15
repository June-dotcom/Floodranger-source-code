<?php
include 'dbconn.php';

  $sensor_id = $_GET['sensor_id'];
  $alert_a = $_GET['alert_a_cm'];
  $alert_b = $_GET['alert_b_cm'];
  $alert_c = $_GET['alert_c_cm'];

  $sql = 'UPDATE flood_sensor_alerts_cm SET alert_a = :alert_a_val,  alert_b = :alert_b_val, alert_c = :alert_c_val WHERE sensor_id = :sensor_id_val';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['alert_a_val' => $alert_a, 'alert_b_val' => $alert_b, 'alert_c_val' => $alert_c ,'sensor_id_val' => $sensor_id]);
  echo 'Synced completed';
  