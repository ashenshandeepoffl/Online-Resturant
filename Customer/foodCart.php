<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Cart</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">
        <a href="customerHome.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a class="active" href="foodCart.php">Food Cart</a>
        <a href="onlineReservation.php">Online Reservation</a>
        <a href="view_reservation.php">View Reservation</a>
        <a href="customer_facilities.php">customer_facilities</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>
    
    <?php
       include 'welcomeName.php';
       include 'dbConnection.php';

        // Fetch order summary for the logged-in customer
        $username = $_SESSION['username'];
        $order_summary_query = "SELECT menu_items.name, orders.quantity, menu_items.price
                                FROM orders
                                JOIN menu_items ON orders.menu_code = menu_items.menu_code
                                WHERE orders.username = '$username'";

        $order_summary_result = $conn->query($order_summary_query);
        $total_amount = 0;

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

    <h2>Order Summary</h2>

    <?php
    if ($order_summary_result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Menu Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>";
        while ($order_summary_row = $order_summary_result->fetch_assoc()) {
            echo "<tr>
                    <td>{$order_summary_row['name']}</td>
                    <td>{$order_summary_row['quantity']}</td>
                    <td>{$order_summary_row['price']}</td>
                </tr>";
            $total_amount += $order_summary_row['quantity'] * $order_summary_row['price'];
        }
        echo "</table>";

        echo "<p>Total Amount: $total_amount</p>";

        // Button to submit the order to admin
        echo "<form action='submitOrder.php' method='post'>
                <input type='hidden' name='total_amount' value='$total_amount'>
                <input type='submit' value='Submit Order to Admin'>
              </form>";
    } else {
        echo "No orders placed yet.";
    }
    ?>


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
</body>
</html>
