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
    // Modern and styled success message
    echo '<html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        text-align: center;
                    }
                    .success-message {
                        margin: 50px auto;
                        padding: 20px;
                        background-color: #019b98;
                        color: #fff;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                </style>
            </head>
            <body>
                <div class="success-message">
                    <h2>Reservation submitted successfully</h2>
                </div>
            </body>
        </html>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
