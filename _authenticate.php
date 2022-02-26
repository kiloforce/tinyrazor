<?php

// Start Session
//session_set_cookie_params(3600); // Set session cookie duration to 1 hour
session_set_cookie_params(86400); // Set session cookie duration to 1 day
session_start();

// Logout
if (isset($_GET['logout']) or $_POST['logout']) {
    //destroy the session
    $_SESSION = array();
    session_destroy();
    header("Location: login.php?logout");
    exit;
}

// Verify Login
if (isset($_SESSION["username"])) {
    $user = $_SESSION['username'];
} else {
    header("Location: login.php?returnURL=" . basename($_SERVER['PHP_SELF']));
    exit;
}
