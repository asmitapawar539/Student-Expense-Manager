<?php
include("../config/db.php");

$error = "";
$success = "";

if (isset($_POST['register'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check if email already exists
    $check = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
    $error = "Email already exists!";
} else {

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {

        // Get newly registered user ID
        $user_id = mysqli_insert_id($conn);

        // DEFAULT CATEGORIES
        $default_categories = ['Travel', 'Food', 'Books'];

        foreach ($default_categories as $cat) {
            mysqli_query(
                $conn,
                "INSERT INTO categories (user_id, name)
                 VALUES ($user_id, '$cat')"
            );
        }

        $success = "Registration successful! Please login.";

    } else {
        $error = "Something went wrong!";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Expense Manager</title>
    <link rel="stylesheet" href="http://localhost/expense_manager/assets/css/style.css?v=<?=time()?>">

</head>
<body>

<div class="auth-container">
    <h2>Student Registration</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green;text-align:center;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Register</button>
    </form>
<br>
    <p style="text-align:center;">
        Already have an account?
        <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>
