<?php ob_start(); ?>

<?php 
include 'dbconn.php';
$device_api_key = $_GET['device_api_key'];

// delete evacuation site
$sql = "DELETE FROM alert_adapter WHERE frm_device_api_key = :device_api_key;";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	'device_api_key' => $device_api_key,
]);

header("Location: admin_alerts_history.php");