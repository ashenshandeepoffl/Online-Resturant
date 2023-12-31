<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "customers") {
        // Display the username
        echo "<p>Hello, " . $_SESSION["username"] . "!</p>"; 
    } else {
        // Redirect to the login page if not logged in
        header("Location: login.php");
        exit();
    }
?>