<?php
session_start();
include("../config/dbconnect.php");

if (!isset($_SESSION['uid'])) {
    header("Location: signin.php");
}

if (isset($_POST['change'])) {
    $old = $_POST['old'];
    $new = $_POST['new'];

    $uid = $_SESSION['uid'];
    $q = mysqli_query($con, "SELECT * FROM users WHERE id='$uid' AND password='$old'");
    if (mysqli_num_rows($q) == 1) {
        mysqli_query($con, "UPDATE users SET password='$new' WHERE id='$uid'");
        echo "Password changed!";
    } else {
        echo "Wrong old password.";
    }
}
?>

<form method="POST">
  Old Password: <input type="password" name="old"><br>
  New Password: <input type="password" name="new"><br>
  <button type="submit" name="change">Change</button>
</form>
