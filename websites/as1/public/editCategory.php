<?php
session_start();
require 'pdoconnection.php';

$error = ""; // Initialize the error variable
$category_id = ""; // Initialize the category ID variable
$name = ""; // Initialize the name variable

if ($nep) {
    echo "Connected";
    echo '<br>';
}

// Check if category ID is provided in the query string
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    
    try {
        // Retrieve category details from the database
        $sql = "SELECT * FROM category WHERE categoryId = :category_id";
        $sqlStatement = $nep->prepare($sql);
        $sqlStatement->bindParam(':category_id', $category_id);
        $sqlStatement->execute();
        $category = $sqlStatement->fetch(PDO::FETCH_ASSOC);
        
        // Check if category exists
        if ($category) {
            $name = $category['name']; // Get the name from the category details
        } else {
            $error = "Category not found.";
        }
    } catch (PDOException $e) {
        $error = "Error retrieving category: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $category_id = $_POST["category_id"];
    $name = $_POST["name"];

    try {
        // Prepare SQL statement based on whether a category ID is present or not
        if ($category_id) {
            $sqlStatement = $nep->prepare("UPDATE category SET name = :name WHERE categoryId = :category_id");
            $sqlStatement->bindParam(':category_id', $category_id);
        } else {
            $sqlStatement = $nep->prepare("INSERT INTO category (name) VALUES (:name)");
        }

        $sqlStatement->bindParam(':name', $name);

        // Execute the SQL statement
        if ($sqlStatement->execute()) {
            echo "Category saved successfully.";
        } else {
            $error = "Error saving category.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>

    <?php if ($error) : ?>
        <p>Error: <?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="category_id">Category ID:</label>
        <input type="number" name="category_id" id="category_id" value="<?php echo $category_id; ?>" <?php if ($category_id) echo "readonly"; ?>><br>
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required><br>

        <?php if ($category_id) : ?>
            <input type="submit" value="Edit">
        <?php else : ?>
            <input type="submit" value="Submit">
        <?php endif; ?>
    </form>
    <?php require 'foot.php'; require 'head.php' ?>
</body>
</html>
