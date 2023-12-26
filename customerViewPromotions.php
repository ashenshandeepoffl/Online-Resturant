<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Promotions</title>
    <link rel="stylesheet" href="Home.css">
</head>
<body>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a class="active" href="customerViewPromotions.php">Promotions</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About</a>
        <a href="login.php">Login</a>
    </div>

    <h2 class="topics">Promotions</h2>

    <?php
    include 'dbConnection.php';

    // Query to get all promotions
    $all_promotions_query = "SELECT * FROM promotions";
    $result = $conn->query($all_promotions_query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="custom-card">';
                echo "<img src='/Restaurant/Admin/{$row['image_url']}' alt='Promotion Image' class='card-image'>";
                echo "<h1 class='card-title'>{$row['promotion_name']}</h1>";
                echo "<p class='card-price'>Old Price: {$row['old_price']}</p>";
                echo "<p class='card-price'>New Price: {$row['new_price']}</p>";
                echo "<h3>Place Online Order</h3>";
                echo "<p class='card-signup'>Do you want to order? <a href='signup.php'>click here</a></p>";
            echo '</div>';
        }
    } else {
        echo "<p>No promotions found.</p>";
    }
    ?> 
</body>
</html>
