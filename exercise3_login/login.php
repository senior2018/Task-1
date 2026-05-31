<?php
session_start();

include "db.php";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $pdo->query(
        "SELECT * FROM users WHERE username='$username'"
    )->fetch(PDO::FETCH_ASSOC);

    if($user)
    {
        if($password == $user['password'])
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: welcome.php");
            exit();
        }
        else
        {
            echo "Wrong password";

            }
    }
    else
    {
        echo "User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
    <h2>Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">

        <input type="password" name="password" placeholder="Password">

        <button type="submit" name="login">Login</button>
    </form>

    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>
</div>

</body>
</html>