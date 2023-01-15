<?php include 'dbconn.php'; ?>
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

<!-- row contains all cards -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12  col-xl-8 col-lg-9 col-md-10 mt-5">
			<div class="card">
				
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<h3>Register</h3>					
						</div>
							<div class="col-12">
							<p>Register to receive the latest alerts from floodranger</p>					
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<form action="submit_register.php" method="POST">
								<label>Email</label>
								<input class="form-control" name="email" value=""></input> 
								<label>Password</label>
								<input class="form-control" name="password" value=""></input> 
								<label>Name</label>
								<input class="form-control" name="contact_name" value=""></input>								          
								<label>Phone number</label>
								<input class="form-control" name="phone_number" value=""></input>
								<label>Address</label>
								<br/>
								<input type="hidden" name="contact_id" value="">
								<select name="address_id" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
									<?php
										$address_query = $pdo->query("SELECT address_table.id AS `address_id`, address_table.*, evacuation.* FROM address_table INNER JOIN evacuation ON address_table.evacuation_id = evacuation.id");
										$addresses = $address_query->fetchAll();
										foreach($addresses as $address){
										?>
										<option value="<?php echo $address->address_id; ?>" ><?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province;?>
										</option>
										<?php
										}
									?>
								</select>
								<br/>
								<div id='result'></div>
								<br/>
								<div class="row">
									<div class="col-6">
										<button type="submit" class="btn btn-primary w-100">Submit</button>
									</div>
									<div class="col-6">
										<a href="index.php" class="btn btn-dark w-100">Back to homepage</a>
									</div>
								</div>
							</form>
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