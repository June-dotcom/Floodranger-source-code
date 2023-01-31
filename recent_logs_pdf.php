<?php ob_start(); ?>
<?php 
include 'vendor/autoload.php';
include 'dbconn.php';
$sensor_id = $_GET['sensor_id'];
$mode = $_GET['mode'];
$dev_info_sql = $pdo->query("SELECT * FROM sensor_profiles JOIN devices ON sensor_profiles.device_api_key = devices.device_api_key WHERE sensor_profiles.sensor_id = '$sensor_id'");
$dev_info_res = $dev_info_sql->fetch();

$pdf = new CezPDF('a4');

$pdf->selectFont('Helvetica');

$pdf->ezText('<b>Recent sensor log report</b>', 30);
$pdf->ezText($dev_info_res->sensor_desc, 20);
if($mode == "active"){
	$pdf->ezText('Active log version');
}else if($mode == "cleared"){
	$pdf->ezText('Cleared archived version');
}
$curr_date =  date_formatter_military(date('m/d/Y h:i:s a', time()));
$pdf->ezText('As of ' . $curr_date , 20);

$cols = ['sensor_val' => 'Sensor value(cm)', 'val_remarks' => 'Value remarks', 'timestamp' => 'Timestamp'];
$conf = [
	'xPos' => 'left',
	'xOrientation' => 'right'
];
$data = array();
if($mode == "active"){
	$query_data = $pdo->query("SELECT * FROM (SELECT sensor_value, timestamps, sensor_val_remarks.remark_id, sensor_val_remarks.remark_color FROM `sensor_logs` JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_logs.remarks_id WHERE sensor_id = '$sensor_id' AND sensor_logs.is_active = 1) as tbl_sensor ORDER BY timestamps DESC");
}else if($mode == "cleared"){
	$query_data = $pdo->query("SELECT * FROM (SELECT sensor_value, timestamps, sensor_val_remarks.remark_id, sensor_val_remarks.remark_color FROM `sensor_logs` JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_logs.remarks_id WHERE sensor_id = '$sensor_id' AND sensor_logs.is_active = 0) as tbl_sensor ORDER BY timestamps DESC");
}
$obj_data = $query_data->fetchAll();
foreach($obj_data as $ent_data){
	array_push($data,  ['sensor_val' => $ent_data->sensor_value, 'val_remarks' => $ent_data->remark_id, 'timestamp'=> date_formatter_military($ent_data->timestamps)]);
}

$pdf->ezTable($data, $cols, '',$conf);


if (isset($_GET['d']) && $_GET['d']) {
	ob_end_clean();
	echo $pdf->ezOutput(true);
} else {
	ob_end_clean();
	$pdf->ezStream(array('download' => 1));
}