<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Page</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">
        <a href="customerHome.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a href="foodCart.php">Food Cart</a>
        <a class="active" href="onlineReservation.php">Online Reservation</a>
        <a href="/Restaurant/logout.php">Logout</a>
    </div>

    <?php
        include 'welcomeName.php';
        include 'dbConnection.php';

        // Retrieve all reservations from the database
        $sql = "SELECT * FROM reservations";
        $result = $conn->query($sql);
    ?>

    <h2>Reservation Form</h2>
    <div class="reservationForm">
        
        <form action="process_reservation.php" method="post">
            <input type="text" name="first_name" required><br>
            <label for="first_name">First Name</label>
            
            <input type="text" name="last_name" required><br>
            <label for="last_name">Last Name</label>

            <input type="text" name="contact_number" required><br>
            <label for="contact_number">Contact Number</label>
            

            <input type="email" name="email_address" required><br>
            <label for="email_address">Email Address</label>

            <input type="number" name="adults" required><br>
            <label for="adults">Number of Adults</label>

            <input type="number" name="children" required><br>
            <label for="children">Number of Children</label>

            <input type="date" name="reservation_date" required><br>
            <label for="reservation_date">Date</label>

            <input type="time" name="reservation_time" required><br>
            <label for="reservation_time">Time</label>

            <button>Confirm Your Reservation</button>
        </form>
    </div>
    
    <h2>Reservations History</h2>
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
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No reservations found</td></tr>";
        }
        ?>

    </table>
    
</body>
</html>
