<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Details</title>
</head>
<body>
    

    <!-- Add New Item Form -->
    <h3>Add New Food Item</h3>
    <form action="addItem.php" method="post" enctype="multipart/form-data">
        <label for="item_name">Name:</label>
        <input type="text" name="item_name" required><br>

        <label for="item_price">Price:</label>
        <input type="number" name="item_price" step="0.01" required><br>

        <label for="item_image">Image:</label>
        <input type="file" name="item_image" accept="image/*" required><br>

        <label for="item_small_desc">Small Description:</label>
        <textarea name="item_small_desc" rows="3" required></textarea><br>

        <label for="item_long_desc">Long Description:</label>
        <textarea name="item_long_desc" rows="6" required></textarea><br>

        <label for="item_categories">Categories:</label>
        <input type="text" name="item_categories" required><br>

        <input type="submit" value="Add Item">
    </form>

    <!-- List Existing Items -->
    <h3>Existing Food Items</h3>
    <?php

    session_start();

    // Database connection details
    include 'dbConnection.php';

    // Fetch menu items from the database
    $menu_query = "SELECT menu_code, name, price FROM menu_items";
    $menu_result = $conn->query($menu_query);

    if ($menu_result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Item Code</th><th>Name</th><th>Price</th><th>Actions</th></tr>";

        while ($menu_row = $menu_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$menu_row['menu_code']}</td>";
            echo "<td>{$menu_row['name']}</td>";
            echo "<td>{$menu_row['price']}</td>";
            echo "<td><a href='editItem.php?menu_code={$menu_row['menu_code']}'>Edit</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No menu items available.";
    }
    ?>
</body>
</html>
