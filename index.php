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

    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //create SQL query to retrive categories data from database
            $sql = "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                while($rows=mysqli_fetch_assoc($res)){
                    $cat_id = $rows['id'];
                    $cat_title = $rows['title'];
                    $cat_img = $rows['image_name'];
                    ?>
                    <a href="category-foods.php?id=<?php echo $cat_id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //check whether image is available or not
                                if($cat_img != ""){
                                    ?>
                                    <img src="images/category/<?php echo $cat_img; ?>" alt="<?php echo $cat_title; ?>" class="img-responsive img-curve">
                                <?php
                                    }else{
                                    ?>
                                    <img src="images/default-placeholder.png" alt="<?php echo $cat_title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            <h3 class="float-text text-white"><?php echo $cat_title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            }else{
                echo "<div class='error'> Category not added! </div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql1 = "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6";
            $res1 = mysqli_query($conn, $sql1);
            $count1 = mysqli_num_rows($res1);
            if($count1>0){
                while($rows1=mysqli_fetch_assoc($res1)){
                    $food_id = $rows1['id'];
                    $food_title = $rows1['title'];
                    $desc = $rows1['description'];
                    $price = $rows1['price'];
                    $food_img = $rows1['image_name'];
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

                    <a href="order.php?id=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                <?php
                }
            }
            ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>