<?php
// ====================================================================
// EXERCISE 2 — A simple PHP script that:
//   1. Shows a form asking for the user's name
//   2. When submitted, displays a greeting like "Hello, Sarah!"
// ====================================================================

// $greeting will hold the message we want to show.
// We start it empty — if the user hasn't submitted the form yet, no greeting is shown.
$greeting = "";

// $_SERVER["REQUEST_METHOD"] tells us how the page was opened.
//   - "GET"  = the user just opened the page (so show an empty form)
//   - "POST" = the user submitted the form (so process their name)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // $_POST is an array of values that came from the submitted form.
    // We grab the "name" field. trim() removes spaces at the start/end.
    // The ?? "" part gives an empty string if "name" wasn't sent for any reason.
    $name = trim($_POST["name"] ?? "");

    // Validate: make sure the user actually typed something.
    if ($name === "") {
        $greeting = "Please type your name first!";
    } else {
        // htmlspecialchars() converts characters like <, >, " into safe versions
        // so that a malicious user can't inject HTML or JavaScript into our page.
        // This is called "escaping output" and prevents XSS attacks.
        $safeName = htmlspecialchars($name);

        // Build the greeting message.
        $greeting = "Hello, " . $safeName . "!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Greeting</title>
    <style>
        /* A little inline styling so the page looks nice */
        body { font-family: Arial, sans-serif; background: #f3f4f6; padding: 40px; }
        .box { background: #fff; max-width: 400px; margin: auto; padding: 24px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        input[type="text"] { width: 100%; padding: 8px; font-size: 16px; }
        button { margin-top: 12px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .greeting { margin-top: 20px; padding: 12px; background: #d1fae5; border-radius: 4px; font-weight: bold; color: #065f46; }
    </style>
</head>
<body>
    <div class="box">
        <h2>What's your name?</h2>

        <!--
            The form sends data back to this same file ("").
            method="post" means the data is sent in the request body,
            not in the URL (better for sensitive data and for any non-search form).
        -->
        <form method="post" action="">
            <!-- The 'name' attribute is the key we'll read in $_POST -->
            <input type="text" name="name" placeholder="Type your name…" required>
            <br>
            <button type="submit">Say Hello</button>
        </form>

        <?php
        // Only show the greeting box if $greeting is not empty.
        if ($greeting !== "") {
            // We already escaped the name with htmlspecialchars() above,
            // so it's safe to print here.
            echo "<div class='greeting'>" . $greeting . "</div>";
        }
        ?>
    </div>
</body>
</html>
