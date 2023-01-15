<?php


 $pdo->exec("INSERT INTO alert_adapter (`id`, `is_sms_sender_recognized`, `is_email_sender_recognized`, `frm_device_api_key`, `alert_remark_id`, `is_sms_sender_success`, `is_email_sender_success`, `timestamp`) VALUES (NULL, 'no', 'no', '$device_api_key_tmp', '$alert_id_tmp', 'no', 'no', CURRENT_TIMESTAMP)");
    $last_inserted_id = $pdo->lastInsertId();
   // refer to alertify set_new_alert.php
    $alert_id = $alert_id_tmp;

    $last_inserted_query = $pdo->query("SELECT * FROM `flood_alert_levels` WHERE `alert_remark_id` = '$alert_id'");
    $last_inserted_result = $last_inserted_query->fetch();

    $last_alert_remarks = $last_inserted_result->alert_remark_id;

    include "alertify_email_instance.php";