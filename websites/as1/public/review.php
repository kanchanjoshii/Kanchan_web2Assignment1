<?php
session_start();
require 'pdoconnection.php';

// Check if the connection was successful
if (!$nep) {
    echo "Failed to connect to the database.";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $reviewText = isset($_POST['reviewText']) ? $_POST['reviewText'] : '';

    // Prepare and execute the SQL query
    $sqlStatement = $nep->prepare("INSERT INTO review (text) VALUES (?)");
    $sqlStatement->bindValue(1, $reviewText);

    if ($sqlStatement->execute()) {
        echo "Review submitted successfully!";
    } else {
        echo "Error submitting review: " . $sqlStatement->errorInfo()[2];
    }

    // Close the prepared statement
    $sqlStatement->closeCursor();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Review Form</title>
</head>
<body>
    <h1>Review Form</h1>
    <form method="POST" action="review.php">
        <label for="reviewText">Review:</label>
        <textarea name="reviewText" id="reviewText" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>


<?php require 'head.php'; require 'foot.php'; ?>
