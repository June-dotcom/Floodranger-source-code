<div class="card">
    <div class="card-header">
        Edit email messages
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="email_ls_tbl" class="display min-w850">
                <thead>
                    <tr>
                        <th>Email Alert id</th>
                        <th>Email message</th>
                        <th>Alert remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $sql = $pdo->query("SELECT * FROM `flood_alert_email` JOIN `flood_alert_levels` ON flood_alert_levels.email_alert_id = flood_alert_email.email_alert_id");
                   $posts = $sql->fetchAll();
                   foreach($posts as $post){
                      ?>
                      <tr>
                       <td><?php echo $post->email_alert_id; ?></td>
                       <td><?php echo $post->email_message; ?></td>
                       <td><?php echo $post->alert_remark_id; ?></td>
                       <td>
                        <a class="btn btn-primary btn-sm" href="admin_email_alert_editor.php?email_alert_id=<?php echo $post->email_alert_id; ?>">Edit</a>
                       </td>
                </tr>
                <?php 
            }
            ?>

        </tbody>

        <tfoot>
         <tr>
            <th>Email Alert id</th>
            <th>Email message</th>
            <th>Alert remarks</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
</div>

</div>


</div>
