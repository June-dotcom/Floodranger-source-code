<?php ob_start(); ?>
<?php session_start(); ?>
<?php include 'auth_middleware.php'; ?>
<?php include 'dbconn.php'; ?>
<?php include 'auth.php'; ?>
<?php middleware_user_level_recipient($_SESSION['user_level']); ?>
<?php $user_id = $_SESSION['user_id']; ?>
<?php 
$user_qry = $pdo->query("SELECT * FROM user_credentials WHERE id = '$user_id' LIMIT 1");
$user_obj = $user_qry->fetch();
?>

<?php 
    if ($user_obj->is_active == "0") {
        header("Location: reactivate_your_account.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Floodranger recipient</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="css/addstyle_landing.css">

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>
  <?php 
  if($user_obj->is_email_verified == 1){
    ?>
    <?php
    $display_page = "index";
    include "recipient_page_nav.php";

    // get addressid

    $query_get_user_info = $pdo->query("SELECT contacts.id as contacts_id, contacts.*, evacuation.*, address_table.* FROM contacts JOIN address_table ON address_table.address_id = contacts.address_id JOIN evacuation ON evacuation.evac_id = address_table.evacuation_id WHERE contacts.assoc_user_id = '$user_id'");
    $obj_get_user_info = $query_get_user_info->fetch();

    $address_id = $obj_get_user_info->address_id;

    $query_get_river_assoc = $pdo->query("SELECT * FROM address_table WHERE address_table.address_id = '$address_id'");
    $obj_get_device_assoc = $query_get_river_assoc->fetchAll();

    ?>

    <div class="container-fluid px-5 mt-5">
        <div class="row px-5">
            <div class="col-12 col-lg-6 col-sm-12">
                <div class="row">

                    <?php 
                    foreach($obj_get_device_assoc as $ent_device_assoc){
                        $tmp_device_api_key = $ent_device_assoc->device_covered_by;
                    // SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id, sensor_ent.timestamps as updated_at, sensor_val_remarks.remark_description as sensor_val_remarks FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = (SELECT sensor_id FROM sensor_profiles WHERE device_api_key = 'URDFLD01')) as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_ent.remarks_id;
                        $query_get_sensor_assoc = $pdo->query("SELECT sensor_ent.sensor_value as sensor_val, sensor_profiles.sensor_id , sensor_profiles.sensor_desc as sensor_desc ,  sensor_profiles.sensor_val_unit as sensor_val_unit, sensor_ent.timestamps as updated_at, sensor_val_remarks.remark_description as sensor_val_remarks FROM sensor_profiles JOIN (SELECT sensor_log_tmp.* FROM (SELECT sensor_logs.* FROM sensor_logs WHERE `sensor_id` = (SELECT sensor_id FROM sensor_profiles WHERE device_api_key = '$tmp_device_api_key' LIMIT 1)) as sensor_log_tmp ORDER BY sensor_log_tmp.timestamps DESC LIMIT 1) as sensor_ent ON sensor_ent.sensor_id = sensor_profiles.sensor_id JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_ent.remarks_id");

                        $obj_get_sensor_assoc = $query_get_sensor_assoc->fetch();
                        ?>
                        <div class="col-6">
                           <div class="card">
                             <div class="card-header border-0 bg-info text-white">
                              <small>As of <span id="<?php echo $obj_get_sensor_assoc->sensor_id; ?>idLup"><?php echo $obj_get_sensor_assoc->updated_at; ?></span>
                              </small>
                          </div>
                          <div class="card-body pt-4">
                              <div class="media">
                                <div class="media-body">
                                  <p class="mb-1"><?php echo $obj_get_sensor_assoc->sensor_id; ?>(<?php echo $obj_get_sensor_assoc->sensor_desc; ?>)</p>
                                  <h1><span id="<?php echo $obj_get_sensor_assoc->sensor_id; ?>idVal"><?php echo $obj_get_sensor_assoc->sensor_val ?? '0';?> </span>  
                                   <span><?php echo $obj_get_sensor_assoc->sensor_val_unit; ?></span> </h1>
                                   <span id="<?php echo $obj_get_sensor_assoc->sensor_id; ?>idValRemarks"><?php echo $obj_get_sensor_assoc->sensor_val_remarks ?? ''; ?></span> 
                               </div>
                           </div>
                       </div>

                   </div>
               </div>

               <?php
           }
           ?>
       </div>
   </div>
   <div class="col-12 col-lg-6">
    <div class="card">
        <div class="card-header">
            User information
            <div class="text-right">           <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deactivate_acc">
                    Deactivate account
                </button>


            </div>

            <!-- Modal -->
            <div class="modal fade" id="deactivate_acc" tabindex="-1" aria-labelledby="deactivate_accLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deactivate_accLabel">Deactivate account confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                 <p>Do you want to deactivate your account?</p>
              </div>
              <div class="modal-footer border-0">
                <a href="submit_account_deactivate.php?user_id=<?php echo $user_id; ?>" class="btn btn-sm btn-primary">Yes</a>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- end of modal -->

</div>
<div class="card-body">
    <table class="table">

      <tbody>
        <tr>
          <th scope="row">Email</th>
          <td><?php echo $obj_get_user_info->email; ?></td>
      </tr>
      <tr>
          <th scope="row">Name</th>
          <td><?php echo $obj_get_user_info->contact_name; ?></td>
      </tr>
      <tr>
          <th scope="row">Address</th>
          <td><?php echo $obj_get_user_info->barangay . ' ' . $obj_get_user_info->municipality . ' ' . $obj_get_user_info->province; ?></td>
      </tr>
      <tr>
          <th scope="row">Recommended evacuation name</th>
          <td><?php echo $obj_get_user_info->evacuation_center_name; ?></td>
      </tr>
      <tr>
          <th scope="row">Evacuation center location</th>
          <td><?php echo $obj_get_user_info->evacuation_center_location; ?></td>
      </tr>
      <tr>
          <th scope="row">Phone number</th>
          <td><?php echo $obj_get_user_info->phone_number; ?></td>
      </tr>
  </tbody>
</table>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $obj_get_user_info->contacts_id?>">Edit my info</button>

    <!-- modal start -->
    <div class="modal fade" id="editModal<?php echo $obj_get_user_info->contacts_id?>" tabindex="-1" aria-labelledby="editModal<?php echo $obj_get_user_info->contacts_id?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="submit_edit_user_info.php" id="form_edit_contact<?php echo $obj_get_user_info->contacts_id;?>" method="POST">
              <div class="modal-header">

                <h5 class="modal-title " id="editModal<?php echo $obj_get_user_info->contacts_id?>">Edit my user information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <label>Email</label>
                    <input class="form-control" name="email" id="email_id<?php echo $obj_get_user_info->contacts_id; ?>" value="<?php echo $obj_get_user_info->email ? $obj_get_user_info->email: ''; ?>" readonly></input>      

                    <label>Password</label>
                    <input class="form-control" name="password" value="<?php echo $user_obj->password ? $user_obj->password: ''; ?>"></input>

                    <hr>
                    <label>Name</label>
                    <input class="form-control" name="contact_name" value="<?php echo $obj_get_user_info->contact_name ? $obj_get_user_info->contact_name: ''; ?>"></input>             
                    <label>Phone number</label>
                    <input class="form-control" name="phone_number" value="<?php echo $obj_get_user_info->phone_number ? $obj_get_user_info->phone_number: ''; ?>"></input>


                    <label>Address</label>
                    <br/>
                    <input type="hidden" name="contact_id" value="<?php echo $obj_get_user_info->contacts_id;?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_obj->id; ?>">
                    <div id='result'></div>
                    <select name="address_id" form="form_edit_contact<?php echo $obj_get_user_info->contacts_id?>" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">

                        <?php
                        $address_query = $pdo->query("SELECT DISTINCT address_table.address_id as `address_id`, address_table.barangay, address_table.municipality, address_table.municipality, address_table.province, evacuation.evac_id  FROM address_table INNER JOIN evacuation ON address_table.evacuation_id = evacuation.evac_id");
                        $addresses = $address_query->fetchAll();
                        $user_address_id = $obj_get_user_info->address_id;

                        foreach($addresses as $address){
                            if ($user_address_id == $address->address_id) {
                                ?>
                                <option value="<?php echo $address->address_id; ?>" selected><?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province;?></option>
                                <?php
                            }else{
                                ?>
                                <option value="<?php echo $address->address_id; ?>"><?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province;?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>


                    <br/>
                    <div id='result'></div>
                    <br>
                    <div id="reg_status_fields_id<?php echo $obj_get_user_info->contacts_id?>"></div>
                </form>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
               data-dismiss="modal">Close</button>
               <button class="btn btn-primary" onclick="validateEditId('email_id<?php echo $obj_get_user_info->contacts_id; ?>', 'form_edit_contact<?php echo $obj_get_user_info->contacts_id;?>', 'reg_status_fields_id<?php echo $obj_get_user_info->contacts_id?>')">Save changes</button>

               <input hidden type="submit" class="btn btn-primary" form="form_edit_contact<?php echo $obj_get_user_info->contacts_id?>" value="Save changes" name="">
           </div>
       </div>
   </div>
   <!-- modal end -->



</div>
</div>
</div>

</div>

<?php
}else{
    ?>
    <!-- row contains all cards -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12  col-xl-8 col-lg-9 col-md-10 mt-5">
                <div class="card">

                    <div class="card-body">

                        <h1>Please wait for your email verification to be receive in your email inbox</h1>
                        <p>Note: You will not receive floodranger alerts if your email is not verified</p>
                        <a href="logout.php">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>
<script src="vendor/owl-carousel/owl.carousel.js"></script>



<!-- script for realtime update -->
<script src="script_card_fld_lvl_upd_usr.js"></script>

<!-- Chart piety plugin files -->

<script src="vendor/peity/jquery.peity.min.js"></script>

<!-- Chartist -->
<script src="vendor/chartist/js/chartist.min.js"></script>
<script src="vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>

<!-- Flot -->
<script src="vendor/flot/jquery.flot.js"></script>
<script src="vendor/flot/jquery.flot.pie.js"></script>
<script src="vendor/flot/jquery.flot.resize.js"></script>
<script src="vendor/flot-spline/jquery.flot.spline.min.js"></script>

<!-- Chart sparkline plugin files -->
<script src="vendor/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="js/plugins-init/sparkline-init.js"></script>

<!-- Chart piety plugin files -->
<script src="vendor/peity/jquery.peity.min.js"></script>
<script src="js/plugins-init/piety-init.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>

<!-- Init file -->
<script src="js/plugins-init/widgets-script-init.js"></script>

<script>
               // form edit validate email
    function validateEditId(email_edit_id, form_submit_id, status_disp_txt_id){
        // alert(email_edit_id + ' ' + form_submit_id + ' ' + status_disp_txt_id);
        var email_val = $('#' + email_edit_id).val();
        $.getJSON("duplicate_email_find.php", {email: email_val}, function(data){
        // if(data.isExistUsers.result >= 1){
        //     $("#reg_status_fields").html("Email already exists! login instead");
        // }
            if(data.isExistContacts.result >= 2){
                $('#' + status_disp_txt_id).html("Email already exists in contacts please use another email");        

            }else if(data.isExistContacts.result <= 1){
                $('#' + form_submit_id).submit();
            }
        });
    }

</script>

</body>
<!-- custom script for registration index only !!!! -->


</html>