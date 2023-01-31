<?php
include 'dbconn.php';

date_default_timezone_set('Asia/Manila');
$device_api_key = $_GET['device_api_key'];
$sensor_id = $_GET['sensor_id'];
$current_water_level = $_GET['water_level'];
$remarks_id = $_GET['fld_level_status'];

$chk_if_reset = $pdo->query("SELECT COUNT(*) as count_reset_if FROM sensor_logs WHERE sensor_value IS NULL AND sensor_id = '$sensor_id' LIMIT 1");
$chk_if_reset_obj = $chk_if_reset->fetch();
// just update the first row
if($chk_if_reset_obj->count_reset_if >= 1){
  $pdo->exec("UPDATE sensor_logs SET sensor_value = '$current_water_level', timestamps = now() WHERE sensor_value IS NULL AND sensor_id = '$sensor_id'");
}else{
  $sql = "INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`,  `remarks_id`, `timestamps`) VALUES (NULL, :sensor_id, :current_water_level, :remarks_id_val, current_timestamp())";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['current_water_level' => $current_water_level, 'sensor_id' => $sensor_id, 'remarks_id_val' => $remarks_id]);
}

// email alert start

if($remarks_id != 'FLDNRML'){
  // device based alert id
  // $fetch_flvl_qry = $pdo->query("SELECT flood_alert_levels.*, sensor_val_remarks.priority_id FROM flood_alert_levels JOIN sensor_val_remarks ON flood_alert_levels.alert_remark_id = sensor_val_remarks.remark_id WHERE flood_alert_levels.device_api_key = '$device_api_key' && alert_remark_id =  '$remarks_id' LIMIT 1;");
  // fetch alert id from alert levels
  $fetch_flvl_qry = $pdo->query("SELECT flood_alert_levels.*, sensor_val_remarks.priority_id FROM flood_alert_levels JOIN sensor_val_remarks ON flood_alert_levels.alert_remark_id = sensor_val_remarks.remark_id WHERE alert_remark_id =  '$remarks_id' LIMIT 1;");
  $fetch_flvl_res = $fetch_flvl_qry->fetch();

  $device_api_key_tmp = $device_api_key;
  $alert_id_tmp =  $fetch_flvl_res->alert_remark_id;

  // select latest alert adapter based on deviceapikey/sensor id
//SELECT * FROM alert_adapter JOIN flood_alert_levels ON flood_alert_levels.alert_id = alert_adapter.alert_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = flood_alert_levels.alert_remarks  WHERE frm_device_api_key = 'URDFLD01' ORDER BY timestamp DESC LIMIT 1;
  $fetch_alrt_adpt_qry = $pdo->query("SELECT * FROM alert_adapter JOIN flood_alert_levels ON flood_alert_levels.alert_remark_id = alert_adapter.alert_remark_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = flood_alert_levels.alert_remark_id  WHERE frm_device_api_key = '$device_api_key_tmp' AND alert_adapter.is_active = 1 ORDER BY timestamp DESC LIMIT 1");
  $fetch_alrt_adpt_res = $fetch_alrt_adpt_qry->fetch();
  // if latest from device api key alert id is matched from fetched alert id
  echo json_encode($fetch_alrt_adpt_res);
  echo "<br>";
  // detect empty alert
  if($fetch_alrt_adpt_res === FALSE){
    echo "Empty table insert alert";
    include 'alertify_sub_adapter.php';
  }else{

   if($fetch_alrt_adpt_res->alert_remark_id == $fetch_flvl_res->alert_remark_id){


    // after span of 5 hours 
    echo "<br>Same alert within Interval hrs";

    if (getTimeDiff($fetch_alrt_adpt_res->timestamp) > setTimeHourIntervalAlert($pdo)) {
      echo "<br>More than 5 hrs Inserten alert";

      include 'alertify_sub_adapter.php';
    }
  }else{
  // if new priority id is more than previous priority id 
  // new_prio in fetch lvl > old_prio_fetch alrt adpt_res 
  // insert stmt and alert
  // else
  // print do not insert 
    if( $fetch_flvl_res->priority_id > $fetch_alrt_adpt_res->priority_id){
      echo "<br>From lower to upper insert";
      // frm alert a to b
      include 'alertify_sub_adapter.php';

    }else{
    // do not repeat alert levels if the water will be rise down
    // if flood normal evacuate the residents
    // rely to timestamp hr limit to repeat again alert

    // after span of 5 hours

      echo "<br>From upper to lower";

      if (getTimeDiff($fetch_alrt_adpt_res->timestamp) > setTimeHourIntervalAlert($pdo)) {
        echo "<br>Insert OK!";
        include 'alertify_sub_adapter.php';
      }

    }
  }
  // do not insert
  // else if new alert id 
  // insert new alert


// END OF ALERT EVAL 
}


}


// email alert end
echo '<br>Water log inserted';

?>

<?php 
function getTimeDiff($timestamp_tmp){
 $timestamp_epoch =  intval(strtotime($timestamp_tmp));
 $current_time_epoch = intval(time());

 $epoch_diff_time_curr = $timestamp_epoch - $current_time_epoch;

 $epoch_diff_time_hr = abs($epoch_diff_time_curr) / 3600;
 return (int)$epoch_diff_time_hr;
}

function setTimeHourIntervalAlert($pdo){
  // include 'dbconn.php';
  $query_interval = $pdo->query("SELECT * FROM preferences WHERE pref_id = 'PREFHRINTERVAL' LIMIT 1");
  $obj_interval = $query_interval->fetch();
  echo $obj_interval->pref_val;
  return (int)$obj_interval->pref_val;
}


?>