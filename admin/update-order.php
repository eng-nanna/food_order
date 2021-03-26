<?php
    include('partials/menu.php');

    if(isset($_GET['id'])){
        //get the ID of adin to be deleted
        $id = $_GET['id'];

        //create SQL query to get the admin details
        $sql = "SELECT * FROM tbl_order WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res){
            //get no. of the rows in the table
            $count = mysqli_num_rows($res);

            if($count == 1) {
                //get individual data
                $rows = mysqli_fetch_assoc($res);
                $id = $rows['id'];
                $food_name = $rows['food'];
                $price = $rows['price'];
                $qnty = $rows['quantity'];
                $status = $rows['status'];
                $fullname = $rows['customer_name'];
                $tel = $rows['customer_contact'];
                $email = $rows['customer_email'];
                $address = $rows['customer_address'];
            }
        }else{
            //redirect to admin page
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }else{
        //redirect to admin page
        header('location:'.SITEURL.'admin/manage-order.php');
    }
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <br /><br />

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Food:</td>
                        <td><b><?php echo $food_name; ?></b></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><b><?php echo $price; ?></b></td>
                    </tr>

                    <tr>
                        <td>Quantity:</td>
                        <td><input type="number" name="qty" value="<?php echo $qnty; ?>"></td>
                    </tr>

                    <tr>
                        <td>Status:</td>
                        <td>
                            <select name="status">
                                <option <?php if($status == "Ordered") {echo "selected";} ?> value="Ordered"> Ordered </option>
                                <option <?php if($status == "On Delivery") {echo "selected";} ?> value="On Delivery"> On Delivery </option>
                                <option <?php if($status == "Delivered") {echo "selected";} ?> value="Delivered"> Delivered </option>
                                <option <?php if($status == "Cancelled") {echo "selected";} ?> value="Cancelled"> Cancelled </option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td><input type="text" name="fullname" value="<?php echo $fullname; ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td><input type="text" name="contact" value="<?php echo $tel; ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td>
                            <textarea name="address" cols="30" rows="5"><?php echo $address; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="food" value="<?php echo $food_name; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
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
        $title = $_POST['food'];
        $f_price = $_POST['price'];
        $qnty = $_POST['qty'];
        $status = $_POST['status'];
        $fullname = $_POST['fullname'];
        $tel = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        //create SQL query to update admin
        $sql1 = "UPDATE tbl_order SET 
                food = '$title',
                price = $f_price,
                quantity = $qnty,
                status = '$status',
                customer_name = '$fullname',
                customer_contact = '$tel',
                customer_email = '$email',
                customer_address = '$address'
                WHERE id = '$id'";

        $result = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

        if($result){
            //create a session variable to display message
            $_SESSION['update'] = "<div class='success'> Order updated successfully </div>";

            //Redirect page to manage admin
            header('location:'.SITEURL.'admin/manage-order.php');
        }else{
            //create a session variable to display message
            $_SESSION['update'] = "<div class='error'> Failed to update Order </div>";

            //Redirect page to manage admin
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }

    include('partials/footer.php');

