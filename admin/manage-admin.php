<?php
include('partials/menu.php');
?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if(isset($_SESSION['pswd-not-match'])){
            echo $_SESSION['pswd-not-match'];
            unset($_SESSION['pswd-not-match']);
        }

        if(isset($_SESSION['change_pswd'])){
            echo $_SESSION['change_pswd'];
            unset($_SESSION['change_pswd']);
        }
        ?>

        <br /><br /><br />

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary"> Add Admin</a>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                //query to retrieve all admin
                $sql = "SELECT * FROM tbl_admin";

                //excute the query
                $res = mysqli_query($conn, $sql);

                if($res){
                    $count = mysqli_num_rows($res); //get no. of the rows in the table

                    $sn = 1; #create a variable for serial no.


                    if($count > 0){
                        //get all the data from the table
                        while($rows = mysqli_fetch_assoc($res)){
                            //get individual data
                            $id = $rows['id'];
                            $fullname = $rows['full_name'];
                            $username = $rows['username'];

                            ?>
                            <tr>
                                <td> <?php echo $sn++; ?> </td>
                                <td> <?php echo $fullname; ?> </td>
                                <td> <?php echo $username; ?> </td>
                                <td>
                                    <a href="<?php echo SITEURL;  ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary"> Change Password</a>
                                    <a href="<?php echo SITEURL;  ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Admin</a>
                                    <a href="<?php echo SITEURL;  ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a>
                                </td>
                            </tr>
                           <?php
                        }
                    }else{

                    }
                }
            ?>
        </table>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php
include('partials/footer.php');