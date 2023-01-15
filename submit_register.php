<?php ob_start(); ?>
<?php 
include "dbconn.php";
include "global_env.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// error_reporting(E_ALL);
// ini_set("display_errors", 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$contact_email = $_POST['email'];
	$password_form_value = $_POST['password'];
	$phone_number = $_POST['phone_number'];
	$contact_name = $_POST['contact_name'];
	$address_id = $_POST['address_id'];
	echo $address_id;

	$sql = "INSERT INTO `user_credentials` (`id`, `role_name`, `name`, `email`, `password`, `is_email_verified` , `created_at`, `updated_at`) VALUES (NULL, 'recipient', '$contact_name', '$contact_email', '$password_form_value', '0',current_timestamp(), current_timestamp())";

	$pdo->exec($sql);

	$last_inserted_id = $pdo->lastInsertId();
	echo "<br>last_inserted_id: " . $last_inserted_id;

	echo $last_inserted_id;
	$sql = "INSERT INTO contacts (email, phone_number, contact_name, address_id,assoc_user_id,is_permitted) VALUES ('$contact_email','$phone_number', '$contact_name', '$address_id',  $last_inserted_id, '0')";
	$pdo->exec($sql);

		// fetch user id first 
	$query = $pdo->query("SELECT * FROM user_credentials WHERE email = '$contact_email'");
	$user_obj = $query->fetch();

	$user_id = $user_obj->id;
	echo "<br>User id: " . $user_id;

	// echo "Pass 2";
	// put some email verification there 
	$generate_uniq_id = substr(str_shuffle(md5(time())), 0, 10);

	// get email verification to db
	$sql = "INSERT INTO `email_verify_token` (`id`, `auth_token_id`, `user_id`, `created_at`, `updated_at`) VALUES (null, '$generate_uniq_id', '$last_inserted_id', current_timestamp(), current_timestamp())";

	$pdo->exec($sql);

	// change this to floodranger.xyz
	$email_link_to_verify = $hosted_link . 'next_step_email_confirmed.php?email_token=' . $generate_uniq_id; 

	// echo "Pass 3";

	include "email_body_verify.php";

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
		$mail->addAddress($contact_email);              
		$mail->addCC('smtper@floodranger.xyz');
		$mail->addBCC('smtper@floodranger.xyz');

		$mail->isHTML(true);                                  
		$mail->Subject = 'Email permission for floodranger alert notification';
		$mail->Body    = $mail_body;
		$mail->send();
		echo 'Message has been sent';

	}catch(Exception $e){
		echo "error";
	}
	ob_clean();
	header("Location: verify_your_email.php");

}

?>

