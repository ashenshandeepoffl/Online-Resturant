<?php
session_start();

// Database connection details
include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_code = $_POST['menu_code'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    $comment_query = "INSERT INTO comments (menu_code, username, comment) VALUES ($menu_code, '$username', '$comment')";

    if ($conn->query($comment_query) === TRUE) {
        header("Location: menuDetails.php?menu_code=$menu_code");
        exit();
    } else {
        echo "Error: " . $comment_query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
