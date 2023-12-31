<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food Item</title>
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
        <a href="adminCheckProOrders.php">Promotions</a>
        <a href="signup.php">New Admin</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

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
                header("Location: menu.php");
                exit();
            }
        } else {
            // Redirect to adminHome.html if menu_code is not provided
            header("Location: menu.php");
            exit();
        }

        // Close the database connection
        $conn->close();
    ?>

<h1>Edit <?php echo $row['name']; ?></h1>


<img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">


<div class="menueDeatilsForm"> 
    <form action="updateItem.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="menu_code" value="<?php echo $row['menu_code']; ?>">

        <input type="text" name="item_name" value="<?php echo $row['name']; ?>" required><br>
        <label for="item_name">Name</label>

        <input type="number" name="item_price" step="0.01" value="<?php echo $row['price']; ?>" required><br>
        <label for="item_price">Price</label>

        <!-- <h3>Upload Image</h3>
        <div class="drop_box">
            <header>
                <h4>Select File here</h4>
            </header>
            <p>Files Supported: PNG, JPG</p>
            <input type="file" hidden name="item_image" accept="image/*" required style="display:none;"><br>
            <button class="btn">Choose File</button>
        </div> <br> -->

        <input type="file" name="item_image" accept="image/*" required ><br>
        <label for="item_image">Upload a Image</label>

        <input type="text" name="item_small_desc" step="0.01" value="<?php echo $row['small_description']; ?>" required>
        <label for="item_small_desc">Small & Long Descriptions</label>

        <textarea name="item_long_desc" rows="1" required><?php echo $row['long_description']; ?></textarea><br> <br>
        <!-- <label for="item_long_desc">Long Description</label> -->

        <input type="text" name="item_categories" value="<?php echo $row['categories']; ?>" required><br>
        <label for="item_categories">Categories</label>

        <input type="submit" value="Update Item"> <br>
        
        <form action="deleteItem.php" method="post">
            <input type="hidden" name="menu_code" value="<?php echo $row['menu_code']; ?>">
            <input type="submit" value="Delete Item">
        </form>
    </form>
</div>

</body>
</html>