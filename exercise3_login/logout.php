<?php
// ====================================================================
// LOGOUT — ends the user's session and sends them back to login
// ====================================================================

session_start();

// Wipe every value out of the session
$_SESSION = [];

// Tell PHP to destroy the session on the server
session_destroy();

// Send the user back to the login page
header("Location: login.php");
exit;
