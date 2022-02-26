<?php

// destroy the session
$_SESSION = array();
session_destroy();

if(!empty($_POST["remember"])) {
    $msg = "set " . $_POST["username"];
    setcookie("username", $_POST["username"], time()+ (10 * 365 * 24 * 60 * 60));
} else {
    $msg = "unset";
    setcookie("username","");
}

if (isset($_POST['returnURL'])) {
    $redir=$_POST['returnURL'];
} elseif (isset($_GET['returnURL'])) {
    $redir=$_GET['returnURL'];
} else {
    $redir="index.php";
}

// logout
if (isset($_GET['logout']) or $_POST['logout']) {
    // destroy the session
    $_SESSION = array();
    session_destroy();
    $msg .= "logout";
}

if (isset($_POST["username"])) {
    $username = $_POST["username"]; //remove case sensitivity on the username
} else {
    $username = "";
}
if (isset($_POST["password"])) {
    $password = $_POST["password"];
} else {
    $password = "";
}
if ($username and $password) {
    if ($username == "admin" and $password == "admin") {
        // Start Session
        //session_set_cookie_params(3600); // Set session cookie duration to 1 hour
        session_set_cookie_params(86400); // Set session cookie duration to 1 day
        session_start();
        $_SESSION["username"] = $username;
        header("Location: $redir");
    } else {
        $msg .= "Bad Password";
    }
}

$title = "Login";
include('_header_html.php');
?>

<h1><img src="static/logo.png" />Welcome to Tiny Razor</h1>

<p>
<?php echo $msg; ?>
</p>

<!--
<form action="login.php" method="post">
  <input type="text" name="username" id="username" value="" />
  <input type="password" name="password" id="password" value="" />
  <input type="submit" value="LOGIN" />
</form>
-->

<div class="container col-md-4 col-md-offset-4">
  <form class="form-signin" method='post' action='login.php'>
    <h2 class="form-signin-heading">Please Login</h2>
    <input type='hidden' name='returnURL' value='<?php echo $redir; ?>' />
    <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" required autofocus />
    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required />
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Submit">Sign in</button>
    &nbsp; &nbsp; <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?> /> Remember me
  </form>
</div>

<?php
include('_footer.php');