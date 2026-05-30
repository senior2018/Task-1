<?php
// ====================================================================
// REGISTER PAGE — creates a new user account in the database
// ====================================================================

// Pull in the database connection ($pdo)
require_once "db.php";

// These two variables will hold any error / success message we want to show.
$error = "";
$success = "";

// Did the user submit the form?
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Read the form fields. trim() removes accidental spaces at the start/end.
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";   // don't trim a password — spaces could be intentional

    // ----- VALIDATION -----
    // Make sure both fields are filled in
    if ($username === "" || $password === "") {
        $error = "Please fill in both fields.";
    }
    // Make sure the username is a reasonable length
    elseif (strlen($username) < 3 || strlen($username) > 50) {
        $error = "Username must be between 3 and 50 characters.";
    }
    // Make sure the password is at least 6 characters
    elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    }
    else {
        // ----- SAVE TO THE DATABASE -----
        // We use a "prepared statement" with named placeholders (:username, :password).
        // This is how we prevent SQL injection — user input is treated as DATA, never as code.
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

        // NEVER store passwords as plain text in the database!
        // password_hash() turns the password into a long secure string that can't be reversed.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Run the INSERT, supplying the actual values for the placeholders
            $stmt->execute([
                ":username" => $username,
                ":password" => $hashedPassword,
            ]);

            $success = "Account created! You can now log in.";

        } catch (PDOException $e) {
            // Error code 23000 = "duplicate entry" — username is already taken
            if ($e->getCode() === "23000") {
                $error = "That username is already taken. Try another.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>Create an Account</h2>

    <?php
    // Only show the error box if there's an error message.
    // We escape it with htmlspecialchars in case it ever contains special characters.
    if ($error !== "") {
        echo "<div class='error'>" . htmlspecialchars($error) . "</div>";
    }
    if ($success !== "") {
        echo "<div class='success'>" . htmlspecialchars($success) . "</div>";
    }
    ?>

    <form method="post" action="">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Log in here</a>.</p>
</div>
</body>
</html>
