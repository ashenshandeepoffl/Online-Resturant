<?php
session_start();

// Database connection details
include 'dbConnection.php';

// Retrieve reservations from the database
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h1>Admin Panel - Reservations</h1>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>Email Address</th>
            <th>Adults</th>
            <th>Children</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['contact_number'] . "</td>";
                echo "<td>" . $row['email_address'] . "</td>";
                echo "<td>" . $row['adults'] . "</td>";
                echo "<td>" . $row['children'] . "</td>";
                echo "<td>" . $row['reservation_date'] . "</td>";
                echo "<td>" . $row['reservation_time'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['comment'] . "</td>";
                echo "<td><a href='edit_reservation.php?id=" . $row['id'] . "'>Edit</a> | <a href='approve_decline.php?id=" . $row['id'] . "&action=approve'>Approve</a> | <a href='approve_decline.php?id=" . $row['id'] . "&action=decline'>Decline</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No reservations found</td></tr>";
        }
        ?>

    </table>
</body>
</html>
