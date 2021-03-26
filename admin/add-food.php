<?php
include('partials/menu.php');
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br />

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['select'])){
                echo $_SESSION['select'];
                unset($_SESSION['select']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <br /><br /><br />
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Title of the food"></td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5"></textarea
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price" placeholder="Food price"></td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td><input type="file" name="img"></td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <option disabled selected> -- select Category -- </option>
                                //display categories from database
                                <?php
                                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);

                                    if($count>0){
                                        while($rows=mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $title = $rows['title'];
                                            echo "<option value='$id'>$title</option>";
                                        }
                                    }else{
                                 ?>
                                        <option value="o">No category added</option>
                                 <?php
                                    }
                                ?>
                            </select>
                        </td>
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
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $price = $_POST['price'];
        if(isset($_POST['category'])){
            $category = $_POST['category'];
        }else{
            //create a session variable to display message
            $_SESSION['select'] = "<div class='error'> Please select category </div>";

            //Redirect page to add category
            header('location:'.SITEURL.'admin/add-food.php');
        }
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

        if (file_exists($_FILES['img']['tmp_name']) || is_uploaded_file($_FILES['img']['tmp_name']))
        {
            //get image name, source path and destination path
            $img_name = $_FILES['img']['name'];

            //1. get the image extension
            $ext = explode('.', $img_name);
            $ext = end($ext);

            //2. rename the image name
            $img_name = "food_name_".rand(000,999).".".$ext;

            $source_path = $_FILES['img']['tmp_name'];
            $destination_path = "../images/food/".$img_name;

            //start uploading the image file
            $upload = move_uploaded_file($source_path, $destination_path);

            //check if image is uploaded or not
            if($upload == false) {
                //create a session variable to display message
                $_SESSION['upload'] = "<div class='error'> Failed to upload image </div>";

                //Redirect page to add food
                header('location:' . SITEURL . 'admin/add-food.php');

                //stop the process
                die();
            }
            }else{
                $img_name = "";
            }

        $sql1 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$desc',
                price = $price,
                image_name = '$img_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'";

        $result = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        if($result){
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'> Food is added successfully </div>";

            //Redirect page to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'> Failed to add Food </div>";

            //Redirect page to add food
            header('location:'.SITEURL.'admin/add-food.php');
        }

    }

    include('partials/footer.php');