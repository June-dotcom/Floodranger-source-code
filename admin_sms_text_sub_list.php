<div class="card">
    <div class="card-header">
        Edit SMS messages
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="sms_list_tbl" class="display min-w850">
                <thead>
                    <tr>
                        <th>SMS Alert id</th>
                        <th>SMS messages</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                 <?php
                 $sql = $pdo->query("SELECT * FROM `flood_alert_sms` JOIN `flood_alert_levels` ON flood_alert_levels.sms_alert_id = flood_alert_sms.sms_alert_id");
                 $posts = $sql->fetchAll();
                 foreach($posts as $post){
                  ?>
                  <tr>
                     <td><?php echo $post->sms_alert_id; ?></td>

                     <td><?php echo $post->sms_message; ?> </td>
                     <td><?php echo $post->alert_remark_id; ?> </td>

                     <td>
                        <button type="button" class="btn btn-info btn-round btn-sm"
                        data-toggle="modal" data-target="#editModal<?php echo $post->id?>">Edit</button>
                    </td>
                  
         <!-- modal start -->
         <div class="modal fade" id="editModal<?php echo $post->id?>" tabindex="-1" aria-labelledby="editModal<?php echo $post->id?>" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="submit_edit_sms_message.php" id="form_edit_contact<?php echo $post->id;?>" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title " id="editModal<?php echo $post->id?>">Edit sms messages for <?php echo $post->sms_alert_id; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="sms_message_id" value="<?php echo $post->sms_alert_id; ?>">
                        <div class="form-group">
                            <label>SMS message</label>
                            <textarea class="form-control" name="sms_message_edit" rows="4" id="smseditform<?php echo $post->id?>"><?php echo $post->sms_message; ?></textarea>
                            <span id="remainingChar<?php echo $post->id?>"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-secondary"
                   data-dismiss="modal">Close</button>
                   <input type="submit" class="btn btn-primary" form="form_edit_contact<?php echo $post->id?>" value="Save changes" name="">
               </div>
           </div>
       </div>
       <!-- modal end -->

   </tr>
   <?php 
}
?>

</tbody>

<tfoot>
   <tr>
    <th>SMS Alert id</th>
    <th>SMS messages</th>
    <th>Actions</th>

</tr>
</tfoot>
</table>
</div>

</div>


</div>
