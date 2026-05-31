<?php
// ====================================================================
// LOGOUT — ends the user's session and sends them back to login
// ====================================================================

session_start();

$_SESSION = [];

session_destroy();

header("Location: login.php");
exit;
