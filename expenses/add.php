<?php
session_start();
include("../config/dbconnect.php");

if (!isset($_SESSION['uid'])) {
    header("Location: ../auth/signin.php");
}

if (isset($_POST['add'])) {
    $amt = $_POST['amount'];
    $cat = $_POST['category'];
    $uid = $_SESSION['uid'];

    $sql = "INSERT INTO expenses (user_id,amount,category) VALUES ('$uid','$amt','$cat')";
    mysqli_query($con, $sql);
    echo "Expense added!";
}
?>

<form method="POST">
  Amount: <input type="number" name="amount"><br>
  Category: <input type="text" name="category"><br>
  <button type="submit" name="add">Add</button>
</form>
