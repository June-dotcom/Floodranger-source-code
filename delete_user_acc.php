<?php ob_start(); ?>
<?php 
include 'dbconn.php';
$id = $_GET['id'];
$sql = "DELETE FROM `contacts` WHERE `contacts`.`assoc_user_id` = $id";
$pdo->exec($sql);

$sql = "DELETE FROM `user_credentials` WHERE `id` = $id";
$pdo->exec($sql);
header('Location: index.php');
?>