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
        <a href="ManagePromotions.php">Promotions</a>
        <a href="signup.php">New Admin</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php

        include 'welcomeName.php';
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


<div class="img-container">
    <img class="img" src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
</div>


<div class="menueDeatilsForm"> 
    <form action="updateItem.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <input type="hidden" name="menu_code" value="<?php echo $row['menu_code']; ?>">

        <input type="text" name="item_name" value="<?php echo $row['name']; ?>" required><br>
        <label for="item_name">Name</label>

        <input type="number" name="item_price" step="0.01" value="<?php echo $row['price']; ?>" required><br>
        <label for="item_price">Price</label>


        <input type="file" name="item_image" accept="image/*" class="btnImg"  ><br>
        <label for="item_image">Upload a Image</label>

        <input type="text" name="item_small_desc" step="0.01" value="<?php echo $row['small_description']; ?>" required>
        <label for="item_small_desc">Small & Long Descriptions</label>

        <textarea name="item_long_desc" rows="1" required><?php echo $row['long_description']; ?></textarea><br> <br>
        <!-- <label for="item_long_desc">Long Description</label> -->

        <input type="text" name="item_categories" value="<?php echo $row['categories']; ?>" required><br>
        <label for="item_categories">Categories</label>

        <input type="submit" value="Update Item" class="btnImg" > <br>
        <input type="hidden" id="menuCode" value="<?php echo $row['menu_code']; ?>">
        <button onclick="deleteItem()" class="btnImgDelete">Delete Item</button>
    </form>
    
</div>

    <script>
        function deleteItem() {
            var menuCode = document.getElementById('menuCode').value;

            // Use fetch to send an AJAX request to deleteItem.php
            fetch('deleteItem.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'menu_code=' + encodeURIComponent(menuCode),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                // Handle the response data if needed
                console.log(data);
                // Redirect to menu.php after successful deletion
                window.location.href = 'menu.php';
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }

        function validateForm() {
            var itemName = document.forms["updateForm"]["item_name"].value;
            var itemPrice = document.forms["updateForm"]["item_price"].value;
            var itemImage = document.forms["updateForm"]["item_image"].value;
            var itemSmallDesc = document.forms["updateForm"]["item_small_desc"].value;
            var itemLongDesc = document.forms["updateForm"]["item_long_desc"].value;
            var itemCategories = document.forms["updateForm"]["item_categories"].value;

            if (itemName == "") {
            alert("Name must be filled out");
            return false;
            }

            if (itemPrice == "" || isNaN(itemPrice)) {
            alert("Price must be a number");
            return false;
            }

            if (itemImage == "") {
            alert("Image must be selected");
            return false;
            }

            if (itemSmallDesc == "") {
            alert("Small description must be filled out");
            return false;
            }

            if (itemLongDesc == "") {
            alert("Long description must be filled out");
            return false;
            }

            if (itemCategories == "") {
            alert("Categories must be filled out");
            return false;
            }
        }
    </script>

</body>
</html>