<?php include "db.php"; ?>
<?php session_start(); ?>

<?php 
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $stmt = mysqli_query($connection, $query);
        if(!$stmt) {
            die("QUERY FAILED ".mysqli_error($connection));
        }
        while($row = mysqli_fetch_assoc($stmt)){
            $id_user = $row['id_user'];
            $user_name = $row['username'];
            $user_password = $row['password'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $roles = $row['roles'];
        }
        // $password = crypt($password, $user_password);

        if(password_verify($password, $user_password)) {
            $_SESSION['id_user'] = $id_user;
            $_SESSION['username'] = $user_name;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['roles'] = $roles;
            header("Location: ../admin");
        } else {
            header("Location: ../index.php");
        }
    }
?>