<?php

//destroy the session
$_SESSION = array();
session_destroy();
header("Location: login.php");
