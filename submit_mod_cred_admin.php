<?php ob_start(); ?>
<?php 
	include 'dbconn.php';
	$user_id_edit = $_POST['user_id_edit'];
	$email_edit = $_POST['email_edit'];
	$pass_edit = $_POST['pass_edit'];
	
	$user_edit_query = $pdo->exec("UPDATE `user_credentials` SET `email` = '$email_edit', `password` = '$pass_edit' WHERE `user_credentials`.`id` = $user_id_edit");
	ob_end_clean();
	header("Location: admin_settings_misc.php");
?>