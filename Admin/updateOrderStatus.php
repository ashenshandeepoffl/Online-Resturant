<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "As+s01galaxysa";
$dbname = "Resturent";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
