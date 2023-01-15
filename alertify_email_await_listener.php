<?php
include 'dbconn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// get query obj
$query = $pdo->query("SELECT * FROM alert_adapter WHERE is_email_sender_recognized = 'no' ORDER BY timestamp ASC;");

if ($query->fetch()) {
	// initialize alert id
	$post_result = $query->fetch();

	$post_alert_id = $post_result->alert_id;
	$post_id = $post_result->id;
	// $query_alert_by = $pdo->query("SELECT * FROM flood_alert_levels JOIN flood_alert_email ON flood_alert_levels.email_alert_id = flood_alert_levels.email_alert_id WHERE flood_alert_levels.alert_id = '$post_alert_id' LIMIT 1");
	// $result_alert = $query_alert_by->fetch();
   // initialized email message txt
	// $email_msg_txt = $result_alert->email_message;

	// initialized email contacts

	$contacts_query = $pdo->query("SELECT * FROM contacts JOIN address_table ON address_table.id = contacts.address_id JOIN flood_alert_levels ON flood_alert_levels.device_api_key = address_table.device_covered_by JOIN flood_alert_email ON flood_alert_email.email_alert_id = flood_alert_levels.email_alert_id WHERE flood_alert_levels.alert_id ='$post_alert_id'");

	$contacts_obj = $contacts_query->fetchAll();

	foreach($contacts_obj as $contact_ent){
		$mail = new PHPMailer(true);
		try{
		  	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
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
		    $mail->Body    = $contact_ent->email_message;
		    $mail->send();

    		echo 'Message has been sent';
		}catch(Exception $e){
			echo "error";
		}
	}

	echo "Flood alert done for email";
	// set as done for email 
	$sql_update = $pdo->exec("UPDATE alert_adapter SET `is_email_sender_recognized` = 'yes', is_email_sender_success = 'done' WHERE alert_adapter.id = '$post_id'");

}else{
	echo "Empty";
}
