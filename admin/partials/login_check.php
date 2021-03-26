<?php
    //check whether user is logged in or not
    if(!isset($_SESSION['user'])){
        //user is not logged in
        $_SESSION['no-login-msg'] = "<div class='error text-center'> Please login to access admin panel! </div>";
        header('location:'.SITEURL.'admin/login.php');
    }