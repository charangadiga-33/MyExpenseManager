<?php
include("../config/dbconnect.php");

if (isset($_POST['register'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pwd   = $_POST['password'];

    $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$pwd')";
    if (mysqli_query($con, $sql)) {
        echo "Account created. <a href='signin.php'>Login here</a>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<form method="POST">
  Name: <input type="text" name="name"><br>
  Email: <input type="email" name="email"><br>
  Password: <input type="password" name="password"><br>
  <button type="submit" name="register">Register</button>
</form>
