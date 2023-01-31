<?php ob_start(); ?>
<?php
include 'dbconn.php';
$id = $_GET['id'];
$mode = $_GET['mode'];
if($mode == "erase"){
  $sql = "DELETE FROM `contacts` WHERE `contacts`.`id` = $id";
  $pdo->exec($sql);
  header('Location: admin_contacts.php?category=all');

}else if($mode == "clear"){
  $pdo->exec("UPDATE `contacts` SET is_permitted = 0 WHERE id = $id");
  header('Location: admin_contacts.php?category=all');
}else if($mode == "restore"){
  $pdo->exec("UPDATE `contacts` SET is_permitted = 1 WHERE id = $id");
  header('Location: admin_contacts.php?category=removed');

}
  
?>