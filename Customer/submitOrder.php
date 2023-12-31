<?php
session_start();

// Database connection details
include 'dbConnection.php';

// Process the submitted order to the admin side
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $total_amount = $_POST['total_amount'];

    // Insert the order into the admin_orders table
    $insert_order_query = "INSERT INTO admin_orders (username, total_amount, status)
                            VALUES ('$username', $total_amount, 'pending')";

    if ($conn->query($insert_order_query) === TRUE) {
        $order_id = $conn->insert_id;

        // Retrieve the order details from the user's order history
        $order_details_query = "SELECT menu_items.name, orders.quantity
                                FROM orders
                                JOIN menu_items ON orders.menu_code = menu_items.menu_code
                                WHERE orders.username = '$username'";

        $order_details_result = $conn->query($order_details_query);

        // Insert order details into the order_details table
        while ($order_details_row = $order_details_result->fetch_assoc()) {
            $menu_item_name = $order_details_row['name'];
            $quantity = $order_details_row['quantity'];

            $insert_order_details_query = "INSERT INTO order_details (order_id, menu_item_name, quantity)
                                           VALUES ($order_id, '$menu_item_name', $quantity)";

            $conn->query($insert_order_details_query);
        }

        // Clear the customer's order history
        $clear_order_history_query = "DELETE FROM orders WHERE username = '$username'";
        $conn->query($clear_order_history_query);

        // Redirect back to the customer order summary
        header("Location: foodCart.php");
        exit();
    } else {
        echo "Error: " . $insert_order_query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>