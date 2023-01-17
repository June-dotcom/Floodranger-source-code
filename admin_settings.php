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
    <title>Floodranger admin settings</title>
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

<div id="main-wrapper">


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
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>

                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <a href="admin_settings_sms.php">
                    <div class="card">

                        <div class="card-body">
                            <p class="text-center">
                                <img src="images/chatting.png"  height="150">
                            </p>
                        </div>
                        <div class="card-footer">

                            <h3 class="text-center lead">Edit sms message alerts</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a href="admin_settings_email.php">
                    <div class="card">

                        <div class="card-body">
                            <p class="text-center">
                                <img src="images/email.png" height="150">
                            </p>
                        </div>
                        <div class="card-footer">
                            <h3 class="text-center lead">Edit email message alerts</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-4">
                <a href="admin_evacuation_brgy.php">
                    <div class="card">

                        <div class="card-body">
                            <p class="text-center">

                                <img src="images/evacuation-plan.png" height="150">
                            </p>
                        </div>
                        <div class="card-footer">
                            <h3 class="text-center lead">Edit evacuation in each barangays</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-4">
                <a href="admin_settings_evac_sites.php">
                    <div class="card">

                        <div class="card-body">
                            <p class="text-center">
                                <img src="images/school.png" height="150">
                            </p>
                        </div>
                        <div class="card-footer">
                            <h3 class="text-center lead">Edit evacuation sites</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-4">
                <a href="admin_settings_misc.php">
                    <div class="card">

                        <div class="card-body">
                            <p class="text-center">

                                <img src="icons/settings_icon.svg" height="150">
                            </p>
                        </div>
                        <div class="card-footer">
                            <h3 class="text-center lead">Cloud admin settings</h3>
                        </div>
                    </div>
                </a>
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

<!-- Apex Chart -->
<script src="vendor/apexchart/apexchart.js"></script>

<!-- Bootstrap select -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</html>
<!-- Dashboard 1 -->
<script src="js/dashboard/dashboard-1.js"></script>
<script>
    $(document).ready( function () {
        $('#contacts_tbl').DataTable();
    } );
    
    jQuery(window).on('load', function () {
        setTimeout(function () {
            carouselReview();
        }, 1000);
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

</body>

<!-- Mirrored from gymove.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Mar 2022 22:28:19 GMT -->

</html>