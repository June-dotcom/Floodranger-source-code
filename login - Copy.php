<?php ob_start(); ?>
<?php session_start(); ?>
<?php include('dbconn.php'); ?>
<?php ?>
<?php
$login_err = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $inputted_user_name = $_POST['user_name'];
    $inputted_password = $_POST['user_password'];
    $login_data_stmt = $pdo->query("SELECT * FROM user_credentials WHERE user_name = '$inputted_user_name' && password = '$inputted_password'");
    $login_ent = $login_data_stmt->fetch();     
    if(isset($login_ent->name)){
        $_SESSION['user_id'] = $login_ent->id;
        $_SESSION['name'] = $login_ent->name;
        $_SESSION['user_name'] = $login_ent->user_name;
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

<!doctype html>
    <html lang="en">

    <!-- Mirrored from preview.colorlib.com/theme/bootstrap/login-form-11/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Mar 2022 23:09:38 GMT -->
    <head>
        <title>Flood ranger login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/A.style.css.pagespeed.cf.69oUKoK-5A.css">
    </head>
    <body>
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-user-o"></span>
                            </div>
                            <h3 class="text-center mb-4">Floodranger login</h3>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form">
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-left" placeholder="User name" name="user_name" required>
                                </div>
                                <div class="form-group d-flex">
                                    <input type="password" class="form-control rounded-left" placeholder="User password" name="user_password" required>
                                </div>
                                <div class="form-group text-center">
                                    <label class="text-center"><?php echo $login_err ?? ''; ?></label>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/jquery.min.js"></script>
    </body>
    <!-- Mirrored from preview.colorlib.com/theme/bootstrap/login-form-11/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Mar 2022 23:09:40 GMT -->
    </html>
