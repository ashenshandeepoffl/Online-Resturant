<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Page</title>
</head>
<body>
    <h1>Reservation Form</h1>
    <form action="process_reservation.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" required><br>

        <label for="email_address">Email Address:</label>
        <input type="email" name="email_address" required><br>

        <label for="adults">Number of Adults:</label>
        <input type="number" name="adults" required><br>

        <label for="children">Number of Children:</label>
        <input type="number" name="children" required><br>

        <label for="reservation_date">Date:</label>
        <input type="date" name="reservation_date" required><br>

        <label for="reservation_time">Time:</label>
        <input type="time" name="reservation_time" required><br>

        <input type="submit" value="Submit Reservation">
    </form>
</body>
</html>
