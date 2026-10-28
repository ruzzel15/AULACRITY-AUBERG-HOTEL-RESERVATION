<?php
session_start();
session_unset();
session_destroy();
// Clear remember me cookie and token
if (isset($_COOKIE['rememberme'])) {
    include 'config.php';
    $token = $_COOKIE['rememberme'];
    setcookie('rememberme', '', time() - 3600, "/");
    mysqli_query($conn, "UPDATE users SET remember_token=NULL WHERE remember_token='$token'");
}
header("Location: login.php");
exit();
