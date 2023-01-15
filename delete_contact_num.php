<?php ob_start(); ?>
<?php
include 'dbconn.php';
$id = $_GET['id'];
$sql = "DELETE FROM `contacts` WHERE `contacts`.`id` = $id";
  $pdo->exec($sql);
  header('Location: admin_contacts.php');
?>