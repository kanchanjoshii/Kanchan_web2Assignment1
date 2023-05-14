<?php
session_start();
require 'pdoconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';

    // Establish the database connection

    // Check if the connection was successful
    if ($nep) {
        // Prepare and execute the SQL query to retrieve existing data
        $selectStatement = $nep->prepare("SELECT * FROM auction WHERE categoryId = ?");
        $selectStatement->bindValue(1, $categoryId);
        $selectStatement->execute();
        $existingData = $selectStatement->fetch(PDO::FETCH_ASSOC);

        // Check if data exists for the provided categoryId
        if ($existingData) {
            // Update the existing data with the form values
            $title = !empty($title) ? $title : $existingData['title'];
            $description = !empty($description) ? $description : $existingData['description'];
            $endDate = !empty($endDate) ? $endDate : $existingData['endDate'];
            $category = !empty($category) ? $category : $existingData['category'];

            // Prepare and execute the SQL query to update the data
            $updateStatement = $nep->prepare("UPDATE auction SET title = ?, description = ?, endDate = ?, category = ? WHERE categoryId = ?");
            $updateStatement->bindValue(1, $title);
            $updateStatement->bindValue(2, $description);
            $updateStatement->bindValue(3, $endDate);
            $updateStatement->bindValue(4, $category);
            $updateStatement->bindValue(5, $categoryId);

            if ($updateStatement->execute()) {
                echo "Auction updated successfully!";
            } else {
                echo "Error: " . $updateStatement->errorInfo()[2];
            }

            // Close the prepared statement
            $updateStatement->closeCursor();
        } else {
            echo "No data found for the provided Category ID.";
        }

        // Close the prepared statement
        $selectStatement->closeCursor();

        // Close the database connection
        $nep = null;
    } else {
        echo "Failed to connect to the database.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Auction</title>
</head>
<body>
    <h1>Edit Auction</h1>
    <form method="POST" action="editAuction.php">
        <label for="categoryId">Category ID:</label>
        <input type="number" name="categoryId" id="categoryId" required><br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" id="title"><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea><br><br>

        <label for="endDate">End Date:</label>
        <input type="date" name="endDate" id="endDate"><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php require 'head.php'; require 'foot.php'; ?>