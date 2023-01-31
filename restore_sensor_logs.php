<?php ob_start(); ?>
<?php
include 'dbconn.php';
$sensor_id = $_GET['sensor_id']; 
$cpy_qry_exe = $pdo->query("SELECT * FROM sensor_logs WHERE sensor_id = '$sensor_id' ORDER BY timestamps ASC LIMIT 1");
$cpy_qry_obj = $cpy_qry_exe->fetch();

$pdo->exec("UPDATE sensor_logs SET is_active = 1 WHERE sensor_id = '$sensor_id'");
header("Location: admin_sensor_table_removed.php?sensor_id=" . $sensor_id);
?>
