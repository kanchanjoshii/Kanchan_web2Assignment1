<?php
session_start();
//Connecting to the database
require 'pdoconnection.php';

// Checking whether the connection is successful or not
if (!$nep) {
    echo "Failed to connect to the database.";
    exit;
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bidAmount = isset($_POST['amount']) ? $_POST['amount'] : '';

    // Prepare and execute the SQL query
    $sqlStatement = $nep->prepare("INSERT INTO bid (amount) VALUES (?)");
    $sqlStatement->bindValue(1, $bidAmount);

    if ($sqlStatement->execute()) {
        echo "Bid submitted successfully!";
    } else {
        echo "Error submitting bid: " . $sqlStatement->errorInfo()[2];
    }

    // Closing the prepared statement
    $sqlStatement->closeCursor();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bid Form</title>
</head>
<body>
    <h1>Bid Form</h1>
    <form method="POST" action="bid.php">
        <label for="amount">Bid Amount:</label>
        <input type="number" name="amount" id="amount" required><br><br>

        <input type="submit" value="Submit Bid">
    </form>
</body>
</html>
<?php require 'head.php'; require 'foot.php'; ?>
