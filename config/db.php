<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// InfinityFree database config
$host = "sql112.infinityfree.com";   // ✅ FIXED
$user = "if0_40822265";
$pass = "Asmita1414";
$db   = "if0_40822265_expense_manager";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
