<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!empty($username) && !empty($email) && !empty($password)){
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);

            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    
            // $query = "SELECT rand_salt FROM users";
            // $stmt = mysqli_query($connection, $query);
    
            // if(!$stmt) {
            //     die("QUERY FAILED ".mysqli_error($connection));
            // }
    
            // $row = mysqli_fetch_assoc($stmt);
            // $randSalt = $row['rand_salt'];

            // $password = crypt($password, $randSalt);
    
            $queryRegister = "INSERT INTO users(username, email, password, roles) 
            VALUES('$username', '$email', '$password', 'subscriber')";
            $stmtRegister = mysqli_query($connection, $queryRegister);
            if(!$stmtRegister) {
                die("QUERY FAILED ".mysqli_error($connection));
            }
            $message = "New user has been registered!";
            // echo "<p class='bg-success'>New user has been registered!</p>";
        } else {
            $message = "Field cannot be empty!";
        }

        // while($row = mysqli_fetch_assoc($stmt)){
        //     $randSalt = $row['rand_salt'];
        //     echo $randSalt;
        // }
    
    } else {
        $message = '';
    }
?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <h5 class="text-center"><?php echo $message; ?></h5>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>
                        <div class="form-group">
                            <textarea type="text" name="subject" id="subject" class="form-control" cols="50" rows="10"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div> -->
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
