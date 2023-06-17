<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Website</title>
</head>

<body>
    <div class="center">
        <h1>Login</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="Email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot Password?</div>
            <input type="submit" name="submit" value="Login">
            <div class="signup_link">
                Not a member? <a href="register.php">Sign Up</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $file = fopen("contact_data.txt", "r");
    $found = false;
    while (!feof($file)) {
        $line = fgets($file);
        $user = explode("   ", $line);

        if (trim($user[1]) == $email && trim($user[2]) == $password) {
            $found = true;
            break;
        }
    }

    fclose($file);
    if ($found) {
        header("Location: produit.php");
        exit();
    } else {
        echo "Erreur entre sont email et password. Veuillez réessayer.";
    }
}


?>