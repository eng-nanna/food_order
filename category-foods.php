<?php
    include('partials-front/menu.php');

    if(isset($_GET['id'])){
        $cat_id = $_GET['id'];
        $sql = "SELECT title FROM tbl_category WHERE id=$cat_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $cat_title = $row['title'];
        }
        else{
            echo "<div class='error'> Category not found! </div>";
        }
    }else{
        header('location:'. SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $cat_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql1 = "SELECT * FROM tbl_food WHERE category_id = $cat_id";
                $result = mysqli_query($conn, $sql1);
                $counts = mysqli_num_rows($result);
                if($counts>0){
                    while($rows1=mysqli_fetch_assoc($result)){
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

                }else{
                    echo "<div class='error'> No food available! </div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>