<?php
session_start();
require 'pdoconnection.php';

// Check if user is already logged in
if (isset($_SESSION["email"]) && isset($_SESSION["password"])) {
    // Redirect to homepage
    echo "<script>window.location.href = 'homepage.php';</script>";
    exit;
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL query
    $sql = "SELECT * FROM register WHERE email = :email";
    $sqlStatement = $nep->prepare($sql);
    $sqlStatement->bindParam(':email', $email);
    $sqlStatement->execute();
    $user = $sqlStatement->fetch();

    // Check if login was successful
    if ($user && password_verify($password, $user['password'])) {
        // Save user session data
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $user['password'];

        // Redirect to homepage
        echo "<script>window.location.href = 'homepage.php';</script>";
        exit;
    } else {
        // Invalid email or password
        $errorMessage = "Invalid email or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>ibuy Auctions</title>
</head>
<body>

    <main>

        <form action="login.php" method="POST">
            <label for="email">Email:</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password"><br>
            <input type="submit" name="submit" id="submit"><br>
        </form>
    </main>
    <?php include 'foot.php'; include 'head.php'; ?>

    <script>
        // JavaScript redirection
        if (window.location.search.indexOf('login=failed') > -1) {
            alert("Invalid email or password.");
        }
    </script>
</body>
</html>
