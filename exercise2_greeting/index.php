<?php
// ====================================================================
// EXERCISE 2 — A simple PHP script that:
//   1. Shows a form asking for the user's name
//   2. When submitted, displays a greeting like "Hello, Sarah!"
// ====================================================================

$greeting = "";

// $_SERVER["REQUEST_METHOD"] tells us how the page was opened.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];

    // Validate: make sure the user actually typed something.
    if ($name === "") {
        $greeting = "Please type your name first!";
    } else {
        $greeting = "Hello, " . $name . "!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Greeting</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; padding: 40px; }
        .box { background: #fff; max-width: 400px; margin: auto; padding: 24px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        input[type="text"] { width: 100%; padding: 8px; font-size: 16px; }
        button { margin-top: 12px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .greeting { margin-top: 20px; padding: 12px; background: #d1fae5; border-radius: 4px; font-weight: bold; color: #065f46; }
    </style>
</head>
<body>

        <h2>What's your name?</h2>

        <form method="post" action="">
            <input type="text" name="name" placeholder="Type your name…" required>
            <br>
            <button type="submit">Say Hello</button>
        </form>

        <?php
        // Only show the greeting box if $greeting is not empty.
        if ($greeting !== "") {
            echo $greeting;
        }
        ?>
    </div>
</body>
</html>
