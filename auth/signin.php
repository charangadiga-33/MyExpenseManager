<?php
session_start();
include("../config/dbconnect.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd   = $_POST['password'];

    $res = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$pwd'");
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['uid'] = $row['id'];
        header("Location: ../dashboard.php");
    } else {
        echo "Invalid login!";
    }
}
?>

<form method="POST">
  Email: <input type="email" name="email"><br>
  Password: <input type="password" name="password"><br>
  <button type="submit" name="login">Login</button>
</form>
