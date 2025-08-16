<?php
session_start();
include("config/dbconnect.php");

if (!isset($_SESSION['uid'])) {
    header("Location: auth/signin.php");
    exit();
}

$uid = $_SESSION['uid'];
$message = "";

if (isset($_POST['change'])) {
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    // fetch current password
    $query = mysqli_query($con, "SELECT password FROM users WHERE id='$uid'");
    $user = mysqli_fetch_assoc($query);

    if ($user && $user['password'] === md5($current_pass)) {
        if ($new_pass === $confirm_pass) {
            $new_hashed = md5($new_pass);
            $update_q = mysqli_query($con, "UPDATE users SET password='$new_hashed' WHERE id='$uid'");

            if ($update_q) {
                $message = "<p style='color:green;'>Password changed successfully!</p>";
            } else {
                $message = "<p style='color:red;'>Error updating password.</p>";
            }
        } else {
            $message = "<p style='color:red;'>New passwords do not match.</p>";
        }
    } else {
        $message = "<p style='color:red;'>Current password is incorrect.</p>";
    }
}
?>

<h2>Change Password</h2>
<?php echo $message; ?>

<form method="POST" action="">
    <label>Current Password:</label><br>
    <input type="password" name="current_pass" required><br><br>

    <label>New Password:</label><br>
    <input type="password" name="new_pass" required><br><br>

    <label>Confirm New Password:</label><br>
    <input type="password" name="confirm_pass" required><br><br>

    <button type="submit" name="change">Change Password</button>
</form>
