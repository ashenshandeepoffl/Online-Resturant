<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Promotions</title>
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
    <h2>Admin - Manage Promotions</h2>

    <!-- Form to add new promotion -->
    <h3>Add New Promotion</h3>
    <form action="addPromotion.php" method="post" enctype="multipart/form-data">
        <label for="promotion_name">Promotion Name:</label>
        <input type="text" name="promotion_name" required><br>

        <label for="old_price">Old Price:</label>
        <input type="number" name="old_price" step="0.01" required><br>

        <label for="new_price">New Price:</label>
        <input type="number" name="new_price" step="0.01" required><br>

        <label for="promotion_image">Promotion Image:</label>
        <input type="file" name="promotion_image" accept="image/*" required><br>

        <input type="submit" value="Add Promotion">
    </form>

    <!-- Display existing promotions -->
    <h3>Existing Promotions</h3>
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
</body>
</html>
