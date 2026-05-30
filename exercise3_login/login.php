<?php
// ====================================================================
// LOGIN PAGE — checks the username/password against the database
// ====================================================================

// session_start() must be called BEFORE any HTML is sent to the browser.
// Sessions let us "remember" the user across multiple pages
// (without making them log in again on every click).
session_start();

require_once "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    // Basic validation: both fields required
    if ($username === "" || $password === "") {
        $error = "Please enter both username and password.";
    } else {
        // Look for a user with this username.
        // Again, we use a prepared statement to safely include the value.
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->execute([":username" => $username]);

        // fetch() returns the matching row, or false if no match
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check two things:
        //  1. We actually found a user with that username
        //  2. The password they typed matches the hashed password in the DB
        // password_verify() handles the hash comparison for us.
        if ($user && password_verify($password, $user["password"])) {
            // Success! Save info into the session so other pages know who's logged in.
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            // Redirect to the welcome page
            header("Location: welcome.php");
            exit;   // stop executing after a redirect
        } else {
            // We give the SAME error for "wrong username" and "wrong password"
            // so an attacker can't tell which usernames exist.
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Log In</h2>

    <?php
    if ($error !== "") {
        echo "<div class='error'>" . htmlspecialchars($error) . "</div>";
    }
    ?>

    <form method="post" action="">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Log In</button>
    </form>

    <p>No account yet? <a href="register.php">Register here</a>.</p>
</div>
</body>
</html>
