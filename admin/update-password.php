<?php
    include('partials/menu.php');

    //get the ID of adin to be deleted
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br /><br />

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>

                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password:</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php
    if(isset($_POST['submit'])){
        //Get the data from the admin table
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check whether current ID and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id and password='$current_password'";
        $res = mysqli_query($conn, $sql);
        if($res){
            //get no. of the rows in the table
            $count = mysqli_num_rows($res);

            if($count == 1) {
                //get individual data
                $rows = mysqli_fetch_assoc($res);
                $fullname = $rows['full_name'];
                $username = $rows['username'];
                $password = $rows['password'];

                //check whether new password and confirm password match
                if($new_password == $confirm_password){
                    //update password
                    $sql1 = "UPDATE tbl_admin SET 
                    password = '$new_password'
                    WHERE id = '$id'";

                    $result = mysqli_query($conn, $sql1);

                    if($result){
                        //create a session variable to display message
                        $_SESSION['change_pswd'] = "<div class='success'> Password changed successfully </div>";

                        //Redirect page to manage admin
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }else{
                        //create a session variable to display message
                        $_SESSION['change_pswd'] = "<div class='error'> Failed to change password! </div>";

                        //Redirect page to manage admin
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }else{
                    //create a session variable to display message
                    $_SESSION['pswd-not-match'] = "<div class='error'> Password do not match </div>";

                    //Redirect page to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }else{
                //create a session variable to display message
                $_SESSION['user-not-found'] = "<div class='error'> User not found </div>";

                //Redirect page to manage admin
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }

    include('partials/footer.php');

