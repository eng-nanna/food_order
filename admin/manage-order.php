<?php
include('partials/menu.php');
?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br />

        <?php
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br /><br />

        <table class="tbl-full" style="white-space: nowrap;">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>ontact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_order ORDER BY order_date DESC";

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1; #create a variable for serial no.

            if($count>0){
                while($rows=mysqli_fetch_assoc($res)){
                    //get individual data
                    $id = $rows['id'];
                    $food_name = $rows['food'];
                    $price = $rows['price'];
                    $qnty = $rows['quantity'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    $fullname = $rows['customer_name'];
                    $tel = $rows['customer_contact'];
                    $email = $rows['customer_email'];
                    $address = $rows['customer_address'];
                    ?>

            <tr>
                <td> <?php echo $sn++; ?> </td>
                <td><?php echo $food_name; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $qnty; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo $order_date; ?></td>
                <td>
                    <?php
                        if($status == "Ordered"){
                            echo "<label>$status</label>";
                        }elseif($status == "On Delivery"){
                            echo "<label style='color:orange;'>$status</label>";
                        }elseif($status == "Delivered"){
                            echo "<label style='color:green;'>$status</label>";
                        }elseif($status == "Cancelled"){
                            echo "<label style='color:red;'>$status</label>";
                        }
                    ?>
                </td>
                <td><?php echo $fullname; ?></td>
                <td><?php echo $tel; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $address; ?></td>
                <td>
                    <a href="<?php echo SITEURL;  ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Order</a>
                </td>
            </tr>

                    <?php
                }
            }else{
                echo "<tr>
                        <td colspan='12' class='error'> No available orders!</td>    
                     </tr>";
            }
            ?>

        </table>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php
include('partials/footer.php');