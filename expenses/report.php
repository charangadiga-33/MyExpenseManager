<?php
session_start();
include("../config/dbconnect.php");

if (!isset($_SESSION['uid'])) {
    header("Location: ../auth/signin.php");
    exit();
}

$uid = $_SESSION['uid'];

// total expenses
$total_q = mysqli_query($con, "SELECT SUM(amount) AS total FROM expenses WHERE user_id='$uid'");
$total = mysqli_fetch_assoc($total_q)['total'] ?? 0;

// expenses by category
$cat_q = mysqli_query($con, "SELECT category, SUM(amount) AS sum_amt FROM expenses WHERE user_id='$uid' GROUP BY category");

// last 5 expenses
$last_q = mysqli_query($con, "SELECT category, amount, created_at FROM expenses WHERE user_id='$uid' ORDER BY created_at DESC LIMIT 5");
?>

<h2>Expense Report</h2>

<p><b>Total Expenses:</b> ₹<?php echo $total; ?></p>

<h3>By Category</h3>
<ul>
<?php while ($row = mysqli_fetch_assoc($cat_q)) { ?>
    <li><?php echo $row['category']; ?> : ₹<?php echo $row['sum_amt']; ?></li>
<?php } ?>
</ul>

<h3>Last 5 Expenses</h3>
<table border="1" cellpadding="5">
<tr><th>Category</th><th>Amount</th><th>Date</th></tr>
<?php while ($r = mysqli_fetch_assoc($last_q)) { ?>
    <tr>
        <td><?php echo $r['category']; ?></td>
        <td><?php echo $r['amount']; ?></td>
        <td><?php echo $r['created_at']; ?></td>
    </tr>
<?php } ?>
</table>
