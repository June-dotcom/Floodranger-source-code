<?php ob_start(); ?>
<?php
include 'dbconn.php';
$evac_id = $_GET['evac_id'];

// delete evacuation site
$sql = "DELETE FROM evacuation WHERE evac_id = :evac_id_val;";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	'evac_id_val' => $evac_id,
]);

// relocate evacuation to urdaneta cultural
$update_addresses_sql = "UPDATE address_table SET evacuation_id = 'EVAC01' WHERE evacuation_id = :evac_id_val";
$update_stmt = $pdo->prepare($update_addresses_sql);
$update_stmt->execute([
	'evac_id_val' => $evac_id,
]);

header('location: admin_settings_evac_sites.php');