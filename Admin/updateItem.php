<?php
session_start();

// Database connection details
include 'dbConnection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $menu_code = $_POST['menu_code'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_small_desc = $_POST['item_small_desc'];
    $item_long_desc = $_POST['item_long_desc'];
    $item_categories = $_POST['item_categories'];

    // Retrieve existing image URL
    $existing_image_query = "SELECT image_url FROM menu_items WHERE menu_code = $menu_code";
    $existing_image_result = $conn->query($existing_image_query);

    if ($existing_image_result->num_rows == 1) {
        $existing_image_row = $existing_image_result->fetch_assoc();
        $existing_image_url = $existing_image_row['image_url'];
        
        // Delete the previous image
        if (file_exists($existing_image_url)) {
            unlink($existing_image_url);
        }
    }

    // Check if a new image is provided
    if ($_FILES["item_image"]["size"] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
        move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);
    } else {
        // Keep the existing image if not provided
        $target_file = $existing_image_url;
    }

    // Update item in the database
    $update_item_query = "UPDATE menu_items SET
                          image_url = '$target_file',
                          name = '$item_name',
                          price = $item_price,
                          small_description = '$item_small_desc',
                          long_description = '$item_long_desc',
                          categories = '$item_categories'
                          WHERE menu_code = $menu_code";

    if ($conn->query($update_item_query) === TRUE) {
        header("Location: adminHome.html");
        exit();
    } else {
        echo "Error: " . $update_item_query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>