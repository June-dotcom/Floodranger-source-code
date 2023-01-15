<div class="card">
    <div class="card-header">
        Edit evacuation sites for barangays
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="evac_brgy" class="display min-w850">
                <thead>
                    <tr>
                        <th>Barangay</th>
                        <th>Municipality</th>
                        <th>Evacuation name</th>
                        <th>River coverage monitoring</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                 <?php
                 $sql = $pdo->query("SELECT `address_table`.id as edit_id ,  `address_table`.*, `evacuation`.*, devices.module_name, devices.device_api_key FROM `address_table` JOIN evacuation ON address_table.evacuation_id = evacuation.evac_id JOIN devices ON devices.device_api_key = address_table.device_covered_by");
                 $posts = $sql->fetchAll();
                 foreach($posts as $post){
                  ?>
                  <tr>
                    <td><?php echo $post->barangay; ?></td>
                    <td><?php echo $post->municipality; ?></td>
                    <td><?php echo $post->evacuation_center_name; ?> </td>
                    <td><?php echo $post->module_name; ?> </td>
                    <td>
                        <button type="button" class="btn btn-info btn-round btn-sm"
                        data-toggle="modal" data-target="#editModalEvac<?php echo $post->edit_id; ?>">Edit evacuation</button>

                        <button hidden type="button" class="btn btn-info btn-round btn-sm"
                        data-toggle="modal" data-target="#editModalDevice<?php echo $post->edit_id;?>">Edit device coverage</button>
                    </td>

                    <!-- modal edit evac start -->
                    <div class="modal fade" id="editModalEvac<?php echo $post->edit_id?>" tabindex="-1" aria-labelledby="editModalEvac<?php echo $post->edit_id; ?>" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title " id="editModalEvac<?php echo $post->edit_id; ?>">Edit evacuation site for <?php echo $post->barangay; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="submit_edit_evac_bgy.php" id="form_edit_evac<?php echo $post->edit_id?>" method="POST">
                                            <input type="hidden" name="edit_id" form="form_edit_evac<?php echo $post->edit_id?>" value="<?php echo $post->edit_id; ?>" >
                                            <select name="evac_id"  form="form_edit_evac<?php echo $post->edit_id?>" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                                <?php
                                                $evac_query = $pdo->query("SELECT * FROM `evacuation`");
                                                $evac_stas = $evac_query->fetchAll();
                                                $ent_evac_id = $post->evac_id;

                                                foreach($evac_stas as $evac_sta){
                                                    if ($ent_evac_id == $evac_sta->evac_id) {
                                                        ?>
                                                        <option value="<?php echo $evac_sta->evac_id; ?>" selected><?php echo $evac_sta->evacuation_center_name . ' ' . $evac_sta->evacuation_center_location; ?></option>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <option value="<?php echo $evac_sta->evac_id; ?>" ><?php echo $evac_sta->evacuation_center_name . ' ' . $evac_sta->evacuation_center_location; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>      
                                        </form>

                                        <br/>
                                        <div id='result'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                               <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">Close</button>
                               <input type="submit" class="btn btn-primary" form="form_edit_evac<?php echo $post->edit_id?>" value="Save changes" name="">
                           </div>
                       </div>
                   </div>
               </div>
               <!-- modal edit evac end -->

               <!-- modal edit dev start -->
               <div class="modal fade" id="editModalDevice<?php echo $post->edit_id?>" tabindex="-1" aria-labelledby="editModalDevice<?php echo $post->edit_id; ?>" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title " id="editModalDevice<?php echo $post->edit_id; ?>">Edit device coverage for <?php echo $post->barangay; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="submit_edit_assoc_dev.php" id="frmEditDevAssoc<?php echo $post->edit_id; ?>" method="POST">
                                    <input type="hidden" name="edit_id"  form="frmEditDevAssoc<?php echo $post->edit_id; ?>" value="<?php echo $post->edit_id; ?>" >
                                    <select name="dev_id" class="selectpicker form-control" form="frmEditDevAssoc<?php echo $post->edit_id; ?>" data-show-subtext="true" data-live-search="true">
                                        <?php
                                        $evac_query = $pdo->query("SELECT * FROM `devices`");
                                        $dev_stas = $evac_query->fetchAll();
                                        $dev_id = $post->device_api_key;

                                        foreach($dev_stas as $evac_sta){
                                            if ($dev_id == $evac_sta->device_api_key) {
                                                ?>
                                                <option value="<?php echo $evac_sta->device_api_key; ?>" selected><?php echo $evac_sta->module_name; ?></option>
                                                <?php
                                            }else{
                                                ?>
                                                <option value="<?php echo $evac_sta->device_api_key; ?>"><?php echo $evac_sta->module_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>


                                    <br/>
                                    <div id='result'></div>
                                </form>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                       data-dismiss="modal">Close</button>
                       <input type="submit" class="btn btn-primary"  form="frmEditDevAssoc<?php echo $post->edit_id; ?>" value="Save changes" name="">
                   </div>
               </div>
           </div>
       </div>
       <!-- modal edit dev end -->

   </tr>
   <?php 
}
?>

</tbody>

<tfoot>
   <tr>
    <th>Barangay</th>
    <th>Municipality</th>
    <th>Evacuation name</th>
    <th>River coverage monitoring</th>
    <th>Actions</th>


</tr>
</tfoot>
</table>
</div>
</div>
</div>
