<?php


$contacts_query = $pdo->query("SELECT * FROM (SELECT contacts.phone_number, address_table.device_covered_by, address_table.evacuation_id, evacuation.evacuation_center_name, evacuation.evacuation_center_location FROM contacts JOIN address_table ON address_table.address_id = contacts.address_id JOIN evacuation ON evacuation.evac_id = address_table.evacuation_id WHERE contacts.is_permitted = 1) as contacts_tmp WHERE contacts_tmp.device_covered_by = '$device_api_key_tmp'");

$contacts_obj = $contacts_query->fetchAll();

$message_query = $pdo->query("SELECT * FROM flood_alert_levels JOIN flood_alert_sms ON flood_alert_levels.sms_alert_id = flood_alert_sms.sms_alert_id WHERE flood_alert_levels.alert_remark_id = '$alert_id' LIMIT 1");

$message_obj = $message_query->fetch();
echo $message_obj->sms_message;
// queue msg id
$msg_queue_id = uniqid();
// queue msg txt
$msg_txt_tmp = $message_obj->sms_message;

// insert to message queue
$sql_insert = "INSERT INTO `sms_messages_queue` (`id`, `queue_message_id`,`alert_adapter_id`, `queue_message_txt`, `is_done_sending`, `created_at`, `updated_at`) VALUES (NULL, '$msg_queue_id', '$last_inserted_id' , '$msg_txt_tmp' , '0', current_timestamp(), current_timestamp())";
$pdo->exec($sql_insert);
foreach($contacts_obj as $contact_ent){
    
    // iterate only the phone numbers and messages
    // insert to database table for queing 
    // make a sms_message id tbl and sub table for numbers
    // for later use
    $phone_num_tmp = $contact_ent->phone_number;
    echo $phone_num_tmp;
    echo $msg_txt_tmp;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.traccar.org/sms/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['to' => $phone_num_tmp, 'message' => $msg_txt_tmp]),

        CURLOPT_HTTPHEADER => array(
            'Authorization: cbpCg85RR8eONs_tds52eq:APA91bHMr1DSykX0CPdJeUNeEoysrBJelF6XfESXBDXyc69KzI0pGnGkEIYvSevkMfYewv_6E48gXJUgZkmbPJHTNeYuXXAVNHVuMCslluFm7YKp-v4HTqf8Q2Wxxaou4WnSZUKEGoEW',
            'Content-Type: application/json'
        ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}

// evacuation info message 
// don initializing 
// create evac info obj
echo "Flood alert intialized for sms<br>";
// set as done for sms in the device 

$sql_update = $pdo->exec("UPDATE alert_adapter SET `is_email_sender_recognized` = 'yes', is_email_sender_success = 'done' WHERE alert_adapter.id = '$last_inserted_id'");


