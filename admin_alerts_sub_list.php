    <div class="col col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Alerts history list</h4>
                <div class="float-right">
                    <?php 
                    $sql_query_devices = $pdo->query("SELECT * FROM devices");
                    $obj_devices = $sql_query_devices->fetchAll();
                    ?>
                    <?php 
                    foreach($obj_devices as $ent_device){
                        ?>
                        <button type="button" class="btn btn-danger btn-round btn-sm"
                        data-toggle="modal" data-target="#deleteModal<?php echo $ent_device->device_api_key; ?>">Reset <?php echo $ent_device->device_api_key; ?> </button>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $ent_device->device_api_key; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-body">
                                 Do you want to reset alert flags for <?php echo $ent_device->device_api_key; ?> ?
                              </div>
                              <div class="modal-footer">
                                <a class="btn btn-danger btn-sm" href="reset_alert_flags.php?device_api_key=<?php echo $ent_device->device_api_key; ?>">Ok</a>
                                 <button type="button" class="btn btn-sm btn-secondary"
                                 data-dismiss="modal">No</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- end of modal -->
                 <?php
             }
             ?>
             <a href="archived_alerts_pdf.php" target="_blank" class="btn btn-light">Archived view</a>

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
                   //
                   $sql = $pdo->query("SELECT *, (SELECT remark_color FROM sensor_val_remarks WHERE sensor_val_remarks.remark_id = alert_adapter.alert_remark_id LIMIT 1) as remark_color_tmp FROM alert_adapter INNER JOIN flood_alert_levels ON alert_adapter.alert_remark_id = flood_alert_levels.alert_remark_id LEFT JOIN devices ON alert_adapter.frm_device_api_key = devices.device_api_key");
                   $posts = $sql->fetchAll();
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


