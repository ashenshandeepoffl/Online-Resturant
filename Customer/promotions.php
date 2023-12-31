<?php 
include 'dbConnection.php';

// Query to get all promotions
$all_promotions_query = "SELECT * FROM promotions";
$result = $conn->query($all_promotions_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - View Promotions</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">
        <a href="customerHome.php">Home</a>
        <a class="active" href="promotions.php">Promotions</a>
        <a href="foodCart.php">Food Cart</a>
        <a href="onlineReservation.php">Online Reservation</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>
    
    <?php
       include 'welcomeName.php';
    ?>

    <h2>Promotions</h2>

    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                    echo "<img src='/Restaurant/Admin/{$row['image_url']}' alt='Promotion Image' style='width:100%'>";
                    echo '<div class="container">';
                        echo "<h3>{$row['promotion_name']}</h3>";
                        echo "<p>Old Price</p>" . "<p class='oldPrice'>$ {$row['old_price']}</p>";
                        echo "<p>Promotional Price <b> $ {$row['new_price']} <b></p>";
                    echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No promotions found.</p>";
        }
    ?>

    <!-- Place Online Order Form -->
    <h3>Place Online Order</h3>

    <div class="onlinePromotions">
        <form action="placeProOrder.php" method="post">
            <label for="promotion_id">Select Promotion</label>
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
            </select>
            <div class="promotionButton">
                <button class='promotionAdd'>Place an Order</button>
            </div>
            
        </form>
    </div>
    
    <!-- Order History -->
    <h3>Your Order History</h3>
    <?php
        // session_start();
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
            echo '<table>
                <tr>
                    <th>Order ID</th>
                    <th>Promotion</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['order_id'] . '</td>
                    <td>' . $row['promotion_name'] . '</td>
                    <td>' . $row['order_status'] . '</td>
                    <td>' . $row['order_date'] . '</td>
                </tr>';
        }
        echo '</table>';
        } else {
            echo "<p>No orders found.</p>";
        }
        $conn->close();
    ?>

</body>
</html>
