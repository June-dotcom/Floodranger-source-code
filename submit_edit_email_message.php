<?php ob_start(); ?>
<?php
include 'dbconn.php';
$email_alert_msg_txt_val = $_POST['email_message_edited'];
$email_alert_id_txt_val = $_POST['email_message_id'];

// echo "Frm: php" .$email_alert_msg_txt_val  . " : " . $email_alert_id_txt_val;
$sql = "UPDATE flood_alert_email SET `email_message` = :email_alert_msg_txt WHERE email_alert_id = :email_alert_id_txt";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email_alert_id_txt' => $email_alert_id_txt_val, 'email_alert_msg_txt' => $email_alert_msg_txt_val]);
// header("Location: admin_settings_email.php");

