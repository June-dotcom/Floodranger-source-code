  <?php $sensor_id = $_GET['sensor_id'];?>
  <div class="col col-12 col-lg-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Recent logs for <?php echo $sensor_id;?></h4>
            <div class="text-right"><a class="text-link" href="recent_logs_pdf.php?sensor_id=<?php echo $sensor_id; ?>">PDF archived version</a></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="sensor_table" class="display min-w850">
                    <thead>
                        <tr>
                            <th>Flood alert</th>
                            <th>Water level</th>
                            <th>Date and time</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php

                       // $sql = $pdo->query("SELECT * FROM (SELECT sensor_value, timestamps, sensor_val_remarks.remark_id, sensor_val_remarks.remark_color FROM `sensor_logs` JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_logs.remarks_id WHERE sensor_id = '$sensor_id') as tbl_sensor ORDER BY timestamps DESC")
                          $sql = $pdo->query("SELECT * FROM (SELECT sensor_value, timestamps, sensor_val_remarks.remark_id, sensor_val_remarks.remark_color FROM `sensor_logs` JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_logs.remarks_id WHERE sensor_id = '$sensor_id') as tbl_sensor ORDER BY timestamps DESC");
                       $posts = $sql->fetchAll();
                       foreach($posts as $post){
                          ?>
                          <tr>
                            <td style="background-color: <?php echo $post->remark_color;?> !important;color: white;">
                                <?php echo $post->remark_id; ?>
                            </td>
                            <td>
                                <?php echo $post->sensor_value; ?>
                            </td>
                            <td>
                                <?php echo date_formatter_military($post->timestamps); ?>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>

                </tbody>

                <tfoot>
                    <tr>
                     <th>Flood alert</th>
                     <th>Water level</th>
                     <th>Date and time</th>
                 </tr>
             </tfoot>
         </table>
     </div>

 </div>
</div>
</div>

<div class="col-12 col-lg-4">
    <div class="card">
        <?php 
            $sensor_id = $_GET['sensor_id'];
            $dev_info_sql = $pdo->query("SELECT * FROM sensor_profiles JOIN devices ON sensor_profiles.device_api_key = devices.device_api_key WHERE sensor_profiles.sensor_id = '$sensor_id'");
            $dev_info_res = $dev_info_sql->fetch();
        ?>
        <div class="card-header">Device info</div>
        <div class="card-body">
           <table class="table table-striped">
            <tbody>
              <tr>
                <td>Sensor type</td>
                <td><?php echo $dev_info_res->sensor_type; ?></td>
            </tr>
            <tr>
              <td>Sensor ID</td>
              <td><?php echo $dev_info_res->sensor_id; ?></td>
          </tr>
          <tr>
            <td>Sensor description</td>
            <td><?php echo $dev_info_res->sensor_desc; ?></td>
        </tr>
        <tr>
            <td>Device location</td>
            <td><?php echo $dev_info_res->module_location; ?></td>

        </tr>
    </tbody>
</table>
</div>
</div>

</div>
