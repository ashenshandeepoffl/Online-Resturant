<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Promotions</title>
<link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">    
        <a href="adminHome.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="viewReservation.php">Reservations</a>
        <a href="adminOrders.php">Orders</a>
        <a href="view_users.php">Users</a>
        <a href="facilities.php">Outlets</a>
        <a class="active" href="ManagePromotions.php">Promotions</a>
        <a href="signup.php">New Admin</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php
        include 'welcomeName.php';
    ?>

    <h1>Add New Promotions</h1>

    <div class="menueDeatilsForm">
        <form action="addPromotion.php" method="post" enctype="multipart/form-data">
            
            <input type="text" name="promotion_name" required><br>
            <label for="promotion_name">Promotion Name</label>

            <input type="number" name="old_price" step="0.01" required><br>
            <label for="old_price">Old Price</label>

            <input type="number" name="new_price" step="0.01" required><br>
            <label for="new_price">New Price</label>

            <input type="file" name="promotion_image" accept="image/*" required class="btnImg"><br>
            <label for="promotion_image">Promotion Image</label>

            <input type="submit" value="Add Promotion" class="btn">
        </form>
    </div>


    <h1>Existing Promotions</h1>
    <?php
        include 'dbConnection.php';

        // Query to get all promotions
        $all_promotions_query = "SELECT * FROM promotions";
        $result = $conn->query($all_promotions_query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Promotion Name</th><th>Old Price</th><th>New Price</th><th>Image</th><th>Action</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['promotion_name']}</td>";
                echo "<td>{$row['old_price']}</td>";
                echo "<td>{$row['new_price']}</td>";
                echo "<td><img src='{$row['image_url']}' alt='Promotion Image' style='max-width: 100px; max-height: 100px;'></td>";
                echo "<td><a href='editPromotion.php?id={$row['id']}'>Edit</a> | <a href='deletePromotion.php?id={$row['id']}'>Delete</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No promotions found.</p>";
        }
    ?>

    <h1>Check Promotion Orders</h1>

    <?php
        include 'dbConnection.php';

        // Fetch and display promotion orders for admin review
        $all_orders_query = "SELECT po.order_id, u.username, p.promotion_name, po.order_status, po.order_date
                        FROM promotion_orders po
                        JOIN users u ON po.customer_id = u.id
                        JOIN promotions p ON po.promotion_id = p.id";
        $result = $conn->query($all_orders_query);

        if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Promotion</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['promotion_name']}</td>
                    <td>{$row['order_status']}</td>
                    <td>{$row['order_date']}</td>
                    <td>
                        <a href='acceptOrder.php?id={$row['order_id']}'>Accept</a> |
                        <a href='declineOrder.php?id={$row['order_id']}'>Decline</a>
                    </td>
                </tr>";
        }
        echo "</table>";
        } else {
        echo "<p>No orders found.</p>";
        }
    ?>

</body>
</html>
