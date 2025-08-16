<?php
$host = "localhost";
$user = "root";
$pass = ""; //your pasword goes here
$db   = "expense_tracker";

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("DB Connection Failed: " . mysqli_connect_error());
}
?>
