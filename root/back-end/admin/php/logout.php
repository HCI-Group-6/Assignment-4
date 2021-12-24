<?php
require 'functions.php';

// Destroy Session
$_SESSION = [];
session_unset();
session_destroy();
// Destroy Session

// Cookies Variabel
$check  = mysqli_query($host, "SELECT * FROM user_account WHERE id = '$_COOKIE[id]'");
$row    = mysqli_fetch_assoc($check);
$key    = hash("sha256", $row["username"]);
// Cookies Variabel

// Destroy Cookies
setcookie('id','', time() - 3600);
setcookie($key,'', time() - 3600);
// Destroy Cookies

// Redirect to Login
header("Location: login.php");
// Redirect to Login

?>