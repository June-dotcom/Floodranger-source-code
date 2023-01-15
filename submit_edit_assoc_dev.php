<?php ob_start(); ?>
<?php
include 'dbconn.php';
$edit_id = $_POST['edit_id'];
$dev_id = $_POST['dev_id'];

// echo "Frm: php" .$email_alert_msg_txt_val  . " : " . $email_alert_id_txt_val;
$sql = "UPDATE `address_table` SET `device_covered_by` = :dev_id_val WHERE `address_table`.`id` = :edit_id_val";
$stmt = $pdo->prepare($sql);
$stmt->execute(['dev_id_val' => $dev_id, 'edit_id_val' => $edit_id]);

header('Location: admin_evacuation_brgy.php');

