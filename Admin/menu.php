<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Details</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">
        <a href="adminHome.php">Home</a>
        <a class="active" href="menu.php">Menu</a>
        <a href="viewReservation.php">Reservations</a>
        <a href="adminOrders.php">Orders</a>
        <a href="view_users.php">Users</a>
        <a href="facilities.php">Outlets</a>
        <a href="ManagePromotions.php">Promotions</a>
        <a href="signup.php">New Admin</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php
        include 'welcomeName.php';
    ?>
    
    <h1>Add Menu Items</h1>

    <div class="menueDeatilsForm"> 
        <form action="addItem.php" method="post" enctype="multipart/form-data">
            <input type="text" name="item_name" required><br>
            <label for="item_name">Name</label>
            
            <input type="number" name="item_price" step="0.01" required><br>
            <label for="item_price">Price</label>
            
            <input type="file" name="item_image" accept="image/*" required class="btnImg" ><br>
            <label for="item_image">Upload a Image</label>

            <input name="item_small_desc" rows="1" required></input><br>
            <label for="item_small_desc">Small & long Description</label>
            <textarea name="item_long_desc" rows="3" required></textarea><br><br>

            <input type="text" name="item_categories" required><br>
            <label for="item_categories">Categories</label>

            <!-- <button class="btn" type="submit">Add Item</button> <br> -->
            <input type="submit" value="Add Item" class="btn">
        </form>
    </div>


    <!-- List Existing Items -->
    <h1>Existing Food Items</h1>
    <?php

    // Database connection details
    include 'dbConnection.php';

    // Fetch menu items from the database
    $menu_query = "SELECT menu_code, name, price FROM menu_items";
    $menu_result = $conn->query($menu_query);

    if ($menu_result->num_rows > 0) {

        echo '<table>
        <tr>
            <th>Item Code</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>';

        while ($menu_row = $menu_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$menu_row['menu_code']}</td>";
            echo "<td>{$menu_row['name']}</td>";
            echo "<td>{$menu_row['price']}</td>";
            echo "<td class='edit'><a href='editItem.php?menu_code={$menu_row['menu_code']}'>Edit Details</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No menu items available.";
    }
    ?>
</body>
</html>
