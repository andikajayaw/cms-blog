<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  
    if(isset($_POST['submit'])) {
        $to         = "andikajayawiguna@gmail.com";
        $subject    = wordwrap($_POST['subject'], 70);
        $body       = $_POST['body'];
        $header     = "From: ".$_POST['email'];
        
        // send email
        mail($to,$subject,$body,$header);
    
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
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>
                        <div class="form-group">
                            <textarea type="text" name="body" id="body" class="form-control" cols="50" rows="10"></textarea>
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
