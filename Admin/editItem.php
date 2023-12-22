<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food Item</title>
</head>
<body>
    <?php
    session_start();

    // Database connection details
    include 'dbConnection.php';

    if (isset($_GET['menu_code'])) {
        $menu_code = $_GET['menu_code'];

        // Retrieve item details from the database based on menu_code
        $edit_item_query = "SELECT * FROM menu_items WHERE menu_code = $menu_code";
        $edit_item_result = $conn->query($edit_item_query);

        if ($edit_item_result->num_rows == 1) {
            $row = $edit_item_result->fetch_assoc();
        } else {
            // Redirect to adminHome.html if item not found
            header("Location: adminHome.php");
            exit();
        }
    } else {
        // Redirect to adminHome.html if menu_code is not provided
        header("Location: adminHome.php");
        exit();
    }

    // Close the database connection
    $conn->close();
    ?>

<h2>Edit Food Item - <?php echo $row['name']; ?></h2>

<!-- Display Current Image -->
<img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>"><br>


<!-- Update Item Form -->
<form action="updateItem.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="menu_code" value="<?php echo $row['menu_code']; ?>">

    <label for="item_name">Name:</label>
    <input type="text" name="item_name" value="<?php echo $row['name']; ?>" required><br>

    <label for="item_price">Price:</label>
    <input type="number" name="item_price" step="0.01" value="<?php echo $row['price']; ?>" required><br>

    <label for="item_image">New Image:</label>
    <input type="file" name="item_image" accept="image/*"><br>

    <label for="item_small_desc">Small Description:</label>
    <textarea name="item_small_desc" rows="3" required><?php echo $row['small_description']; ?></textarea><br>

    <label for="item_long_desc">Long Description:</label>
    <textarea name="item_long_desc" rows="6" required><?php echo $row['long_description']; ?></textarea><br>

    <label for="item_categories">Categories:</label>
    <input type="text" name="item_categories" value="<?php echo $row['categories']; ?>" required><br>

    <input type="submit" value="Update Item">
</form>

<!-- Delete Item Form -->
<form action="deleteItem.php" method="post">
    <input type="hidden" name="menu_code" value="<?php echo $row['menu_code']; ?>">
    <input type="submit" value="Delete Item">
</form>

<!-- Back to Admin Home -->
<a href="adminHome.php">Back to Admin Home</a>
</body>
</html>