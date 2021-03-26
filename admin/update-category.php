<?php
    include('partials/menu.php');

    if(isset($_GET['id'])){
        //get the ID of category to be updated
        $id = $_GET['id'];

        //create SQL query to get the admin details
        $sql = "SELECT * FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1) {
            //get individual data
            $rows = mysqli_fetch_assoc($res);
            $title = $rows['title'];
            $cur_img_name = $rows['image_name'];
            $featured = $rows['featured'];
            $active = $rows['active'];
        }else{
            //create a session variable to display message
            $_SESSION['no-category-found'] = "<div class='error'> Category not found! </div>";

            //Redirect page to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }else{
        //Redirect page to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br /><br />

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"</td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($cur_img_name != ""){
                            ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $cur_img_name; ?>" width = 150px>
                            <?php
                                }else{
                                    echo "<div class='error'> Image not added! </div>";
                                }
                            ?>
                            </td>
                    </tr>

                    <tr>
                        <td>New Image:</td>
                        <td><input type="file" name="img"></td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active == "No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_img" value="<?php echo $cur_img_name; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_img = $_POST['current_img'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //update image
        if (file_exists($_FILES['img']['tmp_name']) || is_uploaded_file($_FILES['img']['tmp_name'])){
            //get image name, source path and destination path
            $image_name = $_FILES['img']['name'];

            //Auto-rename the image file name
            //1. get the image extension
            $ext = explode('.', $image_name);
            $ext = end($ext);
            //2. rename the image name
            $image_name = "food_category_".rand(000,999).".".$ext;

            $source_path = $_FILES['img']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            //start uploading the image file
            $upload = move_uploaded_file($source_path, $destination_path);

            //check if image is uploaded or not
            if($upload == false) {
                //create a session variable to display message
                $_SESSION['upload'] = "<div class='error'> Failed to upload image </div>";

                //Redirect page to add category
                header('location:' . SITEURL . 'admin/manage-category.php');

                //stop the process
                die();
            }

            //remove current image
            if($current_img != ""){
                $remove_path = "../images/category/".$current_img;
                $remove = unlink($remove_path);

                //if failed to remove img add an error msg
                if(!$remove){
                    $_SESSION['remove'] = "<div class='error'> Failed to remove category image! </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }
            }

        }else{
            $image_name = $current_img;
        }

        //update database
        $sql2 = "UPDATE tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = '$id'";
        $result = mysqli_query($conn, $sql2);
        if($result){
            //create a session variable to display message
            $_SESSION['update'] = "<div class='success'> Category updated successfully </div>";

            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{
            //create a session variable to display message
            $_SESSION['update'] = "<div class='error'> Failed to update Category </div>";

            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }

    include('partials/footer.php');

