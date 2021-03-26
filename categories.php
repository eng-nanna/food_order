<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //create SQL query to retrive categories data from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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


<?php include('partials-front/footer.php'); ?>