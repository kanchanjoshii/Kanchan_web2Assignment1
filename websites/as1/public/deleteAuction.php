<?php
session_start();
//Connecting to the database
require 'pdoconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';


    // Checking whether connection will be successful or not
    if ($nep) {
        // Prepare and execute the SQL query
        $sqlStatement = $nep->prepare("DELETE FROM auction WHERE categoryId = ?");
        $sqlStatement->bindValue(1, $categoryId);

        if ($sqlStatement->execute()) {
            echo "Auction deleted successfully!";
        } else {
            echo "Error: " . $sqlStatement->errorInfo()[2];
        }

        // Closing the prepared statement
        $sqlStatement->closeCursor();

        // Closing the database connection
        $nep = null;
    } else {
        echo "Failed to connect to the database.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Auction</title>
</head>
<body>
    <h1>Delete Auction</h1>
    <form method="POST" action="deleteAuction.php">
        <label for="categoryId">Category ID:</label>
        <input type="number" name="categoryId" id="categoryId" required><br><br>

        <input type="submit" value="Delete">
    </form>
</body>
</html>

<?php require 'head.php'; require 'foot.php'; ?>
