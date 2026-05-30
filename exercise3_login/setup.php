<?php
// ====================================================================
// SETUP SCRIPT — run this ONE TIME in your browser to:
//   1. Create the "task1" database (if it doesn't exist)
//   2. Create the "users" table (if it doesn't exist)
// After it succeeds, DELETE this file.
// ====================================================================

// We can't include db.php yet because the database might not exist.
// So we'll do the connection manually here.

// >>> SAME VALUES AS db.php — make sure they match <<<
$DB_HOST = "127.0.0.1";
$DB_NAME = "task1";
$DB_USER = "root";
$DB_PASS = "Senior.P2018";   // Type your MySQL password here

try {
    // Connect WITHOUT picking a database (notice no "dbname=" in the DSN).
    // This is so we can CREATE the database if it isn't there yet.
    $pdo = new PDO("mysql:host=$DB_HOST;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // 1. Create the database (skipped if it already exists)
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4");

    // 2. Switch to using it
    $pdo->exec("USE $DB_NAME");

    // 3. Create the users table. Each row will hold one registered user.
    //    - id:        unique number for each user, set automatically
    //    - username:  the username the person picks (must be unique)
    //    - password:  the password — but stored HASHED, never as plain text
    //    - created_at: automatically set to the current date/time
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Show a success message
    echo "<h2 style='color:green;font-family:Arial'>Setup complete!</h2>";
    echo "<p style='font-family:Arial'>Database <b>$DB_NAME</b> and table <b>users</b> are ready.</p>";
    echo "<p style='font-family:Arial'><b>Important:</b> delete this setup.php file now.</p>";
    echo "<p style='font-family:Arial'><a href='register.php'>Go to Register →</a></p>";

} catch (PDOException $e) {
    // If something goes wrong, show the error
    die("Setup failed: " . $e->getMessage());
}
