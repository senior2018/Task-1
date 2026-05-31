<?php
// ====================================================================
// WELCOME PAGE — only shown to users who are logged in
// ====================================================================

session_start();

if (empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION["username"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Welcome, <?= $username ?>!</h2>
    <p>You are now logged in. This page is private — only logged-in users can see it.</p>
    <p><a href="logout.php">Log out</a></p>
</div>
</body>
</html>
