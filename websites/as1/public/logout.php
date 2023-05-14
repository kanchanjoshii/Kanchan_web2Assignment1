<?php
session_start(); // Start or resume the session

// Check if the user is logged in
if(isset($sess['name'])) {
    // Unset all of the session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

// Redirect to index.php
header("Location: index.php");
exit();
?>
