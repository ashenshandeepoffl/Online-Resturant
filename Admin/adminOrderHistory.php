<?php


include 'dbConnection.php';

// Fetch order history for the admin
$admin_order_history_query = "SELECT * FROM admin_orders";
$admin_order_history_result = $conn->query($admin_order_history_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order History</title>
</head>
<body>
    <h2>Admin Order History</h2>
    <?php
    if ($admin_order_history_result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>";
        while ($admin_order_history_row = $admin_order_history_result->fetch_assoc()) {
            echo "<tr>
                    <td>{$admin_order_history_row['order_id']}</td>
                    <td>{$admin_order_history_row['username']}</td>
                    <td>{$admin_order_history_row['total_amount']}</td>
                    <td>{$admin_order_history_row['status']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No order history available.";
    }
    ?>

    <!-- Add a link to go back to the admin home page -->
    <p><a href="adminHome.html">Go back to Admin Home</a></p>
</body>
</html>
