<?php
include "db.php";

$error = "";
$success = "";

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "" || $password == "")
    {
        $error = "All fields are required!";
    }
    else
    {
        try {
            $sql = "INSERT INTO users(username, password)
                    VALUES('$username', '$password')";

            $pdo->exec($sql);

            $success = "Account created successfully!";
        }
        catch(PDOException $e)
        {
            // duplicate entry error
            if($e->getCode() == 23000)
            {
                $error = "Username already exists. Try another one.";
            }
            else
            {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
    <h2>Register</h2>

    <!-- ERROR DISPLAY -->
    <?php if($error != ""): ?>
        <?php echo $error; ?>
    <?php endif; ?>

    <!-- SUCCESS DISPLAY -->
    <?php if($success != ""): ?>
        <?php echo $success; ?>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">

        <input type="password" name="password" placeholder="Password">

        <button type="submit" name="register">Register</button>
    </form>

    <p>
        Already have an account?
        <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>