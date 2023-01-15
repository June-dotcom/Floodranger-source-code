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
    $section = "Dashboard";
    include 'header_nav.php';
    include 'deznav_navbar.php';
    ?>

    <div class="content-body">
        <div class="container-fluid">
          <div class="page-titles">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_homepage.php">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><?php echo $_GET['sensor_id']; ?></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Flood monitoring report for <?php echo $_GET['sensor_id']; ?></h3>
            </div>
        </div>
        <div class="row">

           <div class="col-12 col-md-8 col-lg-6">
               <div class="row">
                 <div class="col-6 col-md-6 col-lg-4">
                  <div class="card">
                    <div class="card-header bg-info text-white">Current water level</div>
                    <div class="card-body"><h1 id="current_water_level_val"></h1><p id="current_water_level_timestamp"></p></div>
                </div>

            </div>
            <div class="col-6 col-md-6 col-lg-4">
              <div class="card">
                <div class="card-header bg-danger text-white">Highest water level</div>
                <div class="card-body"><h1 id="highest_water_level_val"></h1><p id="highest_water_level_timestamp"></p></div>
            </div>  
        </div>

        <div class="col-6 col-md-6 col-lg-4">
          <div class="card">
            <div class="card-header bg-success text-white">Lowest water level</div>
            <div class="card-body"><h1 id="lowest_water_level_val"></h1><p id="lowest_water_level_timestamp"></p></div>
        </div>  

    </div>
</div>
<div class="row"> 
    <div class="col-6 col-lg-4">
      <div class="card">
        <div class="card-header bg-warning text-white">Yellow alert water level</div>
        <div class="card-body"><h1 id="alert_a_val"></h1></div>
    </div>  
</div>
<div class="col-6 col-lg-4">
  <div class="card">
    <div class="card-header bg-info text-white" style="background-color: #FD841F !important;">Orange alert water level</div>
    <div class="card-body"><h1 id="alert_b_val"></h1></div>

</div>  

</div>
<div class="col-6 col-lg-4">
  <div class="card">
    <div class="card-header text-white" style="background-color: #CF0A0A !important;">Red alert water level</div>
    <div class="card-body"><h1 id="alert_c_val"></h1></div>
</div>  

</div>
</div>
</div>

<div class="col-12 col-lg-6">
    <div class="card">
        <?php 
            $sensor_id = $_GET['sensor_id'];
            $dev_info_sql = $pdo->query("SELECT * FROM sensor_profiles JOIN devices ON sensor_profiles.device_api_key = devices.device_api_key WHERE sensor_profiles.sensor_id = '$sensor_id'");
            $dev_info_res = $dev_info_sql->fetch();
        ?>
        <div class="card-header">Device info</div>
        <div class="card-body">
           <table class="table table-striped">
            <tbody>
              <tr>
                <td>Sensor type</td>
                <td><?php echo $dev_info_res->sensor_type; ?></td>
            </tr>
            <tr>
              <td>Sensor ID</td>
              <td><?php echo $dev_info_res->sensor_id; ?></td>
          </tr>
          <tr>
            <td>Sensor description</td>
            <td><?php echo $dev_info_res->sensor_desc; ?></td>
        </tr>
        <tr>
            <td>Device location</td>
            <td><?php echo $dev_info_res->module_location; ?></td>

        </tr>
    </tbody>
</table>
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

<script type="text/javascript" src="script_sensor_view.js"></script>
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
</body>


</html>