<?php 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $roles = $_POST['roles'];
        // $image = $_FILES['image']['name'];
        // $image_temp = $_FILES['image']['tmp_name'];

        // move_uploaded_file($image_temp, "../images/$image");
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

        $query = "
        INSERT INTO users(username, first_name, last_name, email, password, roles)
        VALUES('$username', '$first_name', '$last_name', '$email', '$password', '$roles')";

        $stmt = mysqli_query($connection, $query);

        confirm($stmt);
        // echo "User created: ". " " ." <a href='users.php'>View users</a>";
        echo "<p class='bg-success'>New user has been added! <a href='users.php'>View List Users</a></p>";
        // header("Location: users.php");

    }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="roles">Roles</label>
        <select name="roles" id="" class="form-control">
            <option disabled selected value="subscriber">Select Option</option>
            <option value="ADMIN">Admin</option>
            <option value="SUBSCRIBER">Subscriber</option>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Add User">
    </div>
</form>