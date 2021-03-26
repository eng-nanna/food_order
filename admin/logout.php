<?php
    include('../config/constant.php');

    //Destroy the session
    session_destroy();

    //redirect to the login page
    header('location:'.SITEURL.'admin/login.php');
