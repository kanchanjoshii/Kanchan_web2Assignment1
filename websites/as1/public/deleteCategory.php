<?php
session_start();
require 'pdoconnection.php';

if ($nep) {
    echo "Connected";
    echo '<br>';
}

$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : "";
$name = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['categoryId'])) {
    // Retrieve category ID from the query string
    $categoryId = $_GET['categoryId'];

    try {
        // Prepare SQL statement to delete category
        $sqlStatement = $nep->prepare("DELETE FROM category WHERE categoryId = :categoryId");
        $sqlStatement->bindParam(':categoryId', $categoryId);

        // Execute the SQL statement
        if ($sqlStatement->execute()) {
            echo "Category deleted successfully.";
        } else {
            echo "Error deleting category.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>

<?php require 'head.php'; ?>

<form action="" method="POST">
    <label for="categoryId">Category ID:</label>
    <input type="number" name="categoryId" id="categoryId" value="<?php echo $categoryId; ?>" <?php if ($categoryId) echo "readonly"; ?>><br>
    
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $name; ?>" required><br>

    <?php if ($categoryId) : ?>
        <input type="submit" value="Edit">
        <a href="deleteCategory.php?categoryId=<?php echo $categoryId; ?>">Delete</a>
    <?php else : ?>
        <input type="submit" value="Submit">
    <?php endif; ?>
</form>

<?php require 'foot.php'; ?>
