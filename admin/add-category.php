<?php
include('partials/menu.php');
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Categoty</h1>
            <br />
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <br /><br/><br/>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Enter Category Title"></td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td><input type="file" name="img"></td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php
    include('partials/footer.php');

    if(isset($_POST['submit'])){
        $title = $_POST['title'];

        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured = "No";
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active = "No";
        }

        //check whether image is selected or not
        if (file_exists($_FILES['img']['tmp_name']) || is_uploaded_file($_FILES['img']['tmp_name']))
        {
            //get image name, source path and destination path
            $img_name = $_FILES['img']['name'];

            //Auto-rename the image file name
            //1. get the image extension
            $ext = end(explode('.', $img_name));
            //2. rename the image name
            $img_name = "food_category_".rand(000,999).".".$ext;

            $source_path = $_FILES['img']['tmp_name'];
            $destination_path = "../images/category/".$img_name;

            //start uploading the image file
            $upload = move_uploaded_file($source_path, $destination_path);

            //check if image is uploaded or not
            if($upload == false){
                //create a session variable to display message
                $_SESSION['upload'] = "<div class='error'> Failed to upload image </div>";

                //Redirect page to add category
                header('location:'.SITEURL.'admin/add-category.php');

                //stop the process
                die();
            }
        }else{
            $img_name = "";
        }

        $sql = "INSERT INTO tbl_category SET
                title = '$title',
                image_name = '$img_name',
                featured = '$featured',
                active = '$active'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res){
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'> Category is added successfully </div>";

            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'> Failed to add Category </div>";

            //Redirect page to add category
            header('location:'.SITEURL.'admin/add-category.php');
        }
    }