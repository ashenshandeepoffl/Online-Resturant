<?php
session_start();

// Database connection details
include 'dbConnection.php';

// Check if the user is logged in with admin privileges (You should have a proper authentication mechanism)
if ($_SESSION['user_type'] !== 'admin') {
    // Redirect to login or unauthorized page
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Query to delete the user
    $delete_user_query = "DELETE FROM users WHERE id = $user_id";
    $conn->query($delete_user_query);

    // Redirect back to the adminViewUsers.html page
    header("Location: view_users.php");
    exit();
}
?>
