<?php 
require_once "dbconn.php";
$query = $pdo->query("SELECT * FROM `sensor_profiles`");
$result = $query->fetchAll();

foreach($result as $result_obj){
  ?>

<?php 
  $sensor_id_ent = $result_obj->sensor_id;  
  
  $sql_tmp_ent = "SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id, sensor_ent.timestamps as updated_at, sensor_val_remarks.remark_description as sensor_val_remarks FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = '$sensor_id_ent' AND sensor_logs.is_active = 1) as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_ent.remarks_id;";
  
  $fetch_ent = $pdo->prepare($sql_tmp_ent);
  $fetch_ent->execute();
  $fetch_ent_res = $fetch_ent->fetch();
  
  ?>
<div class="col-xl-3 col-lg-6 col-md-8 col-sm-6">
  <div class="card">
    <div id="<?php echo $result_obj->sensor_id; ?>crdheader_stat" class="card-header border-0 text-white">
      <small>As of <span id="<?php echo $result_obj->sensor_id; ?>idLup"><?php echo $result_obj->updated_at; ?></span>
      </small>
      <small id="<?php echo $result_obj->sensor_id; ?>idOvflw"></small>
    </div>
    <div class="card-body pt-4">
      <div class="media">
        <div class="media-body">
          <p class="mb-1"><?php echo $result_obj->sensor_id; ?>(<?php echo $result_obj->sensor_desc; ?>)</p>
          <h1><span id="<?php echo $result_obj->sensor_id; ?>idVal"><?php echo $fetch_ent_res->sensor_val ?? '0';?>
            </span>
            <span><?php echo $result_obj->sensor_val_unit; ?></span> </h1>
          <span
            id="<?php echo $result_obj->sensor_id; ?>idValRemarks"><?php echo $fetch_ent_res->sensor_val_remarks ?? ''; ?></span>
        </div>
      </div>
    </div>
    <div class="card-footer border-0 ">
      <?php if ($all_sensor_disp_mode != "public") {
    ?>
      <a href="admin_sensor_view.php?sensor_id=<?php echo $result_obj->sensor_id ?>" class="text-dark">More info</a>
      <?php 
    }
     ?>
    </div>
  </div>
</div>
<?php
  }
  ?>