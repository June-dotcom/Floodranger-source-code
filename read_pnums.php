<?php
require_once 'dbconn.php';

if(!empty($_GET['device_api_key']))
{
	$device_api_key = $_GET['device_api_key'];
  	$sql = 'SELECT * FROM contacts WHERE device_api_key = :device_api_key ORDER BY contact_priority ASC';
  	$stmt = $pdo->prepare($sql);
  	$stmt->execute(['device_api_key' => $device_api_key]);
  	$posts = $stmt->fetchAll();
	  foreach($posts as $post){
		echo $post->phone_number . ',';
	  }
}