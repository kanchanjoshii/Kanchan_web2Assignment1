<?php
session_start();
//Connecting to the database
require 'pdoconnection.php';

//displaying message
$displayMessage = ""; 

//using if statement
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retriving data from the form
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';

   

    // Checking connection is successful or not
    if ($nep) {
        // preparing and executing the codes
        $sqlStatement = $nep->prepare("INSERT INTO auction (title, description, endDate, category, categoryId) VALUES (?, ?, ?, ?, ?)");
        $sqlStatement->bindValue(1, $title);
        $sqlStatement->bindValue(2, $description);
        $sqlStatement->bindValue(3, $endDate);
        $sqlStatement->bindValue(4, $category);
        $sqlStatement->bindValue(5, $categoryId);

        if ($sqlStatement->execute()) {
            $displayMessage = "Auction saved successfully!";
        } else {
            $displayMessage = "Error: " . $sqlStatement->errorInfo()[2];
        }

        // Closing
        $sqlStatement->closeCursor();

        // Closed
        $nep = null;
    } else {
        $displayMessage = "Failed to connect to the database.";
    }
}
?>
  <!-- HTML form is used to retrieve data -->

<!DOCTYPE html>
<html>
<head>
    <title>Auction Form</title>
</head>
<body>
    <h1>Auction Form</h1>
    <div style="position: absolute; top: 10px; right: 10px;"><?php echo $displayMessage; ?></div>
    <form method="POST" action="addAuction.php">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="endDate">End Date:</label>
        <input type="date" name="endDate" id="endDate" required><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required><br><br>

        <label for="categoryId">Category ID:</label>
        <input type="number" name="categoryId" id="categoryId" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php require 'head.php'; require 'foot.php'; ?>
