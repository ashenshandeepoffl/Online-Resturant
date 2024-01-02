<?php
include 'dbConnection.php';

$menu_query = "SELECT * FROM menu_items";
$menu_result = $conn->query($menu_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>

    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a class="active" href="menu.php">Menu</a>
        <a href="aboutus.html">About</a>
        <a href="gallery.html">Gallery</a>
        <a href="login.php">Login</a>
    </div>

    <h2>Menu</h2>
    <div class='card-container'>
        <?php
            if ($menu_result->num_rows > 0) {
                while ($menu_row = $menu_result->fetch_assoc()) {
                    // Assuming that $menu_row['image_url'] contains the image filename
                    $imagePath = "Admin/uploads/" . $menu_row['image_url'];
            
                    echo '<div class="card">';
                        echo "<img src='/Restaurant/Admin/{$menu_row['image_url']}' alt='{$menu_row['name']}' style='width:100%'><br>";
                        echo '<div class="container">';
                            echo "<h3>{$menu_row['name']}</h3>";
                            echo "<p>$ {$menu_row['price']}</p>";
                            echo "<p>{$menu_row['small_description']}</p>";
                            echo '<div class="buttons">';
                                echo "<a href='menuDetails.php?menu_code={$menu_row['menu_code']}'><button class='add'>More Details</button></a><br>";
                            echo '</div>';
                        echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No menu items available.";
            }
        ?>
    </div>
</body>
</html>
