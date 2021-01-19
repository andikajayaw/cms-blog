<?php 
    include "includes/admin_header.php";
?>
<?php 
    if(isset($_SESSION['username'])) {
        $username_session = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username_session}'";
        $stmt = mysqli_query($connection, $query);
        confirm($stmt);

        while($row = mysqli_fetch_assoc($stmt)){
            $id_user = $row['id_user'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $roles = $row['roles'];
        }
    }

    if(isset($_POST['update_profile'])){
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $roles = $_POST['roles'];
        // $image = $_FILES['image']['name'];
        // $image_temp = $_FILES['image']['tmp_name'];

        // move_uploaded_file($image_temp, "../images/$image");

        $query = "
        UPDATE users 
        SET username = '{$username}', first_name = '{$first_name}',  last_name = '{$last_name}', 
        email = '{$email}', password = '{$password}', roles = '{$roles}'
        WHERE id_user = {$id_user} AND username = '{$username_session}'";

        $stmt = mysqli_query($connection, $query);

        confirm($stmt);
        header("Location: profiles.php");
    }
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                        </h1>
                    </div>
                    <div class="col-lg-12">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" name="id_user" class="form-control" value="<?php echo $id_user; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <select name="roles" id="" class="form-control">
                                    <option selected value="<?php echo $roles; ?>"><?php echo $roles; ?></option>
                                    <?php 
                                        if($roles == 'ADMIN') {
                                            echo "<option value='SUBSCRIBER'>SUBSCRIBER</option>";
                                        } else if($roles == 'SUBSCRIBER') {
                                            echo "<option value='ADMIN'>ADMIN</option>";
                                        }
                                    
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            </div>

                            <!-- <div class="form-group">
                                <label for="image">User Image</label>
                                <input type="file" name="image">
                            </div> -->

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>