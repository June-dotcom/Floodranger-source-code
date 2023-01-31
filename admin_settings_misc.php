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
                <li class="breadcrumb-item active" aria-current="page">Cloud admin</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">

            <div class="card">
                <a href="#"  data-toggle="modal" data-target="#changeUserPassModal">

                    <div class="card-body">
                     Change user name and password

                 </div>
             </a>

         </div>
     </div>
     <!-- start of Modal -->
     <div class="modal fade" id="changeUserPassModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="changeUserPassModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changeUserPassModalLabel">Change my credentials</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="submit_mod_cred_admin.php" method="POST" id="chngUserPassform">
            <?php 
            $user_id = $_SESSION['user_id'];
            $user_query = $pdo->query("SELECT * FROM user_credentials WHERE id = '$user_id' LIMIT 1");
            $user_obj = $user_query->fetch();
            ?>
            <input type="hidden" name="user_id_edit" value="<?php echo $user_obj->id; ?>">
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="email_edit" value="<?php echo $user_obj->email; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="text" name="pass_edit" value="<?php echo $user_obj->password; ?>">
            </div>
            <div class="form-group">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" form="chngUserPassform">Confirm</button>
    </div>
</div>
</div>
</div>
<!-- end of modal -->
<div class="col-12 col-lg-8">
    <div class="card">
            <div class="card-header">
                Reset contacts
            </div>
            <div class="card-body">
               <p><span class="font-weight-bold">Clear list</span>&nbsp;Hide all contacts from the contact list. Data can be restored</p>
               <p><span class="font-weight-bold text-red">Erase all</span>&nbsp;Remove all contacts from the list forever. Data cannot be restored.</p>
            </div>
            <div class="card-footer">
            <a href="#"  data-toggle="modal" class="font-weight-bold btn btn-light" data-target="#clearContacts">
                Clear list
            </a>
    
            <a href="#"  data-toggle="modal" class="text-red font-weight-bold btn btn-light" data-target="#resetContacts">
                Erase all
            </a>

            </div>
    </div>
</div>
<!-- start of clear Modal -->
<div class="modal fade" id="clearContacts" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="clearContactsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clearContactsLabel">Clear contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
     Do you want to clear all contacts and user created accounts? All contacts and user created accounts will be empty. Data can be restored in the archive tab.
 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
    <a href="reset_contacts.php?mode=archive" class="btn btn-danger" >Confirm</a>
</div>
</div>
</div>
</div>
<!-- end of clear modal -->

<!-- start of erase Modal -->
<div class="modal fade" id="resetContacts" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="resetContactsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetContactsLabel">Reset contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
     Do you want to erase all. Remove all contacts from the list forever. Data cannot be restored.It is recommended that you download the PDF archive of the contacts before confirming.
 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
    <a href="contacts_backup_pdf.php" class="btn btn-primary btn-sm">Download PDF archive</a>
    <a href="reset_contacts.php?mode=erase" class="btn btn-danger btn-sm">Confirm</a>
</div>
</div>
</div>
</div>
<!-- end of erase modal -->

<!-- start of reset sensor logs card -->
<div class="col-12 col-lg-8">
    <div class="card">
            <div class="card-header">
                Reset sensor logs
            </div>
            <div class="card-body">
            <p><span class="font-weight-bold">Clear list</span>&nbsp;Clean all sensor logs from the dashboard. Data can be viewed in the archive tab</p>
               <p><span class="font-weight-bold text-red">Erase all</span>&nbsp;Remove all contacts from the database forever. Data cannot be restored.</p>
            </div>
            <div class="card-footer">
            <a href="#"  data-toggle="modal" class="btn btn-light font-weight-bold" data-target="#clearListSensorLogs">
                Clear list
            </a>
            <a href="#"  data-toggle="modal" class="btn btn-light text-red font-weight-bold" data-target="#resetSensorLogs">
                Erase all 
            </a>
            </div>
    </div>
</div>
<!-- end of reset sensor logs card -->

<!-- start of  clear list sensor logs card Modal -->
<div class="modal fade" id="clearListSensorLogs" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="clearListSensorLogsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clearListSensorLogsLabel">Sensor logs clear list </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
     Do you want to clear all sensor logs? All flood monitoring logs and graphs will be empty. Data can be restored in the archive tab.
 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
    <a href="reset_sensor_logs.php?mode=archive" class="btn btn-danger" >Confirm</a>
</div>
</div>
</div>
</div>
<!-- end of modal -->

<!-- start of reset sensor logs modal -->
<div class="modal fade" id="resetSensorLogs" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="resetSensorLogsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetSensorLogsLabel">Reset sensor logs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
     Do you want to clear all sensor logs? All flood monitoring logs and graphs will be empty. Data cannot be restored.<br> It is recommended to download the backup before deleting all the sensor logs data.
 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
    <a href="recent_logs_global_pdf.php" class="btn btn-info btn-sm" >Download PDF archive</a>
    <a href="reset_sensor_logs.php?mode=erase" class="btn btn-danger btn-sm" >Confirm</a>
</div>
</div>
</div>
</div>
<!-- end of reset sensor logs modal -->
<!-- card reset alert logs -->
<div class="col-12 col-lg-8">
    <div class="card">
            <div class="card-header">
                Reset alert logs
            </div>
            <div class="card-body">
                <p><span class="font-weight-bold">Clear list</span>&nbsp;Clean all alert logs from the list. Data can be viewed in the archive tab</p>
               <p><span class="font-weight-bold text-red">Erase all</span>&nbsp;Remove all alert logs from the database forever. Data cannot be restored.</p>
            </div>
            <div class="card-footer">
            <a href="#"  data-toggle="modal" class="btn font-weight-bold btn-light" data-target="#archiveAlertLogs">
                Clear list
            </a>
            <a href="#"  data-toggle="modal" class="btn font-weight-bold text-red btn-light" data-target="#resetAlertLogs">
                Erase all
            </a>
            </div>
        </a>
    </div>
</div>
<!-- end of reset alert logs -->
<!-- start of Modal -->
<div class="modal fade " id="resetAlertLogs" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="resetAlertLogsLogsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetAlertLogsLogsLabel">Reset alert logs </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
  Do you want remove all alert logs from the database forever. Data cannot be restored. <br/>It is recommended that you save the pdf archived version of the alert logs list first for backup purposes.
 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
    <a href="archived_alerts_pdf.php" class="btn btn-primary btn-sm" >Download PDF archive</a>

    <a href="reset_global_alert_flags.php?mode=erase" class="btn btn-danger btn-sm" >Confirm</a>
</div>
</div>
</div>
</div>
<!-- end of modal -->

<!-- start of Modal clear alert logs -->
<div class="modal fade" id="archiveAlertLogs" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="archiveAlertLogsLogsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="archiveAlertLogsLogsLabel">Clear alert logs list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    Do you want clean all alert logs from the list. Data can be viewed in the archive tab
 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
    <a href="reset_global_alert_flags.php?mode=archive" class="btn btn-danger" >Confirm</a>
</div>
</div>
</div>
</div>
<!-- end of modal -->

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