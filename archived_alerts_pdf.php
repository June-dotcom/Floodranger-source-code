<?php ob_start(); ?>
<?php 
include 'vendor/autoload.php';
include 'dbconn.php';


$pdf = new CezPDF('b5');

$pdf->selectFont('Helvetica');
$pdf->ezText('<b>Alert logs</b>', 30);
// $pdf->ezText('Save a backup if you are going to reset it.', 12);
$curr_date =  date_formatter_military(date('m/d/Y h:i:s a', time()));
$pdf->ezText('As of ' . $curr_date , 20);

$cols = ['device_api_key' => 'Device api key', 'module_name' => 'Device name', 'alert_remark' => 'Alert remark', 'timestamp' => 'Date created'];
// $coloptions = ['num' => ['justification' => 'right'], 'name' => ['justification' => 'left'], 'type' => ['justification' => 'center']];
$conf = [
	'xPos' => 'left',
	'xOrientation' => 'right'
];
$data = array();

$query_data = $pdo->query("SELECT *, (SELECT remark_color FROM sensor_val_remarks WHERE sensor_val_remarks.remark_id = alert_adapter.alert_remark_id LIMIT 1) as remark_color_tmp FROM alert_adapter INNER JOIN flood_alert_levels ON alert_adapter.alert_remark_id = flood_alert_levels.alert_remark_id LEFT JOIN devices ON alert_adapter.frm_device_api_key = devices.device_api_key WHERE alert_adapter.is_active = 1");
// array_push($data,  ['num' => 6, 'name' => 'sauron', 'type' => 'really bad dude']);
$obj_data = $query_data->fetchAll();
foreach($obj_data as $ent_data){
	array_push($data,  ['device_api_key' => $ent_data->frm_device_api_key, 'module_name' => $ent_data->module_name, 'alert_remark'=> $ent_data->alert_remark_id, 'timestamp'=> $ent_data->timestamp]);
}

$pdf->ezTable($data, $cols, '',$conf);



if (isset($_GET['d']) && $_GET['d']) {
	ob_end_clean();
	echo $pdf->ezOutput(true);
} else {
	ob_end_clean();
	$pdf->ezStream(array('download' => 1));
}