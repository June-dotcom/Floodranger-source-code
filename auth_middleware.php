<?php ob_start(); ?>
<?php
    // recommended move to auth_middleware 
    if(!(isset($_SESSION['user_id']))){
        // show 401
        header('location: login.php');
        
    }

    function middleware_user_level_admin(String $user_level){
        if ($user_level != "admin") {
            // show 403 
            header('location: error_403.php');

        }
    }

     function middleware_user_level_recipient(String $user_level){
        if ($user_level !=  "recipient") {
            // show 403
                        header('location: error_403.php');

        }
    }
?>