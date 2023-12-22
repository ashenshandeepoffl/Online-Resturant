<?php
session_start();

// Database connection details
include 'dbConnection.php';

// Fetch filtered menu items based on search input, price filter, and category filter
$searchInput = $_GET['searchInput'];
$priceFilter = $_GET['priceFilter'];
$categoryFilter = $_GET['categoryFilter'];

// Construct SQL query based on filters
$sql = "SELECT * FROM menu_items WHERE 
        (name LIKE '%$searchInput%' OR '$searchInput' = '') AND 
        (price <= $priceFilter OR '$priceFilter' = '') AND 
        (categories = '$categoryFilter' OR '$categoryFilter' = '')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<img src='{$row['image_url']}' alt='{$row['name']}'><br>";
        echo "Name: {$row['name']}<br>";
        echo "Price: {$row['price']}<br>";
        echo "Description: {$row['small_description']}<br>";
        echo "<a href='menuDetails.php?menu_code={$row['menu_code']}'>Show Details</a><br>";
        echo "</div>";
    }
} else {
    echo "No matching menu items.";
}

// Close the database connection
$conn->close();
?>
