<?php
    include('partials/menu.php');
?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>

                <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>

                <div class="col-4 text-center">

                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1> <?php echo $count; ?> </h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php
                    $sql1 = "SELECT * FROM tbl_food";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                    ?>

                    <h1> <?php echo $count1; ?> </h1>
                    <br />
                    Foods
                </div>

                <div class="col-4 text-center">

                    <?php
                    $sql2 = "SELECT * FROM tbl_order";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1> <?php echo $count2; ?> </h1>
                    <br />
                    Orders
                </div>

                <div class="col-4 text-center">

                    <?php
                    $sql3 = "SELECT SUM(total) AS total_sum FROM tbl_order WHERE status='Delivered'";
                    $res3 = mysqli_query($conn, $sql3);
                    $row = mysqli_fetch_assoc($res3);
                    ?>

                    <h1>$<?php echo $row['total_sum']; ?></h1>
                    <br />
                    Revenues
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Section Ends -->
<?php
include('partials/footer.php');