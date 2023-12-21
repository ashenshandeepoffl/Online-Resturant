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
    $quantity = $_POST['quantity'];
    $username = $_SESSION['username'];

    $order_query = "INSERT INTO orders (menu_code, username, quantity) VALUES ($menu_code, '$username', $quantity)";

    if ($conn->query($order_query) === TRUE) {
        header("Location: customerHome.php");
        exit();
    } else {
        echo "Error: " . $order_query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
