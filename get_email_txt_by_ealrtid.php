<?php 
include "dbconn.php";
$email_alert_id = $_GET['email_alert_id'];
$sql = 'SELECT * FROM flood_alert_email WHERE email_alert_id = :email_alert_id_val';
$stmt = $pdo->prepare($sql);
$stmt->execute(['email_alert_id_val' => $email_alert_id]);
$post = $stmt->fetch();

echo $post->email_message;