<?php ob_start(); ?>
<?php session_start(); ?>
<?php
if(!(isset($_SESSION['user_id']))){
    header('location: login.php');
}
?>
<?php include 'dbconn.php'; ?>
<?php include 'auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Floodranger admin dashboard</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>

<body>

    <!--*******************
Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
    <!--*******************
Preloader end
********************-->

    <!--**********************************
Main wrapper start
***********************************-->
<div id="main-wrapper">

        <!--**********************************
Nav header start
***********************************-->


<?php 
$section = "Contacts";
include 'header_nav.php';
include 'deznav_navbar.php';
?>
        <!--**********************************
Sidebar end
***********************************-->

        <!--**********************************
Content body start
***********************************-->

        <!--**********************************
Content body end
***********************************-->

<div class="content-body">
    <!-- row contains all cards -->
    <div class="container-fluid">

        <div class="row">
            <?php include('admin_sub_contact_rev.php'); ?>
        </div>
    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>
<script src="vendor/owl-carousel/owl.carousel.js"></script>

<!-- Chart piety plugin files -->
<script src="vendor/peity/jquery.peity.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<!-- Bootstrap select -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</html>
<!-- Dashboard 1 -->
<script src="js/dashboard/dashboard-1.js"></script>
<script>
    $(document).ready( function () {
        $('#contacts_tbl').DataTable({
            responsive: true
        });
    });
    
    // form_add_new_contact

    $("#save_changes_add").click(function(){
      var email_val = $("#add_contact_email").val();
      $.getJSON("duplicate_email_find.php", {email: email_val}, function(data){
        console.log(data);
        console.log(data.isExistUsers.result);
        console.log(data.isExistContacts.result);
        // if(data.isExistUsers.result >= 1){
        //     $("#reg_status_fields").html("Email already exists! login instead");
        // }
        if(data.isExistContacts.result >= 1){
            $("#reg_status_fields").html("Email already exists in contacts please use another email");        
        }else if(data.isExistContacts.result == 0){
            $("#form_add_new_contact").submit();
        }
    });


  });

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

<!-- Datatable -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>

</body>

<!-- Mirrored from gymove.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Mar 2022 22:28:19 GMT -->

</html>