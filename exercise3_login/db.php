<?php
// ====================================================================
// DATABASE CONNECTION
// ====================================================================

$DB_HOST = "127.0.0.1";
$DB_NAME = "task1";
$DB_USER = "root";
$DB_PASS = "Senior.P2018";

$pdo = new PDO(
    "mysql:host=$DB_HOST;dbname=$DB_NAME",
    $DB_USER,
    $DB_PASS
);

echo "Connection successfull";