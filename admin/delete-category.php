<?php
    include('../config/constant.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //get the ID of adin to be deleted
        $id = $_GET['id'];
        $img_name = $_GET['image_name'];

        //remove the physical image if available
        if($img_name != ""){
            $path = "../images/category/".$img_name;
            $remove = unlink($path);

            //if failed to remove img add an error msg
            if(!$remove){
                $_SESSION['remove'] = "<div class='error'> Failed to remove category image! </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);
        if($res){
            //create a session variable to display message
            $_SESSION['delete'] = "<div class='success'> Category is deleted successfully </div>";

            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{
            //create a session variable to display message
            $_SESSION['delete'] = "<div class='error'> Failed to delete Category </div>";

            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>

