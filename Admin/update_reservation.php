<?php
session_start();

include 'dbConnection.php';

// Collect form data
$reservation_id = $_POST['reservation_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$contact_number = $_POST['contact_number'];
$email_address = $_POST['email_address'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$reservation_date = $_POST['reservation_date'];
$reservation_time = $_POST['reservation_time'];
$status = $_POST['status'];
$comment = $_POST['comment'];

// Update data in the database
$sql = "UPDATE reservations 
        SET 
        first_name = '$first_name', 
        last_name = '$last_name', 
        contact_number = '$contact_number', 
        email_address = '$email_address', 
        adults = $adults, 
        children = $children, 
        reservation_date = '$reservation_date', 
        reservation_time = '$reservation_time', 
        status = '$status', 
        comment = '$comment' 
        WHERE id = $reservation_id";

if ($conn->query($sql) === TRUE) {
    header('Location: viewReservation.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
