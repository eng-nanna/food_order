<?php
    include('../config/constant.php');
?>
    <html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br/>
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-msg'])){
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
            ?>
            <br/>
            <!-- Login form starts here -->
            <form action="" method="post" class="text-center">
                Username: <br/>
                <input type="text" name="username" placeholder="Enter username"><br/><br/>
                Password: <br/>
                <input type="password" name="password" placeholder="Enter your password"><br/><br/>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <br/><br/>
            <!-- Login form ends here -->
            <p class="text-center">Created by - Nehal Nabil</p>
        </div>

    </body>
</html>
<?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' and password = '$password'";

        $res = mysqli_query($conn, $sql);
        //get no. of the rows in the table
        $count = mysqli_num_rows($res);

        if($count == 1) {
            $_SESSION['login'] = "<div class='success'> Login successfully </div>";
            $_SESSION['user'] = $username;

            //redirect to Dashboard Home page
            header('location:'.SITEURL.'admin/');
        }else{
            $_SESSION['login'] = "<div class='error text-center'> username and password did not match </div>";

                //redirect to login page
            header('location:'.SITEURL.'admin/login.php');
        }
    }