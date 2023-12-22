<?php
session_start();

// Database connection details
include 'dbConnection.php';

// Process the order status update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];

    // Update the order status to 'order complete'
    $update_status_query = "UPDATE admin_orders SET status = 'order complete' WHERE order_id = $order_id";

    if ($conn->query($update_status_query) === TRUE) {
        // Redirect back to the admin orders page
        header("Location: adminOrders.php");
        exit();
    } else {
        echo "Error: " . $update_status_query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
