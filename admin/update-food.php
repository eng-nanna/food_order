<?php
    include('partials/menu.php');
    if(isset($_GET['id'])){
        //get the ID of category to be updated
        $id = $_GET['id'];
        //create SQL query to get the admin details
        $sql1 = "SELECT * FROM tbl_food WHERE id=$id";
        $res1 = mysqli_query($conn, $sql1);
        $count = mysqli_num_rows($res1);
        if($count == 1) {
            //get individual data
            $rows = mysqli_fetch_assoc($res1);
            $title = $rows['title'];
            $description = $rows['description'];
            $price = $rows['price'];
            $cur_img_name = $rows['image_name'];
            $category_id = $rows['category_id'];
            $featured = $rows['featured'];
            $active = $rows['active'];
        }else{
            //create a session variable to display message
            $_SESSION['no-food-found'] = "<div class='error'> Food not found! </div>";
            //Redirect page to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }else{
        //Redirect page to manage category page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>
    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br /><br />
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                            if($cur_img_name != ""){
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $cur_img_name; ?>" width = 150px>
                                <?php
                            }else{
                                echo "<div class='error'> Image not added! </div>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image:</td>
                        <td><input type="file" name="img"></td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                //display categories from database
                                <?php
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $cat_id = $row['id'];
                                        $cat_title = $row['title'];
                                        ?>
                                        <option <?php if($category_id == $cat_id) {echo "selected";} ?> value='<?php echo $cat_id; ?>'><?php echo $cat_title; ?></option>";
                                               <?php
                                    }
                                }else{
                                    ?>
                                    <option value="o">No category available</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
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
                            <input type="hidden" name="current_img" value="<?php echo $cur_img_name;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
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
            $destination_path = "../images/food/".$image_name;
            //start uploading the image file
            $upload = move_uploaded_file($source_path, $destination_path);
            //check if image is uploaded or not
            if($upload == false) {
                //create a session variable to display message
                $_SESSION['upload'] = "<div class='error'> Failed to upload image </div>";
                //Redirect page to add food
                header('location:' . SITEURL . 'admin/manage-food.php');
                //stop the process
                die();
            }
            //remove current image
            if($current_img != ""){
                $remove_path = "../images/food/".$current_img;
                $remove = unlink($remove_path);
                //if failed to remove img add an error msg
                if(!$remove){
                    $_SESSION['remove'] = "<div class='error'> Failed to remove food image! </div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();
                }
            }
        }else{
            $image_name = $current_img;
        }
        //update database
        $sql2 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id = '$id'";
        $result = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        if($result){
            //create a session variable to display message
            $_SESSION['update'] = "<div class='success'> Food updated successfully </div>";
            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            //create a session variable to display message
            $_SESSION['update'] = "<div class='error'> Failed to update Food </div>";
            //Redirect page to manage category
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    include('partials/footer.php');

