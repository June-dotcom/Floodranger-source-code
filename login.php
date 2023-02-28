<?php ob_start(); ?>
<?php session_start(); ?>
<?php include('dbconn.php'); ?>
<?php error_reporting(-1); ?>
<?php
$login_err = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $inputted_user_name = $_POST['user_name'];
    $inputted_password = $_POST['user_password'];
    $login_data_stmt = $pdo->prepare('SELECT * FROM user_credentials WHERE email = ? && password = ?');
    $login_data_stmt->execute([$inputted_user_name, $inputted_password]);
    $login_ent = $login_data_stmt->fetch();     
    if(isset($login_ent->name)){
        $_SESSION['user_id'] = $login_ent->id;
        $_SESSION['name'] = $login_ent->name;
        $_SESSION['user_name'] = $login_ent->email;
        $_SESSION['user_level'] = $login_ent->role_name;

        if ($login_ent->role_name ==  'admin') {
            header('location: admin_homepage.php');
        }else if ($login_ent->role_name == 'recipient') {
            header('location: recipient_homepage.php');
        }
    }else{
        $login_err = "Please check your credentials";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Floodranger homepage</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="addstyle_landing.css">

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/addstyle_landing.css">

</head>
<body class="bg">
  <?php
  $display_page = "login";
  include "landing_page_nav.php";
  ?>
    <div class="container">
        <div class="row justify-content-center">
          
            <div class="col-12  col-xl-6 col-lg-6 col-md-10 mt-5">
                <div class="card">
            
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-12">
                                <h1>Login</h1>
                                <p>Login to your floodranger account</p>                   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                               <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form">
                                <div class="form-group">
                                    <label>Username/email</label>
                                    <input type="text" class="form-control" name="user_name" required>
                                </div>
                                <div class="form-group">
                                  <label>Password</label>
                                    <input type="password" class="form-control"  name="user_password" required>
                                </div>
                                <div class="form-group text-center">
                                    <label class="text-center"><?php echo $login_err ?? ''; ?></label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>

                            </form>
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