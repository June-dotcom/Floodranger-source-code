<?php ob_start(); ?>
<?php session_start(); ?>
<?php include 'dbconn.php'; ?>
<?php include 'auth.php'; ?>
<?php $user_id = $_SESSION['user_id']; ?>
<?php 
$user_qry = $pdo->query("SELECT * FROM user_credentials WHERE id = '$user_id' LIMIT 1");
$user_obj = $user_qry->fetch();
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Deactivate account successfully</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h2>You've recently deactivated your account to stop recieving floodranger alerts</h2>
                        <p>You can reactivate your account by clicking the button below</p>
						<div>
                            <a class="btn btn-primary" href="submit_react_acc.php?user_id=<?php echo $user_id; ?>">Reactivate your account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>

</html>