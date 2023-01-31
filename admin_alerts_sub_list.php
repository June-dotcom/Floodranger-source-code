    <div class="col col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Alerts history list</h4>
                <div class="btn-group">
                   
                      <a href="?category=active" type="button"
                        class='btn <?php echo (($_GET["category"] == "active") || (empty($_GET["category"]))) ? "btn-dark" : "btn-light"; ?>'>
                        Active alerts</a>
                        
                      <a href="?category=removed" type="button"
                        class='btn <?php echo ($_GET["category"] == "removed") ? "btn-dark" : "btn-light"; ?>'>
                        Cleared alerts archive</a>
                   
                </div>
                <div class="float-right">
                   
            <?php 
                if(empty($_GET["category"]) || $_GET["category"] == "active"){
                    ?>
             <a href="archived_alerts_pdf.php" target="_blank" class="btn btn-light">PDF archive</a>

                    <?php
                }else{
                    ?>
                        <span></span>
                    <?php
                }
            ?>

         </div>
     </div>
     <div class="card-body">
        <div class="table-responsive">
            <table id="alerts_tbl" class="display min-w850">
                <thead>
                    <tr>
                        <th>Device api key</th>
                        <th>Module name</th>
                        <th>Alert remarks</th>
                        <th>Timestamp</th>

                    </tr>
                </thead>
                <tbody>
                   <?php
                   if(empty($_GET["category"]) || ($_GET["category"] == "active")){
                    $sql = $pdo->query("SELECT *, (SELECT remark_color FROM sensor_val_remarks WHERE sensor_val_remarks.remark_id = alert_adapter.alert_remark_id LIMIT 1) as remark_color_tmp FROM alert_adapter INNER JOIN flood_alert_levels ON alert_adapter.alert_remark_id = flood_alert_levels.alert_remark_id LEFT JOIN devices ON alert_adapter.frm_device_api_key = devices.device_api_key WHERE alert_adapter.is_active = 1");
                    $posts = $sql->fetchAll();
                   }else{
                    $sql = $pdo->query("SELECT *, (SELECT remark_color FROM sensor_val_remarks WHERE sensor_val_remarks.remark_id = alert_adapter.alert_remark_id LIMIT 1) as remark_color_tmp FROM alert_adapter INNER JOIN flood_alert_levels ON alert_adapter.alert_remark_id = flood_alert_levels.alert_remark_id LEFT JOIN devices ON alert_adapter.frm_device_api_key = devices.device_api_key WHERE alert_adapter.is_active = 0");
                    $posts = $sql->fetchAll();
                   }
                  
                   foreach($posts as $post){
                      ?>
                      <tr>
                        <td>
                            <?php echo $post->frm_device_api_key; ?>
                        </td>
                        <td>
                            <?php echo $post->module_name; ?>
                        </td>
                        <td style="background-color: <?php echo $post->remark_color_tmp; ?> !important; color: white;">
                            <?php echo $post->alert_remark_id; ?>
                        </td>
                        <td>
                            <?php echo date_formatter_military($post->timestamp); ?>
                        </td>
                    </tr>
                    <?php 
                }
                ?>

            </tbody>

            <tfoot>
                <tr>
                    <th>Device api key</th>
                    <th>Module name</th>
                    <th>Alert remarks</th>
                    <th>Timestamp</th>

                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>
</div>


