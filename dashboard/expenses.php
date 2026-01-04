<?php
session_start();
include("../config/db.php");

/* Session Check*/
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$uid = (int)$_SESSION['user_id'];

/* expenses with category */
$q = mysqli_query($conn,
    "SELECT e.*, c.name AS category_name
     FROM expenses e
     JOIN categories c ON e.category_id = c.id
     WHERE e.user_id = $uid
     ORDER BY e.expense_date DESC"
);

if (!$q) {
    die("Query Error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Expense History</title>
   <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">



</head>
<body>

<div class="dashboard">

    <h1>Expense History</h1>

    <?php if(mysqli_num_rows($q) > 0): ?>
        <table class="expense-table">
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Amount (₹)</th>
                <th>Note</th>
            </tr>
            <?php while($r = mysqli_fetch_assoc($q)): ?>
            <tr>
                <td><?= htmlspecialchars($r['expense_date']) ?></td>
                <td><?= htmlspecialchars($r['category_name']) ?></td>
                <td><?= htmlspecialchars($r['amount']) ?></td>
                <td><?= htmlspecialchars($r['note']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No expenses added yet.</p>
    <?php endif; ?>

    <br>
    <a class="btn" href="add_expense.php">➕ Add Expense</a>
    <a class="btn" href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>
