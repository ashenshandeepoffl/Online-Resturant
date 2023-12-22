<?php
session_start();

// Database connection details
include 'dbConnection.php';

// Fetch order summary for the logged-in customer
$username = $_SESSION['username'];
$order_summary_query = "SELECT menu_items.name, orders.quantity, menu_items.price
                        FROM orders
                        JOIN menu_items ON orders.menu_code = menu_items.menu_code
                        WHERE orders.username = '$username'";

$order_summary_result = $conn->query($order_summary_query);

$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
</head>
<body>
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

    <!-- Add a link to go back to the customer home page -->
    <p><a href="customerHome.php">Go back to Customer Home</a></p>
</body>
</html>
