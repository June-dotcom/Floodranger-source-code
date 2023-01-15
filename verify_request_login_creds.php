<?php 
include 'dbconn.php';
ob_start();
$is_email_token_valid = "";
$email_token = $_GET['email_token'];

// get the user id first
$get_email_token_qry = $pdo->query("SELECT * FROM `email_req_login_token` WHERE `req_token_id` = '$email_token'");
$get_email_token_obj = $get_email_token_qry->fetch();

$user_id = isset($get_email_token_obj->user_id) ? $get_email_token_obj->user_id : 'NULL';
$get_user_qry = $pdo->query("SELECT * FROM `user_credentials` WHERE `id` = '$user_id' LIMIT 1");
$get_user_obj = $get_user_qry->fetch();

$sql_query_upd_verified = "UPDATE `user_credentials` SET `is_email_verified` = '1' WHERE `user_credentials`.`id` = '$user_id'";
$pdo->exec($sql_query_upd_verified);
// add user id in columns in contacts

if ($get_email_token_obj->user_id) {
	$is_email_token_valid = "yes";
	// request an email to user
	$email_to_be_req = $get_user_obj->email;
	$password_to_be_email = $get_user_obj->password;
	include 'email_login_creds.php';
}else{
	$is_email_token_valid = "no";
}
ob_end_clean();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Welcome</title>
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



<!-- row contains all cards -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12  col-xl-8 col-lg-9 col-md-10 mt-5">
			<div class="card">
				<?php 
				if ($is_email_token_valid == "yes") {
					?>
					<div class="card-body">
						<h1>Your login request is successfully</h1>
						<p>Login email: <?php echo $get_user_obj->email; ?></p>
						<p>Login password: <?php echo $get_user_obj->password; ?></p>

						<p>You can also check your email inbox for this</p>
						<a href="login.php" class="btn btn-primary">Continue to login</a>
					</div>
					<?php
				}else{
					?>
					<div class="card-body">
						<h1>Invalid login request token</h1>
						<span class="btn btn-danger text-center">Please try again</span>

					</div>
					<?php
				}
				?>
				
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
		$('#example').DataTable();
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