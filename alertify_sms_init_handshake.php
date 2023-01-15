<?php
// using our sim800l sender module serverbased 
include 'dbconn.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$sms_sender_api_key = $_GET['sms_sender_api_key'];
	//gived to latest alerts adapter
	$query = $pdo->query("SELECT * FROM alert_adapter WHERE is_sms_sender_recognized = 'no' ORDER BY timestamp ASC LIMIT 1");
	$post_result =$query->fetch();
	if ($post_result == NULL) {
		echo 'NA';
	}else{
		echo $post_result->id;
	}
}
