<?php
include 'welcomeName.php';
include 'dbconnection.php';

// Handle the form submission for editing facility
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $seating_capacity = $_POST['seating_capacity'];
    $parking_available = isset($_POST['parking_available']) ? 1 : 0;
    $availability_status = isset($_POST['availability_status']) ? 1 : 0;

    $sql = "UPDATE restaurant_facilities
            SET facility_name = '$facility_name',
                seating_capacity = $seating_capacity,
                parking_available = $parking_available,
                availability_status = $availability_status
            WHERE id = $facility_id";
    mysqli_query($conn, $sql);

    // Redirect back to admin_facilities.php after editing
    header("Location: facilities.php");
    exit();
}

// Retrieve facility details for editing
if (isset($_GET['id'])) {
    $facility_id = $_GET['id'];
    $sql = "SELECT * FROM restaurant_facilities WHERE id = $facility_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $facility_name = $row['facility_name'];
        $seating_capacity = $row['seating_capacity'];
        $parking_available = $row['parking_available'];
        $availability_status = $row['availability_status'];
    } else {
        // Facility not found, redirect to admin_facilities.php
        header("Location: facilities.php");
        exit();
    }
} else {
    // No facility ID provided, redirect to admin_facilities.php
    header("Location: facilities.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Facility</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">
        <a href="adminHome.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="viewReservation.php">Reservations</a>
        <a href="adminOrders.php">Orders</a>
        <a href="view_users.php">Users</a>
        <a class="active"  href="facilities.php">Outlets</a>
        <a href="ManagePromotions.php">Promotions</a>
        <a href="signup.php">New Admin</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>
    <h1>Edit Facility</h1>
    <div class="menueDeatilsForm"> 
    <form action="" method="post">
        <input type="hidden" name="facility_id" value="<?php echo $facility_id; ?>">

        <input type="text" name="facility_name" value="<?php echo $facility_name; ?>" required><br>
        <label for="facility_name">Facility Name</label>

        <input type="number" name="seating_capacity" value="<?php echo $seating_capacity; ?>" required><br>
        <label for="seating_capacity">Seating Capacity</label>

        <input type="checkbox" name="parking_available" <?php echo ($parking_available == 1) ? 'checked' : ''; ?>><br>
        <label for="parking_available">Parking Available</label>

        <input type="checkbox" name="availability_status" <?php echo ($availability_status == 1) ? 'checked' : ''; ?>><br>
        <label for="availability_status">Availability Status</label>

        <input type="submit" value="Save Changes">
    </form>
</div>
</body>
</html>
