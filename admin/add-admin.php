<?php
include('partials/menu.php');
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br />

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
            <br /><br /><br />
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="fullname" placeholder="Enter Admin Full Name"></td>
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter Admin Username"></td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter Admin Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php
    include('partials/footer.php');

    // Process the values from form and save it in Database
    // check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // Getting the data from form
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $pass = md5($_POST['password']);

        // SQL query to save the data into Database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$fullname',
            username = '$username',
            password = '$pass'";

        //Execute query and save data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res == TRUE){
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'> Admin is added successfully </div>";

            //Redirect page to manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'> Failed to add Admin </div>";

            //Redirect page to add admin
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }