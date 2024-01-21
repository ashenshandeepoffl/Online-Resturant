<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Promotions</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a class="active" href="promotions.php">Promotions</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About</a>
        <a href="gallery.html">Gallery</a>
        <a href="login.php">Login</a>
    </div>

    <h2 class="topics">Promotions</h2>
    <div class='card-container'>
        <?php
        include 'dbConnection.php';

        // Query to get all promotions
        $all_promotions_query = "SELECT * FROM promotions";
        $result = $conn->query($all_promotions_query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo '<div class="card">';
                    echo "<img src='/Restaurant/Admin/{$row['image_url']}' alt='Promotion Image' style='width:100%'>";
                    echo '<div class="container">';
                        echo "<h3>{$row['promotion_name']}</h3>";
                        echo "<p>Old Price</p>" . "<p class='oldPrice'>$ {$row['old_price']}</p>";
                        echo "<p>Promotional Price <b> $ {$row['new_price']} <b></p>";
                        echo '<div class="buttons">';
                            echo "<a href='signup.php'><button class='add'>Place an Order</button></a>";
                        echo '</div>';
                    echo "</div>";
                echo "</div>";

            }
        } else {
            echo "<p>No promotions found.</p>";
        }
        ?> 
    </div>
</body>
</html>
