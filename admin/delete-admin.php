<?php
    include('../config/constant.php');

    //get the ID of adin to be deleted
    $id = $_GET['id'];

    //create SQL query to delete the admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    //redirect to admin page with msg (successful/error)
    if($res){
        $_SESSION['delete'] = "<div class='success'> Admin is deleted </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['delete'] = "<div class='error'> Failed to delete Admin, Try again later! </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>

