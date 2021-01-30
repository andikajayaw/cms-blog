<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "db.php"; ?>
<?php include "../admin/functions.php" ?>

<?php 
    if(isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        loginUsers($username, $password);
    }
?>