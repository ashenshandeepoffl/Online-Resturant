<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <script>
        // Prevent going back to the login page
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
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
        header("Location: login.html");
        exit();
    }
    ?>

    <!-- Menu Section -->
    <h3>Menu</h3>
    <?php
    // Fetch menu items from the database
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "As+s01galaxysa";
    $dbname = "Resturent";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $menu_query = "SELECT * FROM menu_items";
    $menu_result = $conn->query($menu_query);

    if ($menu_result->num_rows > 0) {
        while ($menu_row = $menu_result->fetch_assoc()) {
            echo "<div>";
            // echo "<img src='{$menu_row['image_url']}' alt='{$menu_row['name']}'><br>";
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

    <a href="/Restaurant/logout.php">Logout</a>
    <a href="orderHistory.php">viewCart</a>
    <a href="orderSummary.php">Order Summery</a>
</body>
</html>
