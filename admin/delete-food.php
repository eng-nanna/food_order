<?php
    include('../config/constant.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //get the ID of food to be deleted
        $id = $_GET['id'];
        $img_name = $_GET['image_name'];

        //remove the physical image if available
        if($img_name != ""){
            $path = "../images/food/".$img_name;
            $remove = unlink($path);

            //if failed to remove img add an error msg
            if(!$remove){
                $_SESSION['remove'] = "<div class='error'> Failed to remove food image! </div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);
        if($res){
            //create a session variable to display message
            $_SESSION['delete'] = "<div class='success'> Food is deleted successfully </div>";

            //Redirect page to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            //create a session variable to display message
            $_SESSION['delete'] = "<div class='error'> Failed to delete Food </div>";

            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }else{
        //create a session variable to display message
        $_SESSION['delete'] = "<div class='error'> Unauthorized Access!! </div>";

        //Redirect page to manage category
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

