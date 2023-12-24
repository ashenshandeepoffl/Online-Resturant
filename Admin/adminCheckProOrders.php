<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Check Promotion Orders</title>
</head>
<body>
    <h2>Admin - Check Promotion Orders</h2>

    <?php
    include 'dbConnection.php';

    // Fetch and display promotion orders for admin review
    $all_orders_query = "SELECT po.order_id, u.username, p.promotion_name, po.order_status, po.order_date
                        FROM promotion_orders po
                        JOIN users u ON po.customer_id = u.id
                        JOIN promotions p ON po.promotion_id = p.id";
    $result = $conn->query($all_orders_query);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Order ID: {$row['order_id']}, Customer: {$row['username']}, Promotion: {$row['promotion_name']}, Status: {$row['order_status']}, Date: {$row['order_date']}
                | <a href='acceptOrder.php?id={$row['order_id']}'>Accept</a> | <a href='declineOrder.php?id={$row['order_id']}'>Decline</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No orders found.</p>";
    }
    ?>
</body>
</html>
