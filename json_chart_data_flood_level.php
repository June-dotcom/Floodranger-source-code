<?php 
include 'dbconn.php';
include "json_chart_fld_obj.php";

$sensor_id = $_GET['sensor_id'];
if ($_GET['mode'] == 'latest') {
	if (isset($_GET['sensor_id'])) {
		$sensor_id = $_GET['sensor_id'];
		$query = $pdo->query("SELECT * FROM (SELECT * FROM `sensor_logs` WHERE `sensor_id` = '$sensor_id' ORDER BY timestamps DESC LIMIT 30) as tbltemp ORDER BY timestamps ASC");
		$result = $query->fetchAll();
		echo json_encode($result);
	}
}else if($_GET['mode'] == 'this_day'){
	
	$sql_tmp_fd_hr = "SELECT DISTINCT HOUR(sensor_log_tmp.timestamps) as hours, DATE(sensor_log_tmp.timestamps) as date_tmp  FROM (SELECT * FROM sensor_logs WHERE sensor_id = '$sensor_id') AS sensor_log_tmp WHERE DATE(sensor_log_tmp.timestamps) = CURDATE();";
	$hours_qry = $pdo->query($sql_tmp_fd_hr);
	$hours_res = $hours_qry->fetchAll();

	$sensor_vals_arr_obj = array();
	foreach($hours_res as $hours_obj){
	// hours disp
		$hours_obj_tmp = $hours_obj->hours;
		$date_obj_tmp = $hours_obj->date_tmp;
		$sql_tmp_fd_avg = "SELECT AVG(sensor_log_tmp.sensor_value) as avg_tmp FROM (SELECT * FROM sensor_logs WHERE sensor_id = '$sensor_id') AS sensor_log_tmp WHERE DATE(sensor_log_tmp.timestamps) = '$date_obj_tmp' AND HOUR(sensor_log_tmp.timestamps) = '$hours_obj_tmp'";
		$avg_qry = $pdo->query($sql_tmp_fd_avg);
		$avg_res = $avg_qry->fetch();

		$avrg_ent = $avg_res->avg_tmp;
		$timestamp_ent = $date_obj_tmp . " " . $hours_obj_tmp . ":00";
		array_push($sensor_vals_arr_obj, new chartValFld($avrg_ent, $timestamp_ent));
	}
	echo json_encode($sensor_vals_arr_obj);


}else if($_GET['mode'] == 'this_week'){


	$sql_tmp_fd_dly = "SELECT DISTINCT DATE(sensor_log_tmp.timestamps) as date_tmp, WEEK(sensor_log_tmp.timestamps) as week_tmp FROM (SELECT * FROM sensor_logs WHERE sensor_id = '$sensor_id') AS sensor_log_tmp WHERE WEEK(sensor_log_tmp.timestamps) = WEEK(CURDATE());";
	$dly_wk_qry = $pdo->query($sql_tmp_fd_dly);
	$dly_wk_res = $dly_wk_qry->fetchAll();

	$sensor_vals_arr_obj = array();
	foreach($dly_wk_res as $dly_wk_res_obj){
	// hours disp
		$date_obj_tmp = $dly_wk_res_obj->date_tmp;
		$week_obj_tmp = $dly_wk_res_obj->week_tmp;
		$sql_tmp_fd_wk_avg = "SELECT AVG(sensor_log_tmp.sensor_value) as avg_tmp FROM (SELECT * FROM sensor_logs WHERE sensor_id = '$sensor_id') AS sensor_log_tmp WHERE WEEK(sensor_log_tmp.timestamps) = WEEK(CURDATE()) AND DATE(sensor_log_tmp.timestamps) = DATE('$date_obj_tmp')";
		$avg_qry_wk = $pdo->query($sql_tmp_fd_wk_avg);
		$avg_res_wk = $avg_qry_wk->fetch();

		$avrg_ent = $avg_res_wk->avg_tmp;
		$timestamp_ent = $date_obj_tmp;
		array_push($sensor_vals_arr_obj, new chartValFld($avrg_ent, $timestamp_ent));
	}
	echo json_encode($sensor_vals_arr_obj);

}else if($_GET['mode'] == 'this_month'){

	$sql_tmp_fd_dly = "SELECT DISTINCT DATE(sensor_log_tmp.timestamps) as date_tmp, MONTH(sensor_log_tmp.timestamps) as month_tmp FROM (SELECT * FROM sensor_logs WHERE sensor_id = '$sensor_id') AS sensor_log_tmp WHERE MONTH(sensor_log_tmp.timestamps) = MONTH(CURDATE());";
	$dly_mt_qry = $pdo->query($sql_tmp_fd_dly);
	$dly_mt_res = $dly_mt_qry->fetchAll();

	$sensor_vals_arr_obj = array();
	foreach($dly_mt_res as $dly_mt_res_obj){
	// hours disp
		$date_obj_tmp = $dly_mt_res_obj->date_tmp;
		$month_obj_tmp = $dly_mt_res_obj->month_tmp;
		$sql_tmp_fd_mt_avg = "SELECT AVG(sensor_log_tmp.sensor_value) as avg_tmp FROM (SELECT * FROM sensor_logs WHERE sensor_id = '$sensor_id') AS sensor_log_tmp WHERE MONTH(sensor_log_tmp.timestamps) = MONTH(CURDATE()) AND DATE(sensor_log_tmp.timestamps) = DATE('$date_obj_tmp')";
		$avg_qry_mt = $pdo->query($sql_tmp_fd_mt_avg);
		$avg_res_mt = $avg_qry_mt->fetch();

		$avrg_ent = $avg_res_mt->avg_tmp;
		$timestamp_ent = $date_obj_tmp;
		array_push($sensor_vals_arr_obj, new chartValFld($avrg_ent, $timestamp_ent));
	}
	echo json_encode($sensor_vals_arr_obj);
	
}
?>