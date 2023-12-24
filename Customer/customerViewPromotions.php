<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - View Promotions</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Customer - View Promotions</h2>

    <?php
    include 'dbConnection.php';

    // Query to get all promotions
    $all_promotions_query = "SELECT * FROM promotions";
    $result = $conn->query($all_promotions_query);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Promotion Name</th><th>Old Price</th><th>New Price</th><th>Image</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['promotion_name']}</td>";
            echo "<td>{$row['old_price']}</td>";
            echo "<td>{$row['new_price']}</td>";
            echo "<td><img src='/Restaurant/Admin/{$row['image_url']}' alt='Promotion Image' style='max-width: 100px; max-height: 100px;'></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No promotions found.</p>";
    }
    ?>

    <!-- Place Online Order Form -->
    <h3>Place Online Order</h3>
    <form action="placeProOrder.php" method="post">
        <label for="promotion_id">Select Promotion:</label>
        <select name="promotion_id" required>
            <!-- Fetch and display available promotions dynamically -->
            <?php
            include 'dbConnection.php';

            $all_promotions_query = "SELECT * FROM promotions";
            $result = $conn->query($all_promotions_query);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['promotion_name']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Place Order">
    </form>

    <!-- Order History -->
    <h3>Order History</h3>
    <?php
        session_start();
        include 'dbConnection.php';

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page or display an error message
            header("Location: login.php");
            exit();
        }

        // Fetch and display order history for the logged-in customer
        $customer_id = $_SESSION['user_id'];
        $order_history_query = "SELECT po.order_id, p.promotion_name, po.order_status, po.order_date
                                FROM promotion_orders po
                                JOIN promotions p ON po.promotion_id = p.id
                                WHERE po.customer_id = $customer_id";
        $result = $conn->query($order_history_query);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>Order ID: {$row['order_id']}, Promotion: {$row['promotion_name']}, Status: {$row['order_status']}, Date: {$row['order_date']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No orders found.</p>";
        }

        $conn->close();
        ?>


</body>
</html>
