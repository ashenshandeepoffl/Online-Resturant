<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "As+s01galaxysa";
$dbname = "Resturent";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
