<?php
session_start();
include("config/dbconnect.php");

if (!isset($_SESSION['uid'])) {
    header("Location: auth/signin.php");
    exit();
}

$uid = $_SESSION['uid'];

// fetch user details
$query = mysqli_query($con, "SELECT * FROM users WHERE id='$uid'");
$user = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update_q = mysqli_query($con, "UPDATE users SET name='$name', email='$email' WHERE id='$uid'");

    if ($update_q) {
        echo "<p style='color:green;'>Profile updated successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error updating profile.</p>";
    }
}
?>

<h2>User Profile</h2>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

    <button type="submit" name="update">Update Profile</button>
</form>
