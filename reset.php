<?php  
    include "includes/db.php"; 
    include "includes/header.php"; 
?>

<?php 
    if(!isset($_GET['email']) && !isset($_GET['token'])){
        redirect('index');
    }
    $email = $_GET['email'];
    $token = $_GET['token'];
    $query = "SELECT username, email, token FROM users WHERE email = ? AND token = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $useremail, $usertoken);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if($_GET['token'] != $usertoken && $_GET['email'] !== $useremail) {
        redirect('index');
    }

    if(isset($_POST['password']) && isset($_POST['confirmpassword'])) {
        $newpassword = escape($_POST['password']);
        $confirmpassword = escape($_POST['confirmpassword']);
        
        if($newpassword === $confirmpassword) {
            $hash = password_hash($newpassword, PASSWORD_BCRYPT, array('cost' => 12));
            $query = "UPDATE users SET token = '', password = '$hash' WHERE email = ? AND token = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "ss", $email, $token);
            mysqli_stmt_execute($stmt);
            if(mysqli_stmt_affected_rows($stmt) >= 1) {
                redirect('login');
            } 
            mysqli_stmt_close($stmt);
        }
    }


?>


<!-- Navigation -->
<?php include "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="password" name="password" class="form-control"  type="password" placeholder="Enter password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="confirmpassword" name="confirmpassword" class="form-control"  type="password" placeholder="Confirm password">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <!-- <h2>Please check your email</h2> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

