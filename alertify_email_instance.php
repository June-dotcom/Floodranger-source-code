<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
echo $alert_id . "<br>";
$contacts_query = $pdo->query("SELECT * FROM (SELECT contacts.email, address_table.device_covered_by, address_table.evacuation_id, evacuation.evacuation_center_name, evacuation.evacuation_center_location FROM contacts JOIN address_table ON address_table.address_id = contacts.address_id JOIN evacuation ON evacuation.evac_id = address_table.evacuation_id WHERE contacts.is_permitted = 1) as contacts_tmp WHERE contacts_tmp.device_covered_by = '$device_api_key_tmp'");

$contacts_obj = $contacts_query->fetchAll();

$message_query = $pdo->query("SELECT * FROM flood_alert_levels JOIN flood_alert_email ON flood_alert_levels.email_alert_id = flood_alert_email.email_alert_id WHERE flood_alert_levels.alert_remark_id = '$alert_id' LIMIT 1");

$message_obj = $message_query->fetch();
echo $message_obj->email_message;

foreach($contacts_obj as $contact_ent){
	
	$mail = new PHPMailer(true);
	try{
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
		$mail->isSMTP();                                            
		$mail->Host       = 'mail.floodranger.xyz';                    
		$mail->SMTPAuth   = true;                              
		$mail->Username   = 'smtper@floodranger.xyz';          
		$mail->Password   = ',+zx20yk,*PH';                     
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     
		$mail->Port       = 465; 

		$mail->setFrom('smtper@floodranger.xyz', 'Floodranger mailer');
		$mail->addAddress($contact_ent->email);              
		$mail->addCC('smtper@floodranger.xyz');
		$mail->addBCC('smtper@floodranger.xyz');

		$mail->isHTML(true);                                  
		$mail->Subject = 'Flood monitoring level alert update';
		$mail->Body    = $message_obj->email_message . "<br>Recommended evacuation center <br><p>". $contact_ent->evacuation_center_name . "</p><br><p>" . $contact_ent->evacuation_center_location . "</p>";
		$mail->send();

		// echo 'Message has been sent';
		echo $contact_ent->email;
	}catch(Exception $e){
		// echo "error";
	}
}

// evacuation info message 

// create evac info obj
echo "Flood alert done for email";
	// set as done for email 
$sql_update = $pdo->exec("UPDATE alert_adapter SET `is_email_sender_recognized` = 'yes', is_email_sender_success = 'done' WHERE alert_adapter.id = '$last_inserted_id'");

