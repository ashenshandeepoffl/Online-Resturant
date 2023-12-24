<?php
session_start();

include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_id = $_SESSION['user_id'];
    $promotion_id = $_POST['promotion_id'];

    // Insert order into the promotion_orders table
    $place_order_query = "INSERT INTO promotion_orders (customer_id, promotion_id)
                          VALUES ($customer_id, $promotion_id)";

    $conn->query($place_order_query);

    // Redirect back to the customer home page
    header("Location: customerHome.php");
    exit();
}
?>
