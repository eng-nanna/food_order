<?php
    include('partials/menu.php');

    //get the ID of adin to be deleted
    $id = $_GET['id'];

    //create SQL query to get the admin details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if($res){
        //get no. of the rows in the table
        $count = mysqli_num_rows($res);

        if($count == 1) {
            //get individual data
            $rows = mysqli_fetch_assoc($res);
            $fullname = $rows['full_name'];
            $username = $rows['username'];
        }
    }else{
        //redirect to admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br /><br />

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="fullname" value="<?php echo $fullname; ?>"></td>
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];

        //create SQL query to update admin
        $sql = "UPDATE tbl_admin SET 
                full_name = '$fullname',
                username = '$username'
                WHERE id = '$id'";

        $res = mysqli_query($conn, $sql);

        if($res){
            //create a session variable to display message
            $_SESSION['update'] = "<div class='success'> Admin updated successfully </div>";

            //Redirect page to manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            //create a session variable to display message
            $_SESSION['update'] = "<div class='error'> Failed to update Admin </div>";

            //Redirect page to manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

    include('partials/footer.php');

