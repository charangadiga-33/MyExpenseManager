<?php
session_start();
include("config/dbconnect.php");

if (!isset($_SESSION['uid'])) {
    header("Location: auth/signin.php");
    exit();
}

$uid = $_SESSION['uid'];
$user_q = mysqli_query($con, "SELECT name FROM users WHERE id='$uid'");
$user = mysqli_fetch_assoc($user_q);
?>

<h2>Welcome, <?php echo $user['name']; ?>!</h2>

<ul>
    <li><a href="expenses/add.php">Add Expense</a></li>
    <li><a href="expenses/view.php">View Expenses</a></li>
    <li><a href="expenses/report.php">Expense Report</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="changepassword.php">Change Password</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
