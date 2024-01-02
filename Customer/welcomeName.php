<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back</title>
    <style>
        p {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php
        // Start the session
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "customers") {
            // Display the username
            echo "<p>Welcome Back, " . $_SESSION["username"] . "!</p>"; 
        } else {
            // Redirect to the login page if not logged in
            header("Location: login.php");
            exit();
        }
    ?>
</body>
</html>
