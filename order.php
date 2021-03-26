<?php
    include('partials-front/menu.php');

    if(isset($_GET['id'])){
        $food_id = $_GET['id'];

        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $rows=mysqli_fetch_assoc($res);
            $food_id = $rows['id'];
            $food_title = $rows['title'];
            $price = $rows['price'];
            $food_img = $rows['image_name'];
        }else{
            header('location:'. SITEURL);
        }
    }else{
        header('location:'. SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($food_img != ""){
                            ?>
                            <img src="images/food/<?php echo $food_img; ?>" alt="<?php echo $food_title; ?>" class="img-responsive img-curve">
                            <?php
                        }else{
                            ?>
                            <img src="images/default-placeholder.png" alt="<?php echo $food_title; ?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $food_title; ?></h3>
                        <input type="hidden" name="title" value="<?php echo $food_title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +201xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if(isset($_POST['submit'])){
                    $title = $_POST['title'];
                    $f_price = $_POST['price'];
                    $qnty = $_POST['qty'];
                    $total = $f_price * $qnty ;
                    //$order_date = date('Y-m-d h:i:s a');
                    $status = "Ordered"; //Ordered, On delivery, Delivered, Cancelled
                    $fullname = $_POST['full-name'];
                    $tel = $_POST['contact'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];

                    $sql1 = "INSERT INTO tbl_order SET
                             food = '$title',
                             price = $f_price,
                             quantity = $qnty,
                             total = $total,
                             order_date = now(),
                             status = '$status',
                             customer_name = '$fullname',
                             customer_contact = '$tel',
                             customer_email = '$email',
                             customer_address = '$address'";

                    $result = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                    if($result){
                        $_SESSION['order'] = "<div class='success'> Food Ordered successfully </div>";
                        header('location:'. SITEURL);
                    }else{
                        $_SESSION['order'] = "<div class='error'> Failed to order food! </div>";
                        header('location:'. SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>