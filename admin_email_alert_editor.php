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

    <!-- Summernote -->
    <link href="vendor/summernote/summernote.css" rel="stylesheet">
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
<div class="nav-header">
    <a href="index.html" class="brand-logo">
        <img class="logo-abbr" src="images/logo.png" alt="">
        <img class="logo-compact" src="images/logo-text.png" alt="">
        <img class="brand-title" src="images/logo-text.png" alt="">
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<?php 
$section = "Settings";
include 'header_nav.php';
include 'deznav_navbar.php';
?>

<div class="content-body">
    <!-- row contains all cards -->
    <div class="container-fluid">
        <div class="page-titles">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin_settings.php">Settings</a></li>
                <li class="breadcrumb-item"><a href="admin_settings_email.php">Email</a></li>
                <li class="breadcrumb-item active" aria-current="page">Email alerts editor</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Email alerts editor for <?php echo $_GET['email_alert_id'];?></h4>
                    <div style="float: right"><button id="submitvalEmail" class="btn btn-primary">Submit</button></div>
                </div>
                <div class="card-body">
                    <div id="summernote"></div>
                </div>
            </div>
        </div>
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
<script>
    $(document).ready( function () {
        const queryCurrentURL = window.location.search;
        const getURLParams = new URLSearchParams(queryCurrentURL);
        const email_alert_id = getURLParams.get('email_alert_id');
        const fetchURL = "get_email_txt_by_ealrtid.php?email_alert_id=" + email_alert_id;
        $('#summernote').summernote({
          toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
    ]
});
        var email_contents = $.get(fetchURL, function(data){
            $('#summernote').summernote('code', data);
      });
        // initialize

    });


    $('#submitvalEmail').click(function(){
        const queryCurrentURL = window.location.search;
        const getURLParams = new URLSearchParams(queryCurrentURL);
        const email_alert_id = getURLParams.get('email_alert_id');

        var email_txt = $('#summernote').summernote('code');

        $.post("submit_edit_email_message.php", {
            email_message_id: email_alert_id,
            email_message_edited: email_txt
        }, function(result, status){

            if (status == "success") {
                window.location.href = "admin_settings_email.php";
            }
        });
    });
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

<!-- Summernote -->
<script src="vendor/summernote/js/summernote.min.js"></script>
<!-- Summernote init -->
<script src="js/plugins-init/summernote-init.js"></script>

</body>

<!-- Mirrored from gymove.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Mar 2022 22:28:19 GMT -->

</html>