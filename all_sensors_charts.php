 <?php 
require_once "dbconn.php";
$query = $pdo->query("SELECT * FROM `sensor_profiles`");
$result = $query->fetchAll();

foreach($result as $result_obj){
  ?>
 <div class="col-xl-6 col-lg-6 col-md-8 col-sm-6">
  <div class="card ">
    <div class="card-header">
      <?php echo $result_obj->sensor_desc; ?>
      <?php if ($all_sensor_disp_mode != "public") {
    ?>
      <div class="text-right"><a class="text-link" href="admin_sensor_table_view.php?sensor_id=<?php echo $result_obj->sensor_id; ?>">Recent logs</a></div>
      <?php
     }
      ?>
    </div>
    <div class="card-body pt-4">
      <div class="media">
        <div class="media-body">
          <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="embed_chart_dashboard.html?sensor_id=<?php echo $result_obj->sensor_id; ?>&mode=latest"></iframe>
</div>
        </div>
      </div>
    </div>
    <div class="card-footer">
    <?php if ($all_sensor_disp_mode != "public") {
    ?>
      <a href="admin_sensor_graph_view.php?sensor_id=<?php echo $result_obj->sensor_id; ?>" class="text-dark">More info</a>
      <?php
     }
      ?>

    </div>
  </div>
</div>

<?php 
}
?>