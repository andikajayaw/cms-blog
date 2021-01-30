<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php  
    // if(isset($_POST['submit'])) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $error = [
            'username' => '',
            'email' => '',
            'password' => ''
        ];
        
        if(strlen($username) < 4) {
            $error['username'] = 'Username too short!';
        }
        
        if($username === '') {
            $error['username'] = 'Username cannot be empty!';
        }

        if(validateUsers($username)) {
            $error['username'] = 'Username already exist!';
        }

        if($password === '') {
            $error['password'] = 'Password cannot be empty!';
        }

        if($email === '') {
            $error['email'] = 'Email cannot be empty!';
        }

        if(validateEmails($email)) {
            $error['email'] = 'Email already exist! <br> <a href=index.php>Login?</a>';
        }

        foreach($error as $key => $err) {
            if(empty($err)){
                // loginUsers($username, $password);
                unset($error[$key]);
            }
        }

        if(empty($error)) {
            registerUsers($username, $email, $password);
            loginUsers($username, $password);
        }


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
                        <h1>Register</h1>
                            <form role="form" action="registration.php" method="POST" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                                    <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                                    <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                    <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                                </div>
                        
                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                            </form>
                        
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>


        <hr>



<?php include "includes/footer.php";?>
