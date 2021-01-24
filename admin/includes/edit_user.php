<?php 
    if(isset($_GET['id'])) {
        $id_user = $_GET['id'];
        $query = "SELECT a.* FROM users a WHERE id_user = {$id_user}";
        $stmt = mysqli_query($connection, $query);
        confirm($stmt);

        while($row = mysqli_fetch_assoc($stmt)){
            $id_user = $row['id_user'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $roles = $row['roles'];
            // $image = $row['image'];
        }

        
        if(isset($_POST['update_user'])){
            
            $username = $_POST['username'];
            $update_password = $_POST['password'];
            $email = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $roles = $_POST['roles'];
            // $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
            // $image = $_FILES['image']['name'];
            // $image_temp = $_FILES['image']['tmp_name'];

            if(!empty($update_password)) {
                $queryPassword = "SELECT password FROM users WHERE id_user = {$id_user}";
                $stmtPassword = mysqli_query($connection, $queryPassword);
                confirm($stmtPassword);
                $row = mysqli_fetch_assoc($stmtPassword);
                $password = $row['password'];

                if($update_password != $password) {
                    $update_password = password_hash($update_password, PASSWORD_BCRYPT, array('cost' => 10));
                }
                $query = "
                UPDATE users 
                SET username = '{$username}', first_name = '{$first_name}',  last_name = '{$last_name}', 
                email = '{$email}', password = '{$update_password}', roles = '{$roles}'
                WHERE id_user = {$id_user}";
        
                $stmt = mysqli_query($connection, $query);
        
                confirm($stmt);
                echo "<p class='bg-success'>Users updated! <a href='users.php'>View List Users</a></p>";
            }


    
        }
    } else {
        header("Location: index.php");
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
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
        <input type="password" name="password" class="form-control" autocomplete="off">
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

    <!-- <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
    </div>
</form>