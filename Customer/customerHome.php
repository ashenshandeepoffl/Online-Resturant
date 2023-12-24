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
</head>
<body>
    <h2>Welcome to Customer Home Page</h2>

    <?php
    
    // Start the session
    session_start();


    // Check if the user is logged in
    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "customers") {
              
        // Display the username
        echo "<p>Hello, " . $_SESSION["username"] . "!</p>";
        
    } else {
        // Redirect to the login page if not logged in
        header("Location: login.php");
        exit();
    }
    ?>

     <!-- Search Bar -->
     <h3>Search Menu</h3>
    <input type="text" id="searchInput" onkeyup="liveSearch()" placeholder="Search by name">

    <!-- Filter Options -->
    <h3>Filter Options</h3>
    <label for="priceFilter">Price:</label>
    <select id="priceFilter" onchange="liveSearch()">
        <option value="">All</option>
        <option value="10">$10 and below</option>
        <option value="20">$20 and below</option>
        <option value="30">$30 and below</option>
    </select>

    <label for="categoryFilter">Category:</label>
    <select id="categoryFilter" onchange="liveSearch()">
        <option value="">All</option>
        <option value="Appetizer">Appetizer</option>
        <option value="Main Course">Main Course</option>
        <option value="Dessert">Dessert</option>
    </select>

    <!-- Filtered Menu Section -->
    <h3>Filtered Menu</h3>
    <div id="filteredMenuContainer"></div>

    <!-- Menu Section -->
    <h3>Menu</h3>
    <?php
    
    include 'dbConnection.php';

    $menu_query = "SELECT * FROM menu_items";
    $menu_result = $conn->query($menu_query);

    if ($menu_result->num_rows > 0) {
        while ($menu_row = $menu_result->fetch_assoc()) {
            // Assuming that $menu_row['image_url'] contains the image filename
            $imagePath = "Admin/uploads/" . $menu_row['image_url'];
    
            echo "<div>"; 
            echo "<img src='/Restaurant/Admin/{$menu_row['image_url']}' alt='{$menu_row['name']}' width='150' height='150'><br>";
            echo "Name: {$menu_row['name']}<br>";
            echo "Price: {$menu_row['price']}<br>";
            echo "Description: {$menu_row['small_description']}<br>";
            echo "<a href='menuDetails.php?menu_code={$menu_row['menu_code']}'>Show Details</a><br>";
            echo "</div>";
        }
    } else {
        echo "No menu items available.";
    }
    ?>
<hr>
    <a href="/Restaurant/logout.php">Logout</a> <hr>
    <a href="orderHistory.php">View All Ordered Itesms</a> <hr>
    <a href="orderSummary.php">Order Summery</a> <hr>
    <a href="onlineReservation.php">Online Reservation</a> <hr>
    <a href="view_reservation.php">View Reservation</a> <hr>
    <a href="customer_facilities.php">customer_facilities</a> <hr>
    <a href="customerViewPromotions.php">Promotions</a> <hr>
</body>
</html>
