<?php
session_start();

// Database connection details
include 'dbConnection.php';

// Fetch order history for the logged-in user
$username = $_SESSION['username'];
$order_history_query = "SELECT admin_orders.order_id, admin_orders.total_amount, admin_orders.status, GROUP_CONCAT(order_details.menu_item_name ORDER BY order_details.order_detail_id) AS menu_items
                        FROM admin_orders
                        LEFT JOIN order_details ON admin_orders.order_id = order_details.order_id
                        WHERE admin_orders.username = '$username'
                        GROUP BY admin_orders.order_id
                        ORDER BY admin_orders.order_id DESC";

$order_history_result = $conn->query($order_history_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
</head>
<body>
    <h2>Order History</h2>
    <?php
    if ($order_history_result->num_rows > 0) {
        while ($order_history_row = $order_history_result->fetch_assoc()) {
            echo "<h3>Order ID: {$order_history_row['order_id']}</h3>";
            echo "<p>Total Amount: {$order_history_row['total_amount']}</p>";
            echo "<p>Status: {$order_history_row['status']}</p>";
            
            if (!empty($order_history_row['menu_items'])) {
                $menu_items = explode(',', $order_history_row['menu_items']);
                echo "<ul>";
                foreach ($menu_items as $menu_item) {
                    echo "<li>$menu_item</li>";
                }
                echo "</ul>";
            } else {
                echo "No items in this order.";
            }

            echo "<hr>"; // Separate each order
        }
    } else {
        echo "No order history available.";
    }
    ?>

    <!-- Add a link to go back to the customer home page -->
    <p><a href="customerHome.html">Go back to Customer Home</a></p>
</body>
</html>
