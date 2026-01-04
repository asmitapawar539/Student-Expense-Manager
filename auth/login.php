<?php
session_start();
include("../config/db.php");

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../dashboard/dashboard.php");
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Expense Manager</title>
<!-- CSS -->
   <link rel="stylesheet" href="http://localhost/expense_manager/assets/css/style.css?v=<?=time()?>">
</head>
<body>

<div class="auth-container">
    <h2>Student Login</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit" name="login">Login</button>
    </form>
    <br>
    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>
</div>

</body>
</html>
