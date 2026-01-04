<?php
$host = "localhost";
$user = "root";
$pass = "";             
$db   = "expense_manager";
$port = 3308;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
