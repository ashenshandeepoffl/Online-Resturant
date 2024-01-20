<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <link rel="stylesheet" href="home.css">
    <script src="home.js"></script>
</head>
<body>

    <div class="topnav">
        <a class="active" href="customerHome.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a href="foodCart.php">Food Cart</a>
        <a href="onlineReservation.php">Online Reservation</a>
        <a href="aboutus.html">About</a>
        <a href="/Restaurant/gallery.html">Gallery</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php
       include 'welcomeName.php';
    ?>

     <!-- Search Bar -->

    <div class="cover">
        <h1>Discover your favourite food</h1>
        <form  class="flex-form">
            <input type="search" id="searchInput" onkeyup="liveSearch()" placeholder="Search for your favourite food...">
            <input type="submit" value="Search">
        </form>

        <div class="filter">
            <label for="priceFilter">Price</label>

            <select id="priceFilter" onchange="liveSearch()">
                <option value="">All</option>
                <option value="10">$10 and below</option>
                <option value="20">$20 and below</option>
                <option value="30">$30 and below</option>
            </select>

            <label for="categoryFilter">Category</label>
    
            <select id="categoryFilter" onchange="liveSearch()">
                <option value="">All</option>
                <option value="Appetizer">Appetizer</option>
                <option value="Main Course">Main Course</option>
                <option value="Dessert">Dessert</option>
            </select>
        </div>
    </div>

    <div  class="filteredMenu"  id="filteredMenuContainer"></div>

    <div class="hero-image">
        <div class="hero-text">
            <h1>The Outer Clove restaurant</h1>
            <p class="hero-textP">Quality Food from a Quality Kitchen</p>
        </div>
    </div>

    <h2 class="words"> "Unparalleled dining experience, top-rated by authorities" </h2>

    <!-- Menu Section -->
    <h3>Menu</h3>
    <div class='card-container'>
        <?php
            include 'dbConnection.php';

            $menu_query = "SELECT * FROM menu_items";
            $menu_result = $conn->query($menu_query);

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
<hr>
    
</body>
</html>
