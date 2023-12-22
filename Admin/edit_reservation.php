<?php
session_start();

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
</head>
<body>
    <h1>Edit Reservation</h1>
    <form action="update_reservation.php" method="post">
        <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" value="<?php echo $contact_number; ?>" required><br>

        <label for="email_address">Email Address:</label>
        <input type="email" name="email_address" value="<?php echo $email_address; ?>" required><br>

        <label for="adults">Number of Adults:</label>
        <input type="number" name="adults" value="<?php echo $adults; ?>" required><br>

        <label for="children">Number of Children:</label>
        <input type="number" name="children" value="<?php echo $children; ?>" required><br>

        <label for="reservation_date">Date:</label>
        <input type="date" name="reservation_date" value="<?php echo $reservation_date; ?>" required><br>

        <label for="reservation_time">Time:</label>
        <input type="time" name="reservation_time" value="<?php echo $reservation_time; ?>" required><br>

        <label for="status">Status:</label>
        <select name="status">
            <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Accepted" <?php echo ($status == 'Accepted') ? 'selected' : ''; ?>>Accepted</option>
            <option value="Declined" <?php echo ($status == 'Declined') ? 'selected' : ''; ?>>Declined</option>
        </select><br>

        <label for="comment">Comment:</label>
        <textarea name="comment"><?php echo $comment; ?></textarea><br>

        <input type="submit" value="Update Reservation">
    </form>
</body>
</html>
