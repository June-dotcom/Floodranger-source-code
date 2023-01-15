<div class="card">
    <div class="card-header">
        Edit evacuation sites
        <div style="float: left;">
          <button type="button" class="btn btn-primary btn-round  mt-1 mr-1" data-toggle="modal" data-target="#form_add_new">Add new</button>
      </div>
  </div>

  <!-- modal add new evac sites start -->
  <div class="modal fade" id="form_add_new" tabindex="-1" aria-labelledby="form_add_new" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title " id="form_add_new">Add new evacuation site</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <form action="submit_add_new_evac_site.php" id="form_add_new_frm" method="POST">
                        <div class="form-group">
                            <label>Evacuation center name</label>
                            <input type="text" class="form-control" form="form_add_new_frm" name="evac_name" value="">
                        </div>
                        <div class="form-group">
                            <label>Evacuation center address</label>
                            <input type="text" class="form-control" form="form_add_new_frm" name="evac_loc" value="">
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary"
           data-dismiss="modal">Close</button>
           <input type="submit" class="btn btn-primary" form="form_add_new_frm" value="Save changes" name="">
       </div>
   </div>
</div>
</div>
<!-- modal add new evac sites end -->

<div class="card-body">
    <div class="table-responsive">
        <table id="evac_brgy" class="display min-w850">
            <thead>
                <tr>
                    <th>Evacuation center name</th>
                    <th>River coverage monitoring</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
             <?php
             $sql = $pdo->query("SELECT * FROM `evacuation`");
             $posts = $sql->fetchAll();
             foreach($posts as $post){
              ?>
              <tr>
                <td><?php echo $post->evacuation_center_name; ?></td>
                <td><?php echo $post->evacuation_center_location; ?></td>

                <td>
                    <?php 
                    if ($post->evac_id != 'EVAC01') {
                        ?>
                        <button type="button" class="btn btn-info btn-round btn-sm  mt-1 mr-1"
                        data-toggle="modal" data-target="#editModalEvacCenter<?php echo $post->id; ?>">Edit evacuation center</button>
                        <button type="button" class="btn btn-danger btn-round btn-sm mt-1 mr-1"
                        data-toggle="modal" data-target="#deleteModalEvacCenter<?php echo $post->id;?>">Delete evacuation</button>
                        <?php
                    }
                    ?>

                </td>

                <!-- modal edit evac start -->
                <div class="modal fade" id="editModalEvacCenter<?php echo $post->id?>" tabindex="-1" aria-labelledby="editModalEvacCenter<?php echo $post->id; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title " id="editModalEvacCenter<?php echo $post->id; ?>">Edit evacuation site for <?php echo $post->evacuation_center_name; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="submit_edit_evac_site.php" id="form_edit_evac<?php echo $post->id?>" method="POST">
                                        <input type="hidden" name="edit_id" form="form_edit_evac<?php echo $post->id?>" value="<?php echo $post->id; ?>" >
                                        <div class="form-group">
                                            <label>Evacuation center name</label>
                                            <input type="text" class="form-control" name="evac_name" value="<?php echo $post->evacuation_center_name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Evacuation center location</label>
                                            <input type="text" class="form-control" name="evac_loc" value="<?php echo $post->evacuation_center_location; ?>">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary"
                           data-dismiss="modal">Close</button>
                           <input type="submit" class="btn btn-primary" form="form_edit_evac<?php echo $post->id?>" value="Save changes" name="">
                       </div>
                   </div>
               </div>
           </div>
           <!-- modal edit evac end -->

        <!-- modal delete evac confirmation start -->
                <div class="modal fade" id="deleteModalEvacCenter<?php echo $post->id?>" tabindex="-1" aria-labelledby="deleteModalEvacCenter<?php echo $post->id; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header border-0">
                            <h5 class="modal-title" id="deleteModalEvacCenter<?php echo $post->id; ?>">Delete evacuation named: <?php echo $post->evacuation_center_name; ?>?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      
                        <div class="modal-footer border-0">
                           <button type="button" class="btn btn-secondary btn-sm"
                           data-dismiss="modal">Cancel</button>
                           <a class="btn btn-danger btn-sm" href="delete_evac_site.php?evac_id=<?php echo $post->evac_id; ?>">Delete</a>
                       </div>
                   </div>
               </div>
           </div>
           <!-- modal delete evac confirmation end -->



       </tr>
       <?php 
   }
   ?>

</tbody>

<tfoot>
   <tr>
     <th>Evacuation center name</th>
     <th>River coverage monitoring</th>
     <th>Actions</th>


 </tr>
</tfoot>
</table>
</div>
</div>
</div>
