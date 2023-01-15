<?php include 'dbconn.php'; ?>
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

    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="css/addstyle_landing.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
</head>

<body class="bg">
    <?php
    $display_page = "home";
    include "landing_page_nav.php";
    ?>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-xl-6 col-lg-6 col-md-10 pt-5">
                <h1 class="title_header">Register now</h1>
                <p class="p_header">Register to receive the latest alerts from floodranger and flood related alerts within Urdaneta city Pangasinan.</p>
            </div>
            <div class="col-12  col-xl-6 col-lg-6 col-md-10 mt-2">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h1>Sign up</h1>
                                <p>Fill up the required fields</p>                   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form id="registration_id" action="submit_register.php" method="POST">
                                    <label>Email</label>
                                    <input class="form-control" name="email" id="email_id_val" value=""></input> 
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
                                        $address_query = $pdo->query("SELECT DISTINCT address_table.address_id as `address_id`, address_table.barangay, address_table.municipality, address_table.municipality, address_table.province, evacuation.evac_id  FROM address_table INNER JOIN evacuation ON address_table.evacuation_id = evacuation.evac_id");
                                        $addresses = $address_query->fetchAll();
                                        foreach($addresses as $address){
                                            ?>
                                            <option value="<?php echo $address->address_id; ?>" ><?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <br/>
                                <div id='result'></div>
                                <br/>
                                <div class="row">
                                    <div class="col-12">
                                        <p id="reg_status_fields"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" id="submit_btn" class="btn btn-primary w-100 btn-sm">Submit</button>
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

<script type="text/javascript">
    $("#submit_btn").click(function(){
      var email_val = $("#email_id_val").val();
      $.getJSON("duplicate_email_find.php", {email: email_val}, function(data){
        console.log(data);
        console.log(data.isExistUsers.result);
        console.log(data.isExistContacts.result);
        if(data.isExistUsers.result >= 1){
            $("#reg_status_fields").html('Email already exists! <a class="text-primary" href="login.php">login</a> instead.');
        }
        if(data.isExistContacts.result >= 1 && data.isExistUsers.result == 0 ){
            $("#reg_status_fields").html("Email already linked in contacts. Request your login credentials <a class='text-primary' href='email_new_request_credentials.php?email="+ email_val +"'>here</a>");        
        }

        if(data.isExistUsers.result == 0 && data.isExistContacts.result == 0){
            $("#registration_id").submit();
        }
    });


  });
</script>

</html>