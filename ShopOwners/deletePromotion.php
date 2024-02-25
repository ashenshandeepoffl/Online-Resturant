<?php
session_start();

include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $promotion_id = $_GET['id'];

    // Retrieve existing image URL
    $existing_image_query = "SELECT image_url FROM promotions WHERE id = $promotion_id";
    $existing_image_result = $conn->query($existing_image_query);

    if ($existing_image_result->num_rows == 1) {
        $existing_image_row = $existing_image_result->fetch_assoc();
        $existing_image_url = $existing_image_row['image_url'];

        // Delete the previous image
        if (file_exists($existing_image_url)) {
            unlink($existing_image_url);
        }
    }

    // Delete promotion from the database
    $delete_promotion_query = "DELETE FROM promotions WHERE id = $promotion_id";
    $conn->query($delete_promotion_query);

    // Redirect back to the adminManagePromotions.html page
    header("Location: ManagePromotions.php");
    exit();
} else {
    // Redirect to adminManagePromotions.html if id is not provided
    header("Location: ManagePromotions.php");
    exit();
}
?>
