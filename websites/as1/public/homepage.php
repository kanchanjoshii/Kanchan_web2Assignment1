<?php
session_start();
require 'pdoconnection.php';
require 'head.php';

// Check if the connection was successful
if (!$nep) {
    echo "Failed to connect to the database.";
    exit;
}

// Retrieve data from the auction table
$sqlStatement = $nep->query("SELECT * FROM auction");
$auctions = $sqlStatement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Auction Data</title>
</head>
<body>
    <h1>Auction Data</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>End Date</th>
            <th>Category</th>
            <th>Category ID</th>
        </tr>
        <?php foreach ($auctions as $auction): ?>
        <tr>
            <td><?php echo $auction['title']; ?></td>
            <td><?php echo $auction['description']; ?></td>
            <td><?php echo $auction['endDate']; ?></td>
            <td><?php echo $auction['category']; ?></td>
            <td><?php echo $auction['categoryId']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ibuy Auctions</title>
</head>
<body>
<main>
    <?php
        echo '<a href="logout.php">Logout</a>&nbsp &nbsp &nbsp';
        echo '<a href="addAuction.php">AuctionAdd</a>&nbsp &nbsp &nbsp';
        echo '<a href="editAuction.php">editauction</a>&nbsp &nbsp &nbsp';
        echo '<a href="deleteAuction.php">deleteauction</a>&nbsp &nbsp &nbsp';
        echo '<a href="review.php">review</a>&nbsp &nbsp &nbsp';
        echo '<a href="bid.php">bid</a>&nbsp &nbsp &nbsp';
        echo '<a href="addCategory.php">AddCategory</a>&nbsp &nbsp &nbsp';
        echo '<a href="editCategory.php">EditCategory</a>&nbsp &nbsp &nbsp';
        echo '<a href="deleteCategory.php">DeleteCategory</a>&nbsp &nbsp &nbsp';
    ?>
    </main>
    
</body>
</html>
<?php
       
        require'foot.php';
    ?>