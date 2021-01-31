<?php 

function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function redirect($location) {
    return header("Location: ".$location."");
}

function confirm($result) {
    global $connection;
    if(!$result) {
        die("QUERY FAILED ". mysqli_error($connection));
    }
    // return $result;
}

function insert_categories() {
    global $connection;
    if(isset($_POST['submit'])) {
        $category_title = $_POST['title'];
        if($category_title == '' || empty($category_title)) {
            echo "Input the category title";
        } else {
            $queryInsert = "INSERT INTO categories(title) VALUES(?)";
            $stmt = mysqli_prepare($connection, $queryInsert);
            mysqli_stmt_bind_param($stmt, "s", $category_title);
            mysqli_stmt_execute($stmt);
            confirm($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $stmt = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($stmt)){
        $title = $row['title'];
        $id = $row['id_category'];
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$title}</td>";
        echo "<td>
                <a class='btn btn-xs btn-flat btn-warning' href='categories.php?edit={$id}'>Edit</a>
                <a class='btn btn-xs btn-flat btn-danger' href='categories.php?delete={$id}'>Delete</a>
            </td>";
        echo "</tr>";
    }
}

function delete_categories() {
    global $connection;
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $queryDelete = "DELETE FROM categories WHERE id_category = '{$id}'";
        $stmt = mysqli_query($connection, $queryDelete);
        header("Location: categories.php");
    }
}

function usersOnline() {
    if(isset($_GET['onlineusers'])) {
        global $connection; 
        if(!$connection) {
            session_start();
            include_once("../includes/db.php");
            $session_id = session_id();
            $time = time();
            $time_out_seconds = 05;
            $time_out = $time - $time_out_seconds;
        
            $query = "SELECT * FROM users_online WHERE session = '$session_id'";
            $stmt = mysqli_query($connection, $query);
            $count_online = mysqli_num_rows($stmt);
            
            if($count_online == null) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session_id', $time)");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = $time WHERE session = '$session_id'");
            }
            $querySelectOnline = "SELECT * FROM users_online WHERE time > $time_out";
            $stmtUserOnline = mysqli_query($connection, $querySelectOnline);
            $count_user_online = mysqli_num_rows($stmtUserOnline);
        
            echo $count_user_online;
        }
    }
}
usersOnline();

function postCount($table) {
    global $connection;
    $query = "SELECT * FROM $table";
    $stmt = mysqli_query($connection, $query);
    confirm($stmt);
    $result = mysqli_num_rows($stmt);
    return $result;
}

function postStatus($table, $column, $status) {
    global $connection;
    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $stmt = mysqli_query($connection, $query);
    confirm($stmt);
    $result = mysqli_num_rows($stmt);
    return $result;
}

function isAdmin($username = '') {
    global $connection;

    $query = "SELECT roles from users WHERE username = '$username'";
    $stmt = mysqli_query($connection, $query);
    confirm($stmt);

    $row = mysqli_fetch_assoc($stmt);

    if($row['roles'] == 'ADMIN' || $row['roles'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

function validateUsers($username){
    global $connection;
    $query = "SELECT username FROM users WHERE username = '$username'";
    $stmt = mysqli_query($connection, $query);
    confirm($stmt);

    if(mysqli_num_rows($stmt) > 0) {
        return true;
    } else {
        return false;
    }

}

function validateEmails($email){
    global $connection;
    $query = "SELECT email FROM users WHERE email = '$email'";
    $stmt = mysqli_query($connection, $query);
    confirm($stmt);

    if(mysqli_num_rows($stmt) > 0) {
        return true;
    } else {
        return false;
    }

}

function registerUsers($username, $email, $password) {
    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $queryRegister = "INSERT INTO users(username, email, password, roles) 
    VALUES('$username', '$email', '$password', 'subscriber')";
    $stmtRegister = mysqli_query($connection, $queryRegister);
    confirm($stmtRegister);
}

function loginUsers($username, $password) {
    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $stmt = mysqli_query($connection, $query);
    confirm($stmt);
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
        redirect('../admin/index.php');
        // header("Location: ../admin");
    } else {
        redirect('../index.php');
        // header("Location: ../index.php");
    }
}

?>