<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include "email_body_login_creds.php";

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
	$mail->addAddress($email_to_be_req);              
	$mail->addCC('smtper@floodranger.xyz');
	$mail->addBCC('smtper@floodranger.xyz');

	$mail->isHTML(true);                                  
	$mail->Subject = 'Floodranger login credentials';
	$mail->Body    = $mail_body;
	$mail->send();

	echo 'Message has been sent';
}catch(Exception $e){
	echo "error";
}

?>


