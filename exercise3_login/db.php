<?php
// ====================================================================
// DATABASE CONNECTION
// This file is included (with require_once) by the other PHP files
// so they can all talk to the same MySQL database.
// ====================================================================

// >>> EDIT THESE 4 VALUES TO MATCH YOUR MYSQL SETUP <<<
$DB_HOST = "127.0.0.1";        // Where MySQL is running (your own computer)
$DB_NAME = "task1";            // The database name we'll use for this exercise
$DB_USER = "root";             // Your MySQL username
$DB_PASS = "Senior.P2018";    // Your MySQL password — type yours here

// "DSN" stands for Data Source Name — it's a string that tells PDO
// which type of database to connect to and which one to open.
$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";

try {
    // Create a new PDO object — this is the actual database connection.
    // The third argument is a list of options:
    //   ATTR_ERRMODE => ERRMODE_EXCEPTION makes PDO throw errors we can catch,
    //     instead of silently failing. Easier to debug.
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    // If the connection fails, stop everything and show a clear message.
    die("Database connection failed: " . $e->getMessage());
}

// After this file runs, $pdo is available to use in whichever file included it.
