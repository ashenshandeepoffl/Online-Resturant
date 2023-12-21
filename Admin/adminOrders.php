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


// Fetch pending orders and their details for the admin
$admin_orders_query = "SELECT * FROM admin_orders WHERE status = 'pending'";
$admin_orders_result = $conn->query($admin_orders_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
</head>
<body>
    <h2>Admin Orders</h2>
    <?php
    if ($admin_orders_result->num_rows > 0) {
        while ($admin_order_row = $admin_orders_result->fetch_assoc()) {
            echo "<h3>Order ID: {$admin_order_row['order_id']}</h3>";
            echo "<p>Username: {$admin_order_row['username']}</p>";
            echo "<p>Total Amount: {$admin_order_row['total_amount']}</p>";

            // Fetch order details for the current order
            $order_id = $admin_order_row['order_id'];
            $order_details_query = "SELECT * FROM order_details WHERE order_id = $order_id";
            $order_details_result = $conn->query($order_details_query);

            if ($order_details_result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Menu Item</th>
                            <th>Quantity</th>
                        </tr>";
                while ($order_details_row = $order_details_result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$order_details_row['menu_item_name']}</td>
                            <td>{$order_details_row['quantity']}</td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "No order details available.";
            }

            // Add a button for the admin to approve the order
            echo "<form action='approveOrder.php' method='post'>
                    <input type='hidden' name='order_id' value='$order_id'>
                    <input type='submit' value='Approve Order'>
                  </form>";

            echo "<hr>"; // Separate each order
        }
    } else {
        echo "No pending orders.";
    }
    ?>

    <!-- Add a link to go back to the admin home page -->
    <p><a href="adminHome.html">Go back to Admin Home</a></p>
</body>
</html>