<?php
session_start();

// Database connection details
include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_code = $_POST['menu_code'];

    // Delete associated comments
    $delete_comments_query = "DELETE FROM comments WHERE menu_code = $menu_code";
    $conn->query($delete_comments_query);

    // Delete item from the database
    $delete_item_query = "DELETE FROM menu_items WHERE menu_code = $menu_code";

    if ($conn->query($delete_item_query) === TRUE) {
        header("Location: adminHome.php");
        exit();
    } else {
        echo "Error: " . $delete_item_query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();