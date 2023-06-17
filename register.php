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
        <h1>Registration</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="name" required>
                <span></span>
                <label>Name</label>
            </div>
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
            <input type="submit" name="submit" value="Create account">
            <div class="signup_link">
                Already have an account? <a href="login.php">Sign In</a>
            </div>
        </form>
    </div>
</body>

</html>


<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs soumises
    $prenom = $_POST["name"];
    $email = $_POST["Email"];
    $password = $_POST["password"];
    mkdir("testutilisateur/$prenom");
    $fopen = fopen("testutilisateur/$prenom/produit.txt", "a+");

    $user_info = $prenom . "   " . $email . "   " . $password . "\n";

    $file = fopen("contact_data.txt", "a");

    fwrite($file, $user_info);

    fclose($file);
    header("Location: produit.php");
    exit;

}
?>