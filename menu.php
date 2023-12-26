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
    <title>Document</title>
    <link rel="stylesheet" href="menu.scss">
</head>
<body>
    <h3>Menu</h3>
    <?php
        if ($menu_result->num_rows > 0) {
            while ($menu_row = $menu_result->fetch_assoc()) {
                // Assuming that $menu_row['image_url'] contains the image filename
                $imagePath = "Admin/uploads/" . $menu_row['image_url'];

                echo '<div class="container">';
                    echo '<div class="images">';
                        echo "<img src='/Restaurant/Admin/{$menu_row['image_url']}' alt='{$menu_row['name']}' />";
                    echo '</div>';
                        echo '<div class="slideshow-buttons">';
                        echo '<div class="one"></div>';
                        echo '<div class="two"></div>';
                        echo '<div class="three"></div>';
                        echo '<div class="four"></div>';
                    echo '</div>';

                    echo '<div class="product">';
                        echo "<h1>{$menu_row['name']}</h1>";
                        echo "<h2>{$menu_row['price']}</h2>";
                        echo "<p class='desc'>{$menu_row['small_description']}</p>";
                        echo '<div class="buttons">';
                            echo "<a href='menuDetails.php?menu_code={$menu_row['menu_code']}'><button class='add' >More details</button></a><br>";
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No menu items available.";
        }
    ?>
</body>
</html>