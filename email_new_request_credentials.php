<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'dbconn.php';
include 'global_env.php';
$email_to_be_req = $_GET['email'];
ob_start();


// create login credentials with unknown password
$query = $pdo->query("SELECT * FROM contacts WHERE email = '$email_to_be_req' LIMIT 1");
$user_obj = $query->fetch();

	// change to create login credentials

$generated_password = uniqid();
$contact_name_tmp = $user_obj->contact_name;

$query_email = $pdo->query("SELECT COUNT(email) as count_email FROM user_credentials WHERE email = '$email_to_be_req'");
$query_email_obj = $query_email->fetch();

if($query_email_obj->count_email >= 1){
	ob_end_clean();
	include 'error_duplicate_email_found.php';
}else{
	$sql = "INSERT INTO `user_credentials` (`id`, `role_name`, `name`, `email`, `password`, `is_email_verified` , `created_at`, `updated_at`) VALUES (NULL, 'recipient', '$contact_name_tmp', '$email_to_be_req', '$generated_password', '0',current_timestamp(), current_timestamp())";

	$pdo->exec($sql);

	$last_inserted_id = $pdo->lastInsertId();
	$generate_uniq_id = substr(str_shuffle(md5(time())), 0, 10);

	// get email verification to db
	$sql = "INSERT INTO `email_req_login_token` (`id`, `req_token_id`, `user_id`, `created_at`, `updated_at`) VALUES ('', '$generate_uniq_id', '$last_inserted_id', current_timestamp(), current_timestamp())";

	$pdo->exec($sql);

// change this to floodranger.xyz
	$email_link_to_verify = $hosted_link . 'verify_request_login_creds.php?email_token=' . $generate_uniq_id; 

	include "email_body_req_login.php";

	$mail = new PHPMailer(true);
	try{
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
		$mail->isSMTP();                                            
		$mail->Host       = $smtp_mail_host;                    
		$mail->SMTPAuth   = true;                              
		$mail->Username   = $smtp_mail_username;          
		$mail->Password   = $smtp_mail_password;                     
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     
		$mail->Port       = $smtp_mail_port; 

		$mail->setFrom('smtper@floodranger.xyz', 'Floodranger mailer');
		$mail->addAddress($email_to_be_req);              
		$mail->addCC('smtper@floodranger.xyz');
		$mail->addBCC('smtper@floodranger.xyz');

		$mail->isHTML(true);                                  
		$mail->Subject = 'Floodranger email login requests';
		$mail->Body    = $mail_body;
		$mail->send();
		echo 'Message has been sent';
	}catch(Exception $e){
		echo "error";
	}
	ob_end_clean();
	include 'success_email_request.php';
}

?>


