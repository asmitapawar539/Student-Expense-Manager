<?php
session_start();
include("../config/db.php");

/* Session Check*/
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$uid = (int)$_SESSION['user_id'];

/* user detail */
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $uid");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
   <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">


</head>
<body>

<div class="dashboard">

    <h1>My Profile</h1><br>

    <div class="profile-card">
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <br>
    <a class="btn" href="dashboard.php">⬅ Back to Dashboard</a>
    <a class="btn" href="reset_password.php">🔑 Reset Password</a>

</div>

</body>
</html>
