<?php
include 'welcomeName.php';

// Database connection details
include 'dbConnection.php';

// Get reservation ID from the URL
$reservation_id = $_GET['id'];

// Retrieve reservation details from the database
$sql = "SELECT * FROM reservations WHERE id = $reservation_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $contact_number = $row['contact_number'];
    $email_address = $row['email_address'];
    $adults = $row['adults'];
    $children = $row['children'];
    $reservation_date = $row['reservation_date'];
    $reservation_time = $row['reservation_time'];
    $status = $row['status'];
    $comment = $row['comment'];
} else {
    echo "Reservation not found";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="topnav">
        <a href="adminHome.php">Home</a>
        <a href="menu.php">Menu</a>
        <a class="active" href="viewReservation.php">Reservations</a>
        <a href="adminOrders.php">Orders</a>
        <a href="view_users.php">Users</a>
        <a href="facilities.php">Outlets</a>
        <a href="ManagePromotions.php">Promotions</a>
        <a href="signup.php">New Admin</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>
    <h1>Edit Reservation</h1>

    <div class="menueDeatilsForm"> 
        <form action="update_reservation.php" method="post">
            <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">

            <input type="text" name="first_name" value="<?php echo $first_name; ?>" required><br>
            <label for="first_name">First Name</label>

            <input type="text" name="last_name" value="<?php echo $last_name; ?>" required><br>
            <label for="last_name">Last Name</label>

            <input type="text" name="contact_number" value="<?php echo $contact_number; ?>" required><br>
            <label for="contact_number">Contact Number</label>

            <input type="email" name="email_address" value="<?php echo $email_address; ?>" required><br>
            <label for="email_address">Email Address</label>

            <input type="number" name="adults" value="<?php echo $adults; ?>" required><br>
            <label for="adults">Number of Adults</label>

            <input type="number" name="children" value="<?php echo $children; ?>" required><br>
            <label for="children">Number of Children</label>

            <input type="date" name="reservation_date" value="<?php echo $reservation_date; ?>" required><br>
            <label for="reservation_date">Date</label>

            <input type="time" name="reservation_time" value="<?php echo $reservation_time; ?>" required>
            <label for="reservation_time">Time</label> <br><br>

            <select name="status">
                <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Accepted" <?php echo ($status == 'Accepted') ? 'selected' : ''; ?>>Accepted</option>
                <option value="Declined" <?php echo ($status == 'Declined') ? 'selected' : ''; ?>>Declined</option>
            </select>
            <label for="status">Status</label>
           

            <input type="text" name="comment" value="<?php echo $comment; ?>"><br>
            <label for="comment">Comment</label>

            <input type="submit" value="Update Reservation">
        </form>
    </div>
</body>
</html>
