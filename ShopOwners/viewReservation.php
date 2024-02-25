<?php

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
    
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="topnav">
        <a href="adminHome.php">Home</a>
        <a href="menu.php">Menu</a>
        <a class="active" href="viewReservation.php">Reservations</a>
        <a href="adminOrders.php">Orders</a>
        <a href="facilities.php">Outlets</a>
        <a href="adminCheckProOrders.php">Promotions</a>
        <a href="signup.php">New ShopOwners</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php
        include 'welcomeName.php';
    ?>

    <h1>Admin Panel - Reservations</h1>
    
    <table>
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
                echo "<td><a href='edit_reservation.php?id=" . $row['id'] . "'>Edit</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No reservations found</td></tr>";
        }
        ?>

    </table>
    <!--  | <a href='approve_decline.php?id=" . $row['id'] . "&action=approve'>Approve</a> | <a href='approve_decline.php?id=" . $row['id'] . "&action=decline'>Decline</a> -->
</body>
</html>
