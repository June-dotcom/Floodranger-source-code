<?php ob_start(); ?>
<?php 
include 'dbconn.php';
$user_id_deact = $_GET['user_id'];

$query = "UPDATE user_credentials SET is_active = '0' WHERE id = '$user_id_deact'";
$pdo->exec($query);

$query_deact_contacts = "UPDATE contacts SET is_permitted = '0' WHERE assoc_user_id = '$user_id_deact'";
$pdo->exec($query_deact_contacts);
header("Location: success_account_deactivate.php");