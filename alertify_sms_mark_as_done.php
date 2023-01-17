<?php 
include 'dbconn.php';
$sms_device_api_key = $_GET['sms_device_api_key'];
$queue_msg_id = $_GET['queue_msg_id'];
// validate the sms device api key
$sms_device_query = $pdo->query("SELECT * FROM `traccar_sms_devices` WHERE `sms_device_id` = '$sms_device_api_key' LIMIT 1");
$sms_device_obj = $sms_device_query->fetch();
if($sms_device_obj){
    $get_alert_adapter_query = $pdo->query("SELECT * FROM sms_messages_queue WHERE queue_message_id = '$queue_msg_id' LIMIT 1");
    $get_alert_adapter_obj = $get_alert_adapter_query->fetch();
    if($get_alert_adapter_obj){
        $alert_adapter_id_tmp = $get_alert_adapter_obj->queue_message_id;
        $pdo->exec("UPDATE sms_messages_queue SET is_recog_by_device = '1', is_done_sending = '1' WHERE queue_message_id = '$queue_msg_id'");
        $pdo->exec("UPDATE alert_adapter SET `is_sms_sender_recognized` = 'yes', is_sms_sender_success = 'done' WHERE alert_adapter.id = '$alert_adapter_id_tmp'");
    }else{
        echo "Invalid queue message id";
    }
}else{
    echo "Invalid device";
}

