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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Floodranger data privacy</title>
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
    $display_page = "data_privacy";
    include "recipient_page_nav.php";
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      <?php 
                      include "paragraph_privacy_notice.php";
                      ?>
                  </div>
                  <div class="card-footer">
                     <button type="button" class="btn btn-danger btn-round btn-sm"
                        data-toggle="modal" data-target="#deleteModal">I am not agree/delete my account</button>
                  </div>
              </div>


          </div>
      </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <h4 class="text-center lead">Do you want to delete your account? <br> <?php echo $user_obj->email; ?> <br> This proccess is irreversible</h4>
        </div>
        <div class="modal-footer">
           <a class="btn btn-danger btn-round btn-sm" href="delete_user_acc.php?id=<?php echo $user_id; ?>">Yes</a>
           <button type="button" class="btn btn-sm btn-secondary"
           data-dismiss="modal">No</button>
       </div>
   </div>
</div>
</div>
<!-- end of modal -->

<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>
<script src="vendor/owl-carousel/owl.carousel.js"></script>




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
<!-- custom script for registration index only !!!! -->


</html>