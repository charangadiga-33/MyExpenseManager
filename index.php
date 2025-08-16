<?php
session_start();

if (isset($_SESSION['uid'])) {
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: auth/signin.php");
    exit();
}
?>
