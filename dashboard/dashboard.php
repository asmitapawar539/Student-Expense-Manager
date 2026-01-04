<?php
session_start();
include("../config/db.php");

/* Session Check*/
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Total Expense*/
$result = mysqli_query(
    $conn,
    "SELECT SUM(amount) AS total FROM expenses WHERE user_id = $user_id"
);
$total = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Expense Manager</title>
    <link rel="stylesheet" href="http://localhost/expense_manager/assets/css/style.css?v=<?=time()?>">

</head>
<body>

<div class="navbar">
    <h4>Ash Expense Manager</h4>
    <a href="../auth/logout.php">← Logout</a>
</div>

<div class="dashboard">
<h2>Dashboard</h2>
    <div class="cards">
        <div class="card">
            <h4>Total Expense</h4>
            <p>₹ <?php echo $total['total'] ?? 0; ?></p>
        </div>
    </div>
    <div class="nav-buttons">
    <a class="btn" href="add_expense.php">➕ Add Expense</a>
    <a href="budget.php" class="nav-btn">💰 Budget</a>
    <a href="categories.php" class="nav-btn">📂 Categories</a>
    <a href="expenses.php" class="nav-btn">📊 Expenses</a>
    <a href="profile.php" class="nav-btn">👤 Profile</a>
    <a href="reset_password.php" class="nav-btn">🔒 Reset Password</a>
</div>
</div>

</body>
</html>
