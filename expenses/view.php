<?php
session_start();
include("../config/dbconnect.php");

$uid = $_SESSION['uid'];
$res = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$uid'");

echo "<h3>Your Expenses</h3>";
while ($row = mysqli_fetch_assoc($res)) {
    echo $row['category'] . " - " . $row['amount'] . "<br>";
}
?>
