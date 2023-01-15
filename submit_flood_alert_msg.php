<?php
include 'dbconn.php';
$flood_lvl_a_msg = $_POST['lvl_1_flood_alert_message'];
$flood_lvl_b_msg = $_POST['lvl_2_flood_alert_message'];
$flood_lvl_c_msg = $_POST['lvl_3_flood_alert_message'];

echo $flood_lvl_a_msg;
echo $flood_lvl_b_msg;
echo $flood_lvl_c_msg;

$device_api_key = $_POST['device_api_key'];

  $sql = 'UPDATE flood_alert_sms SET sms_message = :sms_message WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['sms_message' => $flood_lvl_a_msg, 'id' => '1']);

  $sql = 'UPDATE flood_alert_sms SET sms_message = :sms_message WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['sms_message' => $flood_lvl_b_msg, 'id' => '2']);

  $sql = 'UPDATE flood_alert_sms SET sms_message = :sms_message WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['sms_message' => $flood_lvl_c_msg, 'id' => '3']);
  
  echo 'Post Updated';
  header("Location: settings.php"); /* Redirect browser */
?>