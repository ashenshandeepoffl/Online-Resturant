<?php
// Include database connection
include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    // ...

    // Update user in the database
    $update_user_query = "UPDATE users SET
                          first_name = '$first_name',
                          last_name = '$last_name',
                          email = '$email',
                          username = '$username',
                          address = '$address',
                          gender = '$gender',
                          dob = '$dob',
                          password = '$password',
                          user_type = '$user_type'
                          WHERE id = $user_id";

    if ($conn->query($update_user_query) === TRUE) {
        header("Location: adminHome.html");
        exit();
    } else {
        echo "Error: " . $update_user_query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
