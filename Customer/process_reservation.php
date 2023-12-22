<?php

session_start();

// Database connection details
include 'dbConnection.php';

// Collect form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$contact_number = $_POST['contact_number'];
$email_address = $_POST['email_address'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$reservation_date = $_POST['reservation_date'];
$reservation_time = $_POST['reservation_time'];

// Insert data into the database
$sql = "INSERT INTO reservations (first_name, last_name, contact_number, email_address, adults, children, reservation_date, reservation_time, status, comment)
        VALUES ('$first_name', '$last_name', '$contact_number', '$email_address', $adults, $children, '$reservation_date', '$reservation_time', 'Pending', '')";

if ($conn->query($sql) === TRUE) {
    echo "Reservation submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
