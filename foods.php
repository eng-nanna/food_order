<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

                <?php
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $food_id = $rows['id'];
                        $food_title = $rows['title'];
                        $desc = $rows['description'];
                        $price = $rows['price'];
                        $food_img = $rows['image_name'];
                ?>

               <div class="food-menu-box">
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
                    <h4><?php echo $food_title; ?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo substr($desc,0,75)." ..."; ?>
                    </p>
                    <br>

                    <a href="order.phpid=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <?php
            }
            }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>