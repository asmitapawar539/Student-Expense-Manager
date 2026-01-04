<?php
session_start();
include("../config/db.php");

/* Session check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$message = "";

/* ADD Expense */
if (isset($_POST['add'])) {

    $amount = $_POST['amount'];
    $date   = $_POST['date'];
    $note   = mysqli_real_escape_string($conn, $_POST['note']);
    $category_id = (int)$_POST['category'];

    // Check if category exists for this user
    $check = mysqli_query($conn, "SELECT id FROM categories WHERE id=$category_id AND user_id=$user_id");
    if(mysqli_num_rows($check) == 0){
        $message = "Invalid category selected!";
    } else {
        $sql = "INSERT INTO expenses (user_id, category_id, amount, expense_date, note)
                VALUES ($user_id, $category_id, $amount, '$date', '$note')";
        if (mysqli_query($conn, $sql)) {
            $message = "Expense added successfully!";
        } else {
            $message = "Something went wrong: " . mysqli_error($conn);
        }
    }
}

/* Fetch categories */
$categories = mysqli_query($conn, "SELECT * FROM categories WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Expense</title>
     <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">

  
</head>
<body>

<div class="dashboard-add-expense">

    <h1>Add Expense</h1><br>

    <?php if ($message): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" class="form">

        <label>Category:<a href="categories.php" class="category-btn">Add your categories</a></label>
        <select name="category" required>
            <option value="">Select Category</option>
            <?php while ($c = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Amount:</label>
        <input type="number" name="amount" placeholder="Enter amount" required>

        <label>Date:</label>
        <input type="date" name="date" required>

        <label>Note:</label>
        <input type="text" name="note" placeholder="Optional note">

        <button class="btn" type="submit" name="add">Add Expense</button>

    </form>

    <br>
    <a href="dashboard.php" class="btn">⬅ Back to Dashboard</a>

</div>

</body>
</html>
