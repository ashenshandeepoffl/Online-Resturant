<?php
session_start();

// Include database connection code here
include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $promotion_name = $_POST['promotion_name'];
    $old_price = $_POST['old_price'];
    $new_price = $_POST['new_price'];

    // Upload promotion image
    $target_dir = "promotion_images/";
    $target_file = $target_dir . basename($_FILES["promotion_image"]["name"]);
    move_uploaded_file($_FILES["promotion_image"]["tmp_name"], $target_file);

    // Insert new promotion into the database
    $add_promotion_query = "INSERT INTO promotions (promotion_name, old_price, new_price, image_url)
                            VALUES ('$promotion_name', $old_price, $new_price, '$target_file')";

    $conn->query($add_promotion_query);

    // Redirect back to the adminManagePromotions.html page
    header("Location: ManagePromotions.php");
    exit();
}
?>
