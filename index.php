<?php
session_start();

/* If user is logged in, redirect to dashboard */
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Manager</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">

</head>
<body>

<div class="welcome-container">
    <h1>Welcome to Expense Manager</h1>
    <h2>Track your expenses, manage budgets, and organize categories easily!</h2> <br>
    <a href="auth/login.php" class="btn">Login</a>
    <a href="auth/register.php" class="btn">Register</a>
</div>

</body>
</html>
