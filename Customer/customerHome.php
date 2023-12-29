<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };

        function liveSearch() {
            var searchInput = document.getElementById("searchInput").value;
            var priceFilter = document.getElementById("priceFilter").value;
            var categoryFilter = document.getElementById("categoryFilter").value;

            // Send AJAX request to server for live search
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("filteredMenuContainer").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "liveSearch.php?searchInput=" + searchInput + "&priceFilter=" + priceFilter + "&categoryFilter=" + categoryFilter, true);
            xmlhttp.send();
        }
    </script>
    <title>Customer Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">
        <a class="active" href="customerHome.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a href="orderHistory.php">View All Ordered Itesms</a>
        <!-- <a href="orderSummary.php">Order Summery</a> -->
        <a href="onlineReservation.php">Online Reservation</a>
        <a href="view_reservation.php">View Reservation</a>
        <a href="customer_facilities.php">customer_facilities</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php
       include 'welcomeName.php';
    ?>

     <!-- Search Bar -->
    <input class="searchBox" type="text" id="searchInput" onkeyup="liveSearch()" placeholder="Search for your favourite food">

    <!-- Filter Options -->
    <h3 class="topics" >Filter Options</h3>

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
    

    <!-- Filtered Menu Section -->
    <h3>Filtered Menu</h3>

    <div  class="filteredMenu"  id="filteredMenuContainer"></div>

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
