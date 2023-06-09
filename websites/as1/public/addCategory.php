<?php
session_start();
//Connecting to the database
require 'pdoconnection.php';

$displayMessage = ""; // Messsage to display the variable

if ($nep) {
    //using echo tag
    echo "Connected";
    echo '<br>';
}

//if statement is being used
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $name = $_POST["name"];

    // Prepare SQL statement
    $sqlStatement = $nep->prepare("INSERT INTO category (name) VALUES (:name)");
    $sqlStatement->bindParam(':name', $name);

    // Execute the SQL statement
    if ($sqlStatement->execute()) {
        $displayMessage = "Category added successfully.";
    } else {
        $displayMessage = "Error adding category: " . $sqlStatement->errorInfo()[2];
    }
}

// Retriving latest category to display
$latestCategoryStatement = $nep->query("SELECT name FROM category ORDER BY name DESC LIMIT 1");
$latestCategory = $latestCategoryStatement->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADD Category</title>
    <?php require 'head.php'; ?>
</head>
<body>
    <h1>Add Category</h1>
    <div style="position: absolute; top: 10px; right: 10px;">
        <?php
        echo $displayMessage;
        echo "<br>";
        echo "Latest Category: " . $latestCategory;
        ?>
    </div>
    <form action="addCategory.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <input type="submit" value="Submit">
    </form>
    <?php require 'foot.php'; ?>
</body>
</html>
