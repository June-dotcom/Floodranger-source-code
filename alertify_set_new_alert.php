<?php
include 'dbconn.php';
// alert_id = adapter id
if(isset($_GET['device_api_key']) && isset($_GET['alert_id'])){
	$device_api_key = $_GET['device_api_key'];
	$alert_id = $_GET['alert_id'];
	$pdo->exec("INSERT INTO alert_adapter (`id`, `is_sms_sender_recognized`, `is_email_sender_recognized`, `frm_device_api_key`, `alert_id`, `is_sms_sender_success`, `is_email_sender_success`, `timestamp`) VALUES (NULL, 'no', 'no', '$device_api_key', '$alert_id', 'no', 'no', CURRENT_TIMESTAMP)");

	
   	$last_inserted_id = $pdo->lastInsertId();

    $last_inserted_query = $pdo->query("SELECT * FROM `flood_alert_levels` WHERE `alert_id` = '$alert_id'");
	$last_inserted_result = $last_inserted_query->fetch();

	$last_alert_remarks = $last_inserted_result->alert_remarks;

	// $pdo->exec("UPDATE `sensor_profiles` SET `sensor_val_remarks` = '$last_alert_remarks' WHERE `sensor_profiles`.`device_api_key` = '$device_api_key'");

    echo "\nalert inserted successfully";

	// execute email 
    include "alertify_email_instance.php";

    // email
    echo "\nemailed inserted successfully";
}


