<?php
    session_start();	

    // Unset all of the session variables	
    $_SESSION = array();	

    // Destroy the session	
    session_destroy();	

    $_SESSION['loggedin']=false;

    if (isset($_COOKIE['remember_user_email'])) {	
        setcookie('remember_user_email', '', time() - 3600, '/');	
    }	

    if (isset($_COOKIE['remember_user_type'])) {	
        setcookie('remember_user_type', '', time() - 3600, '/');	
    }	

    // Redirect to the login page 	
    header("Location: login.php");
    exit();
?>