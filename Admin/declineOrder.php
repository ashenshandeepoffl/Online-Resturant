<?php
session_start();

include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Update order status to 'Declined'
    $decline_order_query = "UPDATE promotion_orders SET order_status = 'Declined' WHERE order_id = $order_id";
    $conn->query($decline_order_query);

    // Redirect back to the adminCheckOrders.html page
    header("Location: adminCheckOrders.php");
    exit();
} else {
    // Redirect to adminCheckOrders.html if order ID is not provided
    header("Location: adminCheckOrders.php");
    exit();
}
?>
