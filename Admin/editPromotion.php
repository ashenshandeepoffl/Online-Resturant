<?php
session_start();

include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $promotion_id = $_GET['id'];

    // Retrieve promotion details from the database based on id
    $edit_promotion_query = "SELECT * FROM promotions WHERE id = $promotion_id";
    $result = $conn->query($edit_promotion_query);

    if ($result->num_rows == 1) {
        $edit_promotion_row = $result->fetch_assoc();
    } else {
        // Redirect to adminManagePromotions.html if promotion not found
        header("Location: ManagePromotions.php");
        exit();
    }
} else {
    // Redirect to adminManagePromotions.html if id is not provided
    header("Location: ManagePromotions.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Promotion</title>
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

    <h1>Edit <?php echo $edit_promotion_row['promotion_name']; ?></h1>

    <div class="menueDeatilsForm">
        <form action="updatePromotion.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="promotion_id" value="<?php echo $edit_promotion_row['id']; ?>">

            <input type="text" name="promotion_name" value="<?php echo $edit_promotion_row['promotion_name']; ?>" required><br>
            <label for="promotion_name">Promotion Name</label>

            <input type="number" name="old_price" step="0.01" value="<?php echo $edit_promotion_row['old_price']; ?>" required><br>
            <label for="old_price">Old Price</label>

            <input type="number" name="new_price" step="0.01" value="<?php echo $edit_promotion_row['new_price']; ?>" required><br>
            <label for="new_price">New Price</label>

            <input type="file" name="promotion_image" accept="image/*"><br>
            <label for="promotion_image">Promotion Image</label>

            <input type="submit" value="Update Promotion">
        </form>
    </div>
</body>
</html>
