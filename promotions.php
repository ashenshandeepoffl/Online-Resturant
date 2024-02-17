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
                ?>
                <div class="card">
                    <div class="card-image">
                        <img src='/Restaurant/Admin/<?php echo $row['image_url']; ?>' alt='Promotion Image' style='width:100%'>
                    </div>
                    <div class="card-content">
                        <h3><?php echo $row['promotion_name']; ?></h3>
                        <p>Old Price</p><p class='oldPrice'>$ <?php echo $row['old_price']; ?></p>
                        <p>Promotional Price <b>$ <?php echo $row['new_price']; ?></b></p>
                        <div class="buttons">
                            <a href='login.php'><button class='add'>Place an Order</button></a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No promotions found.</p>";
        }
        ?>
    </div>

</body>
</html>
