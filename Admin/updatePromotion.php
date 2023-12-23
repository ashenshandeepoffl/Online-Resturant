<?php
session_start();

include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $promotion_id = $_POST['promotion_id'];
    $promotion_name = $_POST['promotion_name'];
    $old_price = $_POST['old_price'];
    $new_price = $_POST['new_price'];

    // Retrieve existing image URL
    $existing_image_query = "SELECT image_url FROM promotions WHERE id = $promotion_id";
    $existing_image_result = $conn->query($existing_image_query);

    if ($existing_image_result->num_rows == 1) {
        $existing_image_row = $existing_image_result->fetch_assoc();
        $existing_image_url = $existing_image_row['image_url'];
        
        // Check if a new image is provided
        if ($_FILES["promotion_image"]["size"] > 0) {
            // Delete the previous image
            if (file_exists($existing_image_url)) {
                unlink($existing_image_url);
            }

            // Upload new promotion image
            $target_dir = "promotion_images/";
            $target_file = $target_dir . basename($_FILES["promotion_image"]["name"]);
            move_uploaded_file($_FILES["promotion_image"]["tmp_name"], $target_file);
        } else {
            // Keep the existing image if not provided
            $target_file = $existing_image_url;
        }

        // Update promotion in the database
        $update_promotion_query = "UPDATE promotions SET
                                  promotion_name = '$promotion_name',
                                  old_price = $old_price,
                                  new_price = $new_price,
                                  image_url = '$target_file'
                                  WHERE id = $promotion_id";

        $conn->query($update_promotion_query);

        // Redirect back to the adminManagePromotions.html page
        header("Location: ManagePromotions.php");
        exit();
    }
} else {
    // Redirect to adminManagePromotions.html if form not submitted properly
    header("Location: ManagePromotions.php");
    exit();
}
?>
