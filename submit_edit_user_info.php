<?php ob_start(); ?>
<?php
include 'dbconn.php';

$contact_email = $_POST['email'];
$contact_name = $_POST['contact_name'];
$phone_number = $_POST['phone_number'];
$address_id = $_POST['address_id'];
$contact_id = $_POST['contact_id'];
$user_id = $_POST['user_id'];
// print_r($_POST);
$password = $_POST['password'];

echo $password;
echo $user_id;
$sql = "UPDATE user_credentials SET password = '$password', name = '$contact_name' WHERE id = '$user_id'";
$pdo->exec($sql);


$sql = "UPDATE contacts SET email = '$contact_email',address_id = '$address_id', phone_number = '$phone_number', contact_name='$contact_name' WHERE id = '$contact_id'";
$pdo->exec($sql);
header('Location: recipient_homepage.php');

?>