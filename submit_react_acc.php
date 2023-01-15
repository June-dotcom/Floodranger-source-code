<?php ob_start(); ?>
<?php 
include 'dbconn.php';

$user_id_react = $_GET['user_id'];


$query = "UPDATE user_credentials SET is_active = '1' WHERE id = '$user_id_react'";
$pdo->exec($query);

$query_react_contacts = "UPDATE contacts SET is_permitted = '1' WHERE assoc_user_id = '$user_id_react'";
$pdo->exec($query_react_contacts);

header("Location: recipient_homepage.php");