<?php
session_start();
include("../config/db.php");

/* Session Check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

/* Save / Update Budget */
if (isset($_POST['save'])) {

    $budget = $_POST['budget'];

    // check if budget already exists
    $check = mysqli_query($conn, "SELECT id FROM budgets WHERE user_id = $user_id");

    if (mysqli_num_rows($check) > 0) {
        // update
        $sql = "UPDATE budgets SET monthly_budget = $budget WHERE user_id = $user_id";
    } else {
        // insert
        $sql = "INSERT INTO budgets (user_id, monthly_budget)
                VALUES ($user_id, $budget)";
    }

    if (mysqli_query($conn, $sql)) {
        $message = "Budget saved successfully!";
    } else {
        $message = "Something went wrong!";
    }
}

/* Fetch Budget */
$result = mysqli_query($conn, "SELECT monthly_budget FROM budgets WHERE user_id = $user_id");
$data = mysqli_fetch_assoc($result);
$current_budget = $data['monthly_budget'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monthly Budget</title>
  <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">

</head>
<body>

<div class="dashboard-add-expense">

    <h1>Monthly Budget</h1> <br>

    <?php if ($message): ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" class="form">
        <input
            type="number"
            name="budget"
            placeholder="Monthly Budget"
            value="<?php echo $current_budget; ?>"
            required
        >
        <button class="btn" type="submit" name="save">Save Budget</button>
    </form>

    <br>
    <a href="dashboard.php" class="btn">⬅ Back to Dashboard</a>

</div>

</body>
</html>
