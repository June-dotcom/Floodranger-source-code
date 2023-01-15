<?php ob_start(); ?>
<?php
include 'dbconn.php';
$contact_email = $_POST['email'];
$contact_name = $_POST['contact_name'];
$phone_number = $_POST['phone_number'];
$address_id = $_POST['address_id'];

$sql = "INSERT INTO contacts (email, phone_number, contact_name, address_id, is_permitted) VALUES ('$contact_email','$phone_number', '$contact_name', '$address_id', '1')";
$pdo->exec($sql);

header('Location: admin_contacts.php');

?>