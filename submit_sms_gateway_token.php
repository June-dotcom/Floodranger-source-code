<?php ob_start(); ?>
<?php
include 'dbconn.php';
$sms_token = $_POST['sms_gateway_api_key_txt'];
echo $sms_token;
if($pdo->exec("UPDATE `preferences` SET `pref_val` = '$sms_token' WHERE `preferences`.`id` = 'SMSTOKENTRACCAR'")){
    echo "Success";
}else{

}
ob_clean();
header("Location: admin_settings_traccar_main.php");