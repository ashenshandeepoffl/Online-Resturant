<?php
session_start();

include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_small_desc = $_POST['item_small_desc'];
    $item_long_desc = $_POST['item_long_desc'];
    $item_categories = $_POST['item_categories'];

    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["item_image"]["name"]);

    if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["item_image"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Insert new item into the database
    $add_item_query = "INSERT INTO menu_items (image_url, name, price, small_description, long_description, categories)
                   VALUES ('$target_file', '$item_name', $item_price, '$item_small_desc', '$item_long_desc', '$item_categories')";


    if ($conn->query($add_item_query) === TRUE) {
        header("Location: menu.php");
        exit();
    } else {
        echo "Error: " . $add_item_query . "<br>" . $conn->error;
        echo "<p><a href="adminHome.php">Home</a></p>"
    }
}

// Close the database connection
$conn->close();