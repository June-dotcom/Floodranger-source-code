<?php ob_start(); ?>
<?php session_start(); ?>
<?php include 'auth_middleware.php'; ?>
<?php include 'dbconn.php'; ?>
<?php include 'auth.php'; ?>
<?php middleware_user_level_admin($_SESSION['user_level']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Floodranger cloud admin</title>
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

</head>
<style type="text/css">

</style>
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
<script type="text/javascript">

</script>
<div id="main-wrapper">

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
    $section = "Hazard map";
    include 'header_nav.php';
    include 'deznav_navbar.php';
    ?>

    <div class="content-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col col-12 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            Urdaneta flood alert hazard map
                        </div>
                        <div class="card-body">
                            <?php include 'urdaneta_map.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            Remarks
                        </div>
                        <div class="card-body">
                         <div class="basic-list-group">
                            <ul class="list-group">
                                <?php 
                                $flood_lvl_remarks = "SELECT * FROM sensor_val_remarks";

                                $fetch_ent = $pdo->prepare($flood_lvl_remarks);
                                $fetch_ent->execute();
                                $fetch_ent_res = $fetch_ent->fetchAll();

                                ?>
                                 <li class="list-group-item text-white" style="background-color: #73777B;">Areas with offline flood monitoring device associated </li>

                                <?php 
                                foreach($fetch_ent_res as $fetch_ent_obj){
                                    ?>
                                    <li class="list-group-item text-white" style="background-color: <?php echo $fetch_ent_obj->remark_color; ?>;">Areas with <?php echo $fetch_ent_obj->remark_description;?></li>

                                    <?php 
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>
<script src="vendor/owl-carousel/owl.carousel.js"></script>

<!-- Chart piety plugin files -->
<script type="text/javascript" src="script_urdaneta_map.js"></script>
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

<!-- <script type="text/javascript">
    $(document).ready(function(){
        $(".d.anonas").css("fill", "#FFB200");
        $(".d.tulong").css("fill", "#FFB200");
        $(".d.camantiles").css("fill", "#FFB200");

    });
</script> -->
</body>


</html>