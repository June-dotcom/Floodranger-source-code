<?php 
include 'dbconn.php';
$sms_device_api_key = $_GET['sms_device_api_key'];
$array_out = array();
// validate the sms device api key
$sms_device_query = $pdo->query("SELECT * FROM `traccar_sms_devices` WHERE `sms_device_id` = '$sms_device_api_key' LIMIT 1");
$sms_device_obj = $sms_device_query->fetch();
if($sms_device_obj){
    $get_txt_msg_query = $pdo->query("SELECT queue_message_id, queue_message_txt  FROM sms_messages_queue WHERE DATE(sms_messages_queue.created_at) = DATE(NOW()) AND is_recog_by_device = '0' ORDER BY created_at LIMIT 1");
    $get_txt_msg_obj = $get_txt_msg_query->fetch();
    if($get_txt_msg_obj){
        $msg_txt_tmp = $get_txt_msg_obj->queue_message_txt;

        $queue_msg_id_tmp = $get_txt_msg_obj->queue_message_id;
        $get_contacts_query = $pdo->query("SELECT * FROM sms_numbers_queue WHERE queue_message_id = '$queue_msg_id_tmp'");
        $get_contacts_obj = $get_contacts_query->fetchAll();
        // add object
        array_push($array_out, $queue_msg_id_tmp);
        array_push($array_out, $msg_txt_tmp );
        array_push($array_out, $get_contacts_obj);
        echo json_encode($array_out);    
    }else{
        echo "NO_MESSAGE_ALERTS";
    }

}else{
    echo "INVALID_DEVICE";
}

