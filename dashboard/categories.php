<?php
session_start();
include("../config/db.php");

/* Session check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

/* Add category */
if (isset($_POST['add'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    if (!empty($name)) {
        mysqli_query(
            $conn,
            "INSERT INTO categories (user_id, name)
             VALUES ($user_id, '$name')"
        );
        $message = "Category added!";
    }
}

/* Fetch categories */
$categories = mysqli_query(
    $conn,
    "SELECT * FROM categories WHERE user_id = $user_id"
);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categories</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">


</head>
<body>

<div class="dashboard-add-expense">

    <h1>Categories</h1> <br>

    <?php if ($message): ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" class="form">
        <input type="text" name="name" placeholder="Category Name" required>
        <button class="btn" type="submit" name="add">Add Category</button>
    </form>

    <h2>Your Categories</h2>

    <ul>
        <?php while ($row = mysqli_fetch_assoc($categories)): ?>
            <li><?php echo $row['name']; ?></li>
        <?php endwhile; ?>
    </ul>

    <br>
    <a href="dashboard.php" class="btn">⬅ Back to Dashboard</a>

</div>

</body>
</html>
