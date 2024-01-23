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
            $imagePath = "Admin/uploads/" . $menu_row['image_url'];
            ?>
            <div class="card">
                <div class="card-image">
                    <img src='/Restaurant/Admin/<?php echo $menu_row['image_url']; ?>' alt='<?php echo $menu_row['name']; ?>' style='width:100%'>
                </div>
                <div class="card-content">
                    <h3><?php echo $menu_row['name']; ?></h3>
                    <p>$ <?php echo $menu_row['price']; ?></p>
                    <p><?php echo $menu_row['small_description']; ?></p>
                    <div class="buttons">
                        <a href='menuDetails.php?menu_code=<?php echo $menu_row['menu_code']; ?>'>
                            <button class='add'>More Details</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No menu items available.";
    }
    ?>
</div>

</body>
</html>
