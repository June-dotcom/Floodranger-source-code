<?php ob_start(); ?>
<?php 
include 'dbconn.php';

$delete_query = $pdo->exec("DELETE FROM contacts");
$delete_contacts = $pdo->exec("DELETE FROM user_credentials WHERE role_name != 'admin'");
$delete_token_verify = $pdo->exec("DELETE FROM email_req_login_token");
$delete_email_verify = $pdo->exec("DELETE FROM email_verify_token");
ob_clean();
header("Location: admin_settings_misc.php");
// INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `remarks_id`, `timestamps`) VALUES (NULL, 'URDULTRSNR03', 0, 'FLDNRML', current_timestamp());
