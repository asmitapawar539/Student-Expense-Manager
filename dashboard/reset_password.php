<?php
session_start();
include("../config/db.php");

$message = "";

/* Handle reset form submission */
if (isset($_POST['reset'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        // Update password
        mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE email='$email'");
       $message = "Password updated successfully! <a href='../auth/login.php'>Login now</a>";

    } else {
        $message = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
   <link rel="stylesheet" href="http://localhost/expense_manager/assets/css/style.css?v=<?=time()?>">

</head>
<body>

<div class="auth-container">

    <h2>Reset Password</h2>

    <?php if($message): ?>
        <p style="color:green;text-align:center;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your registered Email" required>
        <input type="password" name="password" placeholder="New Password" required>
        <button type="submit" name="reset">Reset Password</button>
    </form>
    <br>
    <p style="text-align:center;">
        <a href="../auth/login.php">Back to Login</a>
    </p>

</div>

</body>
</html>
