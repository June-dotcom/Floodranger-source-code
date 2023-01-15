<?php
include('dbconn.php');

if (isset($_GET['device_api_key'])) {
	$device_api_key = $_GET['device_api_key'];
	$sql = "SELECT * FROM devices WHERE device_api_key = '$device_api_key'";
	$sql_query = $pdo->query($sql);
	$device = $sql_query->fetch();
	// default timezone is asia/taipei
	date_default_timezone_set('Asia/Taipei');
	// test the timezone in zone
	// update the timezone to UTC+0
	// date_default_timezone_set('Europe/London');

	$datetime1 = new DateTime();//start time
	$datetime2 = new DateTime($device->last_update);//end time
	$interval = $datetime1->diff($datetime2);
	// activate timestamp bros
	// echo $interval->format('%Y years %m months %d days %H hours %i minutes %s seconds');//00 years 0 months 0 days 08 hours 0 minutes 0 seconds
	// 30 seconds of inactivity - offline
	$diff_yr = $interval->format('%Y');
	$diff_months = $interval->format('%m');
	$diff_days = $interval->format('%d');
	$diff_hours = $interval->format('%H');
	$diff_minutes = $interval->format('%i');
	$diff_seconds = $interval->format('%s');

// per seconds
	// realtime detect the inerval every 20 seconds of inactivity
	if ($device->sync_type == 'idling') {
		if(($diff_yr > 0 || $diff_months > 0 || $diff_days > 0 ||  $diff_hours > 0  || $diff_minutes > 15)){
			echo "Offline";
		}else if ($diff_minutes < 15) {
			echo "Idling";
		}
	}else if ($device->sync_type == 'realtime') {
		if(($diff_yr > 0 || $diff_months > 0 || $diff_days > 0 ||  $diff_hours > 0  || $diff_minutes > 0) || ($diff_seconds > 20 )){
			echo "Offline";
		}else if ($diff_seconds < 20) {
			echo "Online";
		}
	}
	
}

