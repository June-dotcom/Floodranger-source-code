<?php
include 'dbconn.php';

date_default_timezone_set('Asia/Manila');

// revisi just update on the current log and select the latest flood level

  // $device_api_key = $_GET['device_api_key'];
  // $current_water_level = $_GET['water_level'];

  // $sql = 'UPDATE current_device_state SET water_level = :current_water_level WHERE device_api_key = :device_api_key';
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute(['current_water_level' => $current_water_level, 'device_api_key' => $device_api_key]);
  // echo 'Water level updated';

$sensor_id = $_GET['sensor_id'];
$current_water_level = $_GET['water_level'];
$remarks_id = $_GET['fld_level_status'];
$sql = "INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`,  `remarks_id`, `timestamps`) VALUES (NULL, :sensor_id, :current_water_level, :remarks_id_val, current_timestamp())";
$stmt = $pdo->prepare($sql);
$stmt->execute(['current_water_level' => $current_water_level, 'sensor_id' => $sensor_id, 'remarks_id_val' => $remarks_id]);


// START OF ALERT EVAL 
  // fetch alert_id adapter
    // join sensor
//  

// SELECT flood_alert_levels.*, sensor_val_remarks.priority_id FROM flood_alert_levels JOIN sensor_val_remarks ON flood_alert_levels.alert_remarks = sensor_val_remarks.remark_id WHERE flood_alert_levels.device_api_key = (SELECT sensor_profiles.device_api_key FROM sensor_profiles WHERE sensor_id = 'URDULTRSNR01' LIMIT 1) && alert_remarks =  'FLDLVLA' LIMIT 1;
$fetch_flvl_qry = $pdo->query("SELECT flood_alert_levels.*, sensor_val_remarks.priority_id FROM flood_alert_levels JOIN sensor_val_remarks ON flood_alert_levels.alert_remark_id = sensor_val_remarks.remark_id WHERE flood_alert_levels.device_api_key = (SELECT sensor_profiles.device_api_key FROM sensor_profiles WHERE sensor_id = '$sensor_id' LIMIT 1) && alert_remark_id =  '$remarks_id' LIMIT 1;");
$fetch_flvl_res = $fetch_flvl_qry->fetch();



echo json_encode($fetch_flvl_res);
$device_api_key_tmp = $fetch_flvl_res->device_api_key;
$alert_id_tmp =  $fetch_flvl_res->alert_remark_id;

  // select latest alert adapter based on deviceapikey/sensor id
//SELECT * FROM alert_adapter JOIN flood_alert_levels ON flood_alert_levels.alert_id = alert_adapter.alert_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = flood_alert_levels.alert_remarks  WHERE frm_device_api_key = 'URDFLD01' ORDER BY timestamp DESC LIMIT 1;
$fetch_alrt_adpt_qry = $pdo->query("SELECT * FROM alert_adapter JOIN flood_alert_levels ON flood_alert_levels.alert_remark_id = alert_adapter.alert_remark_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = flood_alert_levels.alert_remark_id  WHERE frm_device_api_key = '$device_api_key_tmp' ORDER BY timestamp DESC LIMIT 1");
$fetch_alrt_adpt_res = $fetch_alrt_adpt_qry->fetch();
  // if latest from device api key alert id is matched from fetched alert id
echo $fetch_alrt_adpt_res->alert_remark_id . "<br>";
echo "frmlvl:" . $fetch_flvl_res->alert_remark_id . "<br>";
echo "alertadapter res<br>" . json_encode($fetch_alrt_adpt_res);

if($fetch_alrt_adpt_res->alert_remark_id == $fetch_flvl_res->alert_remark_id){
  echo "Denied alerting residents duplicate found !! <br>";

  $timestamp_epoch =  intval(strtotime($fetch_alrt_adpt_res->timestamp));
  $current_time_epoch = intval(time());

  $epoch_diff_time_curr = $timestamp_epoch - $current_time_epoch;

  $epoch_diff_time_hr = abs($epoch_diff_time_curr) / 3600;
    // after span of 5 hours 

  echo $epoch_diff_time_hr;

  if ($epoch_diff_time_hr > 5) {
    include 'alertify_sub_adapter.php';
  }
}else{
  // if new priority id is more than previous priority id 
  // new_prio in fetch lvl > old_prio_fetch alrt adpt_res 
  // insert stmt and alert
  // else
  // print do not insert 
  if( $fetch_flvl_res->priority_id > $fetch_alrt_adpt_res->priority_id){
    echo "<br>FROM LOWER TO UPPER OK INSERT!!!<br>";
    echo "Alerting continue !! <br>";
    include 'alertify_sub_adapter.php';

  }else{
    // do not repeat alert levels if the water will be rise down
    // if flood normal evacuate the residents
    echo "<br>FROM UPPER TO LOWER DENY INSERT!!!<br>";       
    echo $fetch_alrt_adpt_res->timestamp . "<br>";
    // rely to timestamp hr limit to repeat again alert
    $timestamp_epoch =  intval(strtotime($fetch_alrt_adpt_res->timestamp));
    $current_time_epoch = intval(time());

    $epoch_diff_time_curr = $timestamp_epoch - $current_time_epoch;

    $epoch_diff_time_hr = abs($epoch_diff_time_curr) / 3600;
    // after span of 5 hours

    echo $epoch_diff_time_hr;

    if ($epoch_diff_time_hr > 5) {
      echo "<br>Reset alert allow again insert!!!!";
    include 'alertify_sub_adapter.php';
    }

    echo "<br>";
  }
}
  // do not insert
  // else if new alert id 
  // insert new alert


// END OF ALERT EVAL 


echo 'Water log inserted';
