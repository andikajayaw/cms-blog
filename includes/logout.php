<?php session_start(); ?>

<?php 
    $_SESSION['id'] = NULL;
    $_SESSION['username'] = NULL;
    $_SESSION['first_name'] = NULL;
    $_SESSION['last_name'] = NULL;
    $_SESSION['roles'] = NULL;

    header("Location: ../index.php");
?>